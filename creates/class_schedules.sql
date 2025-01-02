CREATE TABLE class_schedules(
    class_id   INT,
    day_letter VARCHAR(1),
    start_time TIME,
    end_time   TIME,
    PRIMARY KEY (class_id, day_letter, start_time, end_time),
    FOREIGN KEY (day_letter) REFERENCES days (day_letter) ON DELETE RESTRICT,
    FOREIGN KEY (start_time) REFERENCES time_blocks (start_time) ON DELETE RESTRICT,
    FOREIGN KEY (end_time) REFERENCES time_blocks (end_time) ON DELETE RESTRICT,
);


CREATE VIEW class_schedules_view AS
SELECT  class_id,
        GROUP_CONCAT(
            DISTINCT CONCAT(
                GROUP_CONCAT(DISTINCT day_letter ORDER BY FIELD(day_letter, 'M', 'T', 'W', 'R', 'F', 'S', 'U') SEPARATOR ''),
                ' ',
                DATE_FORMAT(start_time, '%l:%i%p'),  -- Format the start time (e.g., 1:00pm)
                '-',
                DATE_FORMAT(end_time, '%l:%i%p')  -- Format the end time (e.g., 2:00pm)
            )
            ORDER BY start_time
            SEPARATOR ', '
        ) AS schedule
FROM    class_schedules
GROUP BY    class_id;


CREATE VIEW classes_with_schedule_view AS
SELECT  class_id, 
        course_id
        section,
        term_id
        professor_id,
        building_name,
        room_number,
        class_max_capacity,
        day_letter,
        start_time,
        end_time
FROM    classes
        JOIN class_schedules
        USING (class_id);


DROP FUNCTION IF EXISTS find_location_conflicts;
CREATE FUNCTION find_location_conflicts(
    building_name_input VARCHAR(64), 
    room_number_input VARCHAR(64), 
    term_id_input INT,
    day_letter_input VARCHAR(1),
    start_time_input TIME, 
    end_time_input TIME)
RETURNS INT
RETURN (
    SELECT  COUNT(class_id)
    FROM    classes_with_schedule_view
    WHERE   building_name = building_name_input
            AND room_number = room_number_input
            AND term_id = term_id_input
            AND day_letter = day_letter_input
            AND find_time_conflict(start_time, end_time, start_time_input, end_time_input,) <> 0          
);


DROP FUNCTION IF EXISTS find_professor_conflicts;
CREATE FUNCTION find_professor_conflicts(
    professor_id_input INT, 
    term_id_input INT,
    day_letter_input VARCHAR(1),
    start_time_input TIME, 
    end_time_input TIME)
RETURNS INT
RETURN (
    SELECT  COUNT(class_id)
    FROM    classes_with_schedule_view
    WHERE   professor_id = professor_id_input
            AND term_id = term_id_input
            AND day_letter = day_letter_input
            AND find_time_conflict(start_time, end_time, start_time_input, end_time_input,) <> 0          
);



DELIMITER $$
CREATE TRIGGER class_schedules_insert
BEFORE INSERT ON class_schedules FOR EACH ROW
BEGIN

    -- location_conflict
    SET @location_conflicts = find_location_conflicts(  get_building_name_by_class(NEW.class_id), 
                                                        get_room_number_by_class(NEW.class_id), 
                                                        get_term_id_by_class(NEW.class_id), 
                                                        NEW.day_letter,
                                                        NEW.start_time, 
                                                        NEW.end_time);
    IF (@location_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class already exists at that location on that time';
    END IF;

    -- professor conflict
        SET @professor_conflicts = find_professor_conflicts(get_professor_id_by_class(NEW.class_id), 
                                                            get_term_id_by_class(NEW.class_id), 
                                                            NEW.day_letter,
                                                            NEW.start_time, 
                                                            NEW.end_time);
    IF (@professor_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Professor is already teaching a class on that time';
    END IF;

END; $$
DELIMITER ;



DELIMITER $$
CREATE TRIGGER class_schedules_update
BEFORE UPDATE ON class_schedules FOR EACH ROW
BEGIN

    -- location_conflict
    SET @location_conflicts = find_location_conflicts(  get_building_name_by_class(NEW.class_id), 
                                                        get_room_number_by_class(NEW.class_id), 
                                                        get_term_id_by_class(NEW.class_id), 
                                                        NEW.day_letter,
                                                        NEW.start_time, 
                                                        NEW.end_time);
    IF (@location_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class already exists at that location on that time';
    END IF;

    -- professor conflict
        SET @professor_conflicts = find_professor_conflicts(get_professor_id_by_class(NEW.class_id), 
                                                            get_term_id_by_class(NEW.class_id), 
                                                            NEW.day_letter,
                                                            NEW.start_time, 
                                                            NEW.end_time);
    IF (@professor_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Professor is already teaching a class on that time';
    END IF;

END; $$
DELIMITER ;
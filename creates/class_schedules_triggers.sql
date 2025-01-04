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
    SELECT  COUNT(*)
    FROM    class_schedules_view
    WHERE   building_name = building_name_input
            AND room_number = room_number_input
            AND term_id = term_id_input
            AND day_letter = day_letter_input
            AND find_time_conflict(start_time, end_time, start_time_input, end_time_input) <> 0          
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
    SELECT  COUNT(*)
    FROM    class_schedules_view
    WHERE   professor_id = professor_id_input
            AND term_id = term_id_input
            AND day_letter = day_letter_input
            AND find_time_conflict(start_time, end_time, start_time_input, end_time_input) <> 0          
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
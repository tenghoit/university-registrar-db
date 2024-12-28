CREATE TABLE classes (
    class_id            INT AUTO_INCREMENT,
    course_id           INT,
    term_id             INT,
    building_name       VARCHAR(64),
    room_number         INT,
    professor_id        INT,
    section             VARCHAR(1) DEFAULT 'a',
    class_max_capacity  INT DEFAULT 25,
    class_schedule_id   INT,
    start_time          TIME,
    end_time            TIME,
    PRIMARY KEY (class_id),
    FOREIGN KEY (course_id) REFERENCES courses (course_id) ON DELETE RESTRICT,
    FOREIGN KEY (term_id) REFERENCES terms (term_id) ON DELETE RESTRICT,
    FOREIGN KEY (building_name, room_number) REFERENCES locations (building_name, room_number) ON DELETE SET NULL,
    FOREIGN KEY (professor_id) REFERENCES professors (professor_id) ON DELETE RESTRICT,
    FOREIGN KEY (class_schedule_id) REFERENCES class_schedules (class_schedule_id) ON DELETE RESTRICT,
    FOREIGN KEY (start_time, end_time) REFERENCES time_blocks (start_time, end_time) ON DELETE RESTRICT,

    CONSTRAINT unique_class UNIQUE (course_id, term_id, section) -- b/c these needs to be unique
);


CREATE VIEW classes_view AS
SELECT  class_id, 
        course_id
        crs.course_discipline AS course_discipline,
        crs.course_number AS course_number,
        cls.section AS section,
        crs.course_name AS course_name,
        professor_first_name,
        professor_last_name,
        building_name,
        room_number,
        class_schedule,
        start_time,
        end_time,
        term_start_date,
        term_end_date,
        class_max_capacity,
        cpr.prerequisites AS prerequisites
        FROM classes AS cls
        JOIN terms
            USING (term_id)
        JOIN professors
            USING (professor_id)
        JOIN class_schedules_view
            USING (class_schedule_id)
        JOIN courses as crs
            ON cls.course_id = crs.course_id
        LEFT OUTER JOIN course_prerequisites_view AS cpr
            ON cls.course_id = cpr.course_id
GROUP BY    class_id
ORDER BY    term_start_date DESC,
            course_discipline ASC,
            course_number ASC,
            section ASC;

DROP FUNCTION IF EXISTS get_term_id_by_class;
CREATE FUNCTION get_term_id_by_class(class_id_input INT)
RETURNS INT
RETURN (
    SELECT term_id
    FROM    classes
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS get_start_time_by_class;
CREATE FUNCTION get_start_time_by_class(class_id_input INT)
RETURNS INT
RETURN (
    SELECT  start_time
    FROM    classes
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS get_end_time_by_class;
CREATE FUNCTION get_end_time_by_class(class_id_input INT)
RETURNS INT
RETURN (
    SELECT end_time
    FROM    classes
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS get_class_max_capacity;
CREATE FUNCTION get_class_max_capacity(class_id_input INT)
RETURNS INT
RETURN (
    SELECT class_max_capacity
    FROM    classes
    WHERE   class_id = class_id_input
);


DROP FUNCTION IF EXISTS has_location_conflict;
CREATE FUNCTION has_location_conflict(
    building_name_input VARCHAR(64), 
    room_number_input INT, 
    term_id_input INT,
    class_schedule_id_input INT,
    start_time_input TIME, 
    end_time_input TIME)
RETURNS INT
RETURN (
    SELECT COUNT(class_id)
        FROM    classes
        WHERE   building_name = building_name_input
                AND room_number = room_number_input
                AND term_id = term_id_input
                AND find_class_schedule_conflict(class_schedule_id_input, class_schedule_id) <> 0
                AND (
                    ((start_time >= start_time_input) AND (start_time <= end_time_input))
                    OR
                    ((end_time >= start_time_input) AND (end_time <= end_time_input))
                )             
);

DROP FUNCTION IF EXISTS has_professor_conflict;
CREATE FUNCTION has_professor_conflict(
    professor_id_input INT, 
    term_id_input INT,
    class_schedule_id_input INT,
    start_time_input TIME, 
    end_time_input TIME)
RETURNS INT
RETURN (
    SELECT COUNT(class_id)
        FROM    classes
        WHERE   professor_id = professor_id_input
                AND term_id = term_id_input
                AND find_class_schedule_conflict(class_schedule_id_input, class_schedule_id) <> 0
                AND (
                    ((start_time >= start_time_input) AND (start_time <= end_time_input))
                    OR
                    ((end_time >= start_time_input) AND (end_time <= end_time_input))
                )             
);

 
DELIMITER $$
CREATE TRIGGER classes_insert
BEFORE INSERT ON classes FOR EACH ROW
BEGIN

    -- location conflict
    SET @location_conflicts = has_location_conflict(NEW.building_name, 
                                                    NEW.room_number, 
                                                    NEW.term_id, 
                                                    NEW.class_schedule_id,
                                                    NEW.start_time, 
                                                    NEW.end_time);
    IF (@location_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class already exists at that location on that time';
    END IF;

    -- professor conflict
    SET @professor_conflicts = has_professor_conflict(  NEW.professor_id, 
                                                        NEW.term_id, 
                                                        NEW.class_schedule_id,
                                                        NEW.start_time, 
                                                        NEW.end_time);
    IF (@professor_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Professor is already teaching a class on that time';
    END IF;

END; $$
DELIMITER ;


DELIMITER $$
CREATE TRIGGER classes_update
BEFORE UPDATE ON classes FOR EACH ROW
BEGIN

    -- location conflict
    IF (NEW.building_name <> OLD.building_name) OR (NEW.room_number <> OLD.room_number) THEN -- check if changed first
        SET @location_conflicts = has_location_conflict(NEW.building_name, 
                                                        NEW.room_number, 
                                                        NEW.term_id, 
                                                        NEW.class_schedule_id,
                                                        NEW.start_time, 
                                                        NEW.end_time);
        IF (@location_conflicts <> 0) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class already exists at that location on that time';
        END IF;
    END IF;

    -- professor conflict
    IF (NEW.professor_id <> OLD.professor_id) THEN -- check if changed first
        SET @professor_conflicts = has_professor_conflict(  NEW.professor_id, 
                                                            NEW.term_id, 
                                                            NEW.class_schedule_id,
                                                            NEW.start_time, 
                                                            NEW.end_time);
        IF (@professor_conflicts <> 0) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Professor is already teaching a class on that time';
        END IF;
    END IF;

END; $$
DELIMITER ;

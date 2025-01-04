CREATE TABLE student_class_history(
    student_id  INT,
    class_id    INT,
    grade       FLOAT(4) DEFAULT NULL,
    PRIMARY KEY (student_id, class_id),
    FOREIGN KEY (student_id) REFERENCES students (student_id) ON DELETE RESTRICT,
    FOREIGN KEY (class_id) REFERENCES classes (class_id) ON DELETE RESTRICT
);


CREATE VIEW student_class_history_view AS
SELECT  student_id,
        student_first_name,
        student_last_name,
        class_id,
        course_id
        course_discipline, 
        course_number,
        section,
        course_name,
        term_id,
        term_name,
        grade
FROM    student_class_history
        JOIN students
        USING(student_id)
        JOIN classes_view
        USING (class_id);


CREATE VIEW student_class_history_with_schedule_view AS
SELECT  student_id,
        student_first_name,
        student_last_name,
        class_id,
        course_id
        course_discipline, 
        course_number,
        section,
        course_name,
        term_id,
        term_name,
        grade,
        day_letter,
        start_time,
        end_time
FROM    student_class_history_view
        JOIN class_schedules
        USING(class_id);


DROP FUNCTION IF EXISTS get_class_current_size;
CREATE FUNCTION get_class_current_size(class_id_input INT)
RETURNS INT
RETURN (
    SELECT COUNT(student_id)
    FROM    student_class_history
    WHERE   class_id = class_id_input
    GROUP BY class_id
);

DROP FUNCTION IF EXISTS find_student_classes_time_conflicts;
CREATE FUNCTION find_student_classes_time_conflicts(student_id_input INT, class_id_input INT)
RETURNS INT
RETURN (
    SELECT  COUNT(*)
    FROM    classes_with_schedule_view AS c
            JOIN student_class_history_with_schedule_view AS s
                ON  c.term_id = s.term_id
                AND c.day_letter = s.day_letter
    WHERE   c.class_id = class_id_input
            AND s.student_id = student_id_input
            AND find_time_conflict(s.start_time, s.end_time, c.start_time, c.end_time) <> 0;     

);

DROP FUNCTION IF EXISTS find_course_prerequisites_conflicts;
CREATE FUNCTION find_course_prerequisites_conflicts(student_id_input INT, class_id_input INT)



DELIMITER $$
CREATE TRIGGER student_class_history_insert
BEFORE INSERT ON student_class_history FOR EACH ROW
BEGIN

    -- class size constraint
    SET @current_class_size = get_class_current_size(NEW.class_id);
    SET @max_capacity = get_class_max_capacity(NEW.class_id);
    IF (@current_class_size >= @max_capacity) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class is currently full';
    END IF;

    -- time constraint
    SET @time_conflicts = find_student_classes_time_conflicts(NEW.student_id, NEW.class_id);
    IF (@time_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Already enrolled in another class at that time';
    END IF;

END; $$
DELIMITER ;        


DELIMITER $$
CREATE TRIGGER student_class_history_update
BEFORE UPDATE ON student_class_history FOR EACH ROW
BEGIN

    IF (NEW.class_id <> OLD.class_id) THEN -- only if class is changed

        -- class size constraint
        SET @current_class_size = get_class_current_size(NEW.class_id);
        SET @max_capacity = get_class_max_capacity(NEW.class_id);
        IF (@current_class_size >= @max_capacity) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class is currently full';
        END IF;


        -- time constraint
        SET @time_conflicts = find_student_classes_time_conflicts(NEW.student_id, NEW.class_id);
        IF (@time_conflicts <> 0) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Already enrolled in another class at that time';
        END IF;

    END IF;     

END; $$
DELIMITER ;        
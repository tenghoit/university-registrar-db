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


DROP FUNCTION IF EXISTS get_num_student_class_by_term_time;
CREATE FUNCTION get_num_student_class_by_term_time(
    term_id_input INT,
    time_start_input TIME, 
    time_end_input TIME,
    student_id_input INT)
RETURNS INT
RETURN (
    SELECT COUNT(class_id)
        FROM    student_class_history_view_min
        WHERE   student_id = student_id_input
                AND term_id = term_id_input
                AND (
                    ((time_start >= time_start_input) AND (time_start <= time_end_input))
                    OR
                    ((time_end >= time_start_input) AND (time_end <= time_end_input))
                )             
);

DROP FUNCTION IF EXISTS find_time_conflicts;
CREATE FUNCTION find_time_conflicts(student_id_input INT, class_id_input INT)
RETURNS INT
RETURN (
    SELECT
);

DELIMITER $$
CREATE TRIGGER student_class_history_insert
BEFORE INSERT ON student_class_history FOR EACH ROW
BEGIN

    SET @current_class_size = get_class_current_size(NEW.class_id);
    SET @max_capacity = get_class_max_capacity(NEW.class_id);

    -- class size constraint
    IF (@current_class_size >= @max_capacity) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class is currently full';
    END IF;

    -- time constraint
    -- SET @current_term_id = get_term_id_by_class(NEW.class_id);
    -- SET @current_time_start = get_time_start_by_class(NEW.class_id);
    -- SET @current_time_end = get_time_end_by_class(NEW.class_id);
    SET @time_conflicts = find_time_conflicts(NEW.student_id, NEW.class_id);

    IF (@num_classes_at_current_time <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Already enrolled in another class at that time';
    END IF;

END; $$
DELIMITER ;        


DELIMITER $$
CREATE TRIGGER student_class_history_update
BEFORE UPDATE ON student_class_history FOR EACH ROW
BEGIN

    SET @current_class_size = get_class_current_size(NEW.class_id);
    SET @max_capacity = get_class_max_capacity(NEW.class_id);

    -- class size constraint
    IF (NEW.class_id <> OLD.class_id) THEN
        IF (@current_class_size >= @max_capacity) THEN
            SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class is currently full';
        END IF;
    END IF;     

    -- time constraint
    -- SET @current_term = get_term_id_by_class(NEW.class_id);
    -- SET @new_time_start = get_time_start_by_class(NEW.class_id);
    -- SET @new_time_end = get_time_end_by_class(NEW.class_id);
    -- SET @num_classes_at_current_time = get_num_student_class_by_term_time(@current_term, @new_time_start, @new_time_end, NEW.student_id);

    -- SET @old_time_start = get_time_start_by_class(OLD.class_id);
    -- SET @old_time_end = get_time_end_by_class(OLD.class_id);

    -- IF (@new_time_start <> @old_time_start) OR (@new_time_end <> @old_time_end) THEN
    --     IF (@num_classes_at_current_time <> 0) THEN
    --         SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Already enrolled in another class at that time';
    --     END IF; 
    -- END IF; 

END; $$
DELIMITER ;        
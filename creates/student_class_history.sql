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


DROP FUNCTION IF EXISTS find_available_class_capacity;
CREATE FUNCTION find_available_class_capacity(class_id_input INT)
RETURNS INT
RETURN (
    SELECT  (class_max_capacity - class_current_capacity)
    FROM    classes_full_view
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS student_course_exists;
CREATE FUNCTION student_course_exists(student_id_input INT, course_id_input INT)
RETURNS INT
RETURN (
    SELECT  COUNT(*)
    FROM    student_class_history_view
    WHERE   student_id = student_id_input
            AND course_id = course_id_input
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
CREATE FUNCTION find_course_prerequisites_conflicts(student_id_input INT, course_id_input INT)
RETURNS INT
RETURN (
    SELECT  COUNT(*)
    FROM    course_prerequisites
    WHERE   course_id = course_id_input
            AND student_course_exists(student_id_input, prerequisite_id) = 0 
);       

DELIMITER $$
CREATE TRIGGER student_class_history_insert
BEFORE INSERT ON student_class_history FOR EACH ROW
BEGIN

    -- class size constraint
    SET @available_capacity = find_available_class_capacity(NEW.class_id);
    IF (@available_capacity <= 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Class is currently full';
    END IF;

    -- time constraint
    SET @time_conflicts = find_student_classes_time_conflicts(NEW.student_id, NEW.class_id);
    IF (@time_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Already enrolled in another class at that time';
    END IF;

    -- prereq conflict
    SET @prerequisites_conflicts = find_course_prerequisites_conflicts(NEW.student_id, get_course_id_by_class(NEW.class_id));
    IF (@prerequisites_conflicts <> 0) THEN
        SIGNAL SQLSTATE '45000' SET MESSAGE_TEXT = 'Has not met all course prerequisites';
    END IF;


END; $$
DELIMITER ;       
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
        student_name,
        class_id,
        course_id,
        course_discipline, 
        course_number,
        section,
        class_code,
        course_name,
        term_id,
        term_name,
        grade
FROM    student_class_history
        JOIN students_view
        USING(student_id)
        JOIN classes_view
        USING (class_id);


CREATE VIEW student_class_history_with_schedule_view AS
SELECT  student_id,
        student_first_name,
        student_last_name,
        student_name,
        class_id,
        course_id,
        course_discipline, 
        course_number,
        section,
        class_code,
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


CREATE VIEW classes_full_view AS 
SELECT      c.class_id                  AS class_id, 
            c.course_id                 AS course_id,
            c.course_discipline         AS course_discipline,
            c.course_number             AS course_number,
            c.section                   AS section,
            c.course_name               AS course_name,
            c.term_id                   AS term_id,
            c.term_name                 AS term_name,
            c.professor_id              AS professor_id,
            c.professor_first_name      AS professor_first_name,
            c.professor_last_name       AS professor_last_name,
            c.building_name             AS building_name,
            c.room_number               AS room_number,      
            COUNT(student_id)           AS class_current_capacity,      
            c.class_max_capacity        AS class_max_capacity,
            schedule,
            prerequisites
FROM        classes_view AS c
            LEFT OUTER JOIN class_schedules_single_view
            ON class_schedules_single_view.class_id = c.class_id
            LEFT OUTER JOIN course_prerequisites_single_view
            ON c.course_id = primary_course_id
            LEFT OUTER JOIN student_class_history_view
            ON c.class_id = student_class_history_view.class_id
GROUP BY    class_id;
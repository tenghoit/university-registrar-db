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


CREATE VIEW classes_full_view AS 
SELECT      class_id, 
            course_id,
            course_discipline,
            course_number,
            section,
            course_name,
            term_id,
            term_name,
            professor_id,
            professor_first_name,
            professor_last_name,
            building_name,
            room_number,      
            COUNT(student_id) AS class_current_capacity,      
            class_max_capacity,
            schedule,
            prerequisites
FROM        classes_view
            JOIN class_schedules_single_view
            USING(class_id)
            LEFT OUTER JOIN course_prerequisites_single_view
            ON course_id = primary_course.course_id
            JOIN student_class_history_view
            USING(class_id)
GROUP BY    class_id;
CREATE TABLE student_degrees (
    student_id  INT,
    degree_id   INT,
    PRIMARY KEY (student_id, degree_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (degree_id) REFERENCES degrees(degree_id) ON DELETE RESTRICT
);

CREATE VIEW student_degrees_view AS
SELECT  student_id,
        student_first_name,
        student_last_name,
        student_name,
        degree_id,
        degree_name,
        degree_type
FROM    student_degrees
        JOIN students_view
        USING(student_id)
        JOIN degrees_view
        USING(degree_id);
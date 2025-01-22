CREATE TABLE student_advisors (
    student_id      INT,
    professor_id    INT,
    PRIMARY KEY (student_id, professor_id),
    FOREIGN KEY (student_id) REFERENCES students(student_id) ON DELETE CASCADE,
    FOREIGN KEY (professor_id) REFERENCES professors(professor_id) ON DELETE RESTRICT
);

CREATE VIEW student_advisors_view AS
SELECT  student_id,
        student_first_name,
        student_last_name,
        student_name,
        professor_id,
        professor_first_name,
        professor_last_name,
        professor_name
FROM    student_advisors
        JOIN students_view AS s
        USING(student_id)
        JOIN professors_view AS p
        USING(professor_id);


CREATE VIEW student_advisors_single_view AS
SELECT  student_id
        student_first_name,
        student_last_name,
        student_name,
        GROUP_CONCAT(professor_name) AS advisors
FROM    student_advisors_view
GROUP BY    (student_id);


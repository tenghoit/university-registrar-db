-- Creating the students table
CREATE TABLE students (
    student_id              INT,
    student_enrollment_date DATE,
    student_advisor_id      INT,
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    FOREIGN KEY (student_advisor_id) REFERENCES professors(professor_id) ON DELETE SET NULL,
    PRIMARY KEY (student_id)
);

-- Optional view for listing student details
CREATE VIEW students_view AS
SELECT  student_id,
        user_first_name             AS student_first_name,
        user_last_name              AS student_last_name,
        user_email                  AS student_email,
        user_phone_number           AS student_phone_number,
        user_street                 AS student_street,
        user_city                   AS student_city,
        user_state                  AS student_state,
        user_zip_code               AS student_zip_code
        student_enrollment_date,
        student_advisor_id,
        professor.user_first_name   AS advisor_first_name,
        professor.user_last_name    AS advisor_last_name
FROM    students
        JOIN users
        ON user_id = student_id
        JOIN users AS professor
        ON student_advisor_id = professor.user_id;

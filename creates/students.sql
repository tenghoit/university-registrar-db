-- Creating the students table
CREATE TABLE students (
    student_id              INT,
    student_enrollment_date DATE DEFAULT CURRENT_DATE,
    FOREIGN KEY (student_id) REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (student_id)
);

-- Optional view for listing student details
CREATE VIEW students_view AS
SELECT  student_id,
        user_first_name         AS student_first_name,
        user_last_name          AS student_last_name,
        user_name               AS student_name,
        user_email              AS student_email,
        user_phone_number       AS student_phone_number,
        user_address            AS student_address,
        user_city               AS student_city,
        user_state              AS student_state,
        user_zip_code           AS student_zip_code,
        student_enrollment_date
FROM    students
        JOIN users_view
        ON user_id = student_id;


DROP FUNCTION IF EXISTS is_student;
CREATE FUNCTION is_student(user_id_input INT)
RETURNS INT
RETURN (
    SELECT  COUNT(*)
    FROM    students_view
    WHERE   student_id = user_id_input
);
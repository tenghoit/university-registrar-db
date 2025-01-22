-- Creating the professors table
CREATE TABLE professors (
    professor_id INT,
    FOREIGN KEY (professor_id) REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (professor_id)
);

-- Optional view for listing professor details
CREATE VIEW professors_view AS
SELECT  professor_id,
        user_first_name     AS professor_first_name,
        user_last_name      AS professor_last_name,
        CONCAT(user_first_name, ' ', user_last_name) AS professor_name,
        user_email          AS professor_email,
        user_phone_number   AS professor_phone_number,
        user_address        AS professor_address,
        user_city           AS professor_city,
        user_state          AS professor_state,
        user_zip_code       AS professor_zip_code
FROM    professors
        JOIN users
        ON user_id = professor_id;


DROP FUNCTION IF EXISTS is_professor;
CREATE FUNCTION is_professor(user_id_input INT)
RETURNS INT
RETURN (
    SELECT  COUNT(*)
    FROM    professors_view
    WHERE   professor_id = user_id_input
);
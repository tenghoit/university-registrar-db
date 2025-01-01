-- Creating the professors table
CREATE TABLE professors (
    user_id INT,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id)
);

-- Optional view for listing professor details
CREATE VIEW professors_view AS
SELECT  user_id             AS professor_id,
        user_first_name     AS professor_first_name,
        user_last_name      AS professor_last_name,
        user_email          AS professor_email,
        user_phone_number   AS professor_phone_number,
        user_street         AS professor_street,
        user_city           AS professor_city,
        user_state          AS professor_state,
        user_zip_code       AS professor_zip_code
FROM    users;

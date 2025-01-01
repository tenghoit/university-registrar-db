-- Creating the admins table
CREATE TABLE admins (
    user_id INT,
    PRIMARY KEY (user_id)
);

-- Optional view for listing admin details
CREATE VIEW admins_view AS
SELECT  user_id             AS admin_id,
        user_first_name     AS admin_first_name,
        user_last_name      AS admin_last_name,
        user_email          AS admin_email,
        user_phone_number   AS admin_phone_number,
        user_street         AS admin_street,
        user_city           AS admin_city,
        user_state          AS admin_state,
        user_zip_code       AS admin_zip_code
FROM    users;

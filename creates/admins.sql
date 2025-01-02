-- Creating the admins table
CREATE TABLE admins (
    admin_id INT,
    FOREIGN KEY (admin_id) REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (admin_id)
);

-- Optional view for listing admin details
CREATE VIEW admins_view AS
SELECT  admin_id,
        user_first_name     AS admin_first_name,
        user_last_name      AS admin_last_name,
        user_email          AS admin_email,
        user_phone_number   AS admin_phone_number,
        user_street         AS admin_street,
        user_city           AS admin_city,
        user_state          AS admin_state,
        user_zip_code       AS admin_zip_code
FROM    admins
        JOIN users
        ON user_id = admin_id;
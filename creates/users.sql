CREATE TABLE users (
    user_id             INT AUTO_INCREMENT,
    user_first_name     VARCHAR(128) NOT NULL,
    user_last_name      VARCHAR(128) NOT NULL,
    user_email          VARCHAR(256) NOT NULL,
    user_phone_number   VARCHAR(16) NOT NULL,
    user_street         VARCHAR(128) NOT NULL,
    user_city           VARCHAR(64) NOT NULL,
    user_state          VARCHAR(2) NOT NULL,
    user_zip_code       VARCHAR(8) NOT NULL,
    PRIMARY KEY (user_id)
);

CREATE VIEW users_view AS
SELECT  user_id,
        user_first_name,
        user_last_name,
        user_email,
        user_phone_number,
        user_street,
        user_city,
        user_state,
        user_zip_code
FROM    users;

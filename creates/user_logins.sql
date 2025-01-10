CREATE TABLE user_logins (
    user_id         INT,
    user_login_name VARCHAR(128),
    user_login_hash VARCHAR(512),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id)
);

DELIMITER $$
DROP FUNCTION IF EXISTS get_user_role;
CREATE FUNCTION get_user_role(user_id_input INT)
RETURNS VARCHAR(64)
BEGIN
    DECLARE user_role VARCHAR(64);

    IF(is_student(user_id_input) = 1) THEN
        SET user_role = 'student';
    ELSEIF(is_professor(user_id_input) = 1) THEN
        SET user_role = 'professor';
    ELSEIF(is_admin(user_id_input) = 1) THEN
        SET user_role = 'admin';
    ELSE
        SET user_role = NULL;
    END IF;

    RETURN user_role;
    
END; $$
DELIMITER ;

CREATE VIEW user_logins_view AS
SELECT  user_id,
        user_login_name,
        user_login_hash,
        get_user_role(user_id) AS user_role
FROM    user_logins;
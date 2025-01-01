CREATE TABLE user_logins (
    user_id         INT,
    user_login_name VARCHAR(128),
    user_login_hash VARCHAR(512),
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
    PRIMARY KEY (user_id)
);

CREATE VIEW user_logins_vieww AS
SELECT  user_id,
        user_login_name,
        user_login_hash
FROM    user_logins;
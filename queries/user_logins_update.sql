UPDATE user_logins
SET     user_login_name = :user_login_name,
        user_login_hash = :user_login_hash
WHERE   user_id = :user_id;

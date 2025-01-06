INSERT INTO user_logins (
    user_id,
    user_login_name,
    user_login_hash
)
VALUES (:user_id, :user_login_name, :user_login_hash);

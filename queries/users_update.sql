UPDATE users
SET user_first_name = :user_first_name, 
    user_last_name = :user_last_name, 
    user_email = :user_email, 
    user_phone_number = :user_phone_number, 
    user_street = :user_street, 
    user_city = :user_city, 
    user_state = :user_state, 
    user_zip_code = :user_zip_code
WHERE user_id = :user_id;
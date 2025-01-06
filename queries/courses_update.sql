UPDATE courses
SET     course_discipline = :course_discipline, 
        course_number = :course_number, 
        course_name = :course_name, 
        course_credits = :course_credits, 
        course_description = :course_description
WHERE   course_id = :course_id;

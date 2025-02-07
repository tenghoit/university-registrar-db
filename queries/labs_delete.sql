DELETE FROM labs
WHERE   course_id = :course_id
        AND parent_course_id = :parent_course_id;
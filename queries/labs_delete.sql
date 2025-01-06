DELETE FROM labs
WHERE   course_id = :course_id
        AND prerequisite_id = :prerequisite_id;
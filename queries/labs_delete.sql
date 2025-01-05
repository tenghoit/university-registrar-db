DELETE FROM labs
WHERE   course_id = ?
        AND prerequisite_id = ?;
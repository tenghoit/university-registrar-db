UPDATE courses
SET     course_discipline = ?,
        course_number = ?,
        course_credits = ?,
        course_description = ?
WHERE course_id = ?;

DELETE FROM student_degrees
WHERE   student_id = :student_id
        AND degree_id = :degree_id;
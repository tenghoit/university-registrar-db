DELETE FROM student_advisors
WHERE   student_id = :student_id
        AND professor_id = :professor_id;

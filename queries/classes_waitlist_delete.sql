DELETE FROM classes_waitlist
WHERE   student_id = :student_id
        AND class_id = :student_id;
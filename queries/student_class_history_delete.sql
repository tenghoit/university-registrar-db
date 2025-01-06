DELETE FROM student_class_history
WHERE   student_id = :student_id
        AND class_id = :class_id;
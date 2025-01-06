UPDATE student_class_history
SET     grade = :grade
WHERE   student_id = :student_id
        AND class_id = :class_id;

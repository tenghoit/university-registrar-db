DELETE FROM class_schedules
WHERE   class_id = :class_id
        AND day_letter = :day_letter
        AND start_time = :start_time
        AND end_time = :end_time;

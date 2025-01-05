DELETE FROM class_schedules
WHERE   class_id = ?
        AND day_letter = ?
        AND start_time = ?
        AND end_time = ?;
UPDATE class_schedules
SET     day_letter = ?,
        start_time = ?,
        end_time = ?
WHERE   class_id = ?
        AND day_letter = ?
        AND start_time = ?
        AND end_time = ?;
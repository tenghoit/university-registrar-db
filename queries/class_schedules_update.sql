UPDATE class_schedules
SET     day_letter = :day_letter,
        start_time = :start_time,
        end_time = :end_time
WHERE   class_id = :class_id
        AND day_letter = :old_day_letter
        AND start_time = :old_start_time
        AND end_time = :old_end_time;

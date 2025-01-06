DELETE FROM time_blocks
WHERE   start_time = :start_time
        AND  end_time = :end_time;

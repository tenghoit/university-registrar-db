DELETE FROM time_blocks
WHERE   start_time = ?
        AND  end_time = ?;

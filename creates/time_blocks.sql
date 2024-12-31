CREATE TABLE time_blocks(
    start_time   TIME,
    end_time     TIME,
    PRIMARY KEY (start_time, end_time)
);

CREATE VIEW time_blocks_view AS
SELECT  start_time,
        end_time
FROM time_blocks;


DELIMITER $$
DROP FUNCTION IF EXISTS find_time_conflict$$
CREATE FUNCTION find_time_conflict(
    start_time_1 TIME,
    end_time_1 TIME,
    start_time_2 TIME,
    end_time_2 TIME
)   
RETURNS INT
DETERMINISTIC
BEGIN
    RETURN (
        ((start_time_1 >= start_time_2) AND (start_time_1 <= end_time_2)) -- starts during
        OR
        ((end_time_1 >= start_time_2) AND (end_time_1 <= end_time_2)) -- ends during
        OR
        ((start_time_1 <= start_time_2) AND (end_time_1 >= end_time_2)) -- complete overlap
    );
END$$
DELIMITER ;

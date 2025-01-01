CREATE TABLE class_schedules(
    class_id   INT,
    day_letter          VARCHAR(8),
    start_time          TIME,
    end_time            TIME,
    PRIMARY KEY (class_id, day_letter, start_time, end_time),
    FOREIGN KEY (day_letter) REFERENCES days (day_letter) ON DELETE RESTRICT,
    FOREIGN KEY (start_time) REFERENCES time_blocks (start_time) ON DELETE RESTRICT,
    FOREIGN KEY (end_time) REFERENCES time_blocks (end_time) ON DELETE RESTRICT,
);


CREATE VIEW class_schedules_view AS
SELECT  class_id,
        GROUP_CONCAT(
            DISTINCT CONCAT(
                GROUP_CONCAT(DISTINCT day_letter ORDER BY FIELD(day_letter, 'M', 'T', 'W', 'R', 'F', 'S', 'U') SEPARATOR ''),
                ' ',
                DATE_FORMAT(start_time, '%l:%i%p'),  -- Format the start time (e.g., 1:00pm)
                '-',
                DATE_FORMAT(end_time, '%l:%i%p')  -- Format the end time (e.g., 2:00pm)
            )
            ORDER BY start_time
            SEPARATOR ', '
        ) AS schedule
FROM    class_schedules
GROUP BY    class_id;



-- CREATE VIEW class_schedule_conflicts_view AS
-- SELECT  cs1.class_schedule_id,
--         cs2.class_schedule_id
-- FROM    class_schedules as cs1
--         JOIN class_schedules as cs2
--         ON cs1.day_letter = cs2.day_letter; -- check if have same day


-- DROP FUNCTION IF EXISTS find_class_schedule_conflict
-- CREATE FUNCTION find_class_schedule_conflict(class_schedule_id_one_input INT, class_schedule_id_two_input INT)
-- RETURNS INT
-- RETURN (
-- SELECT COUNT(*)
-- FROM    class_schedule_conflicts_view
-- WHERE   cs1.class_schedule_id = class_schedule_id_one_input
--         AND cs2.class_schedule_id = class_schedule_id_two_input
-- );



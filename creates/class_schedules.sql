CREATE TABLE class_schedules(
    class_id   INT,
    day_letter VARCHAR(1),
    start_time TIME,
    end_time   TIME,
    PRIMARY KEY (class_id, day_letter, start_time, end_time),
    FOREIGN KEY (class_id) REFERENCES classes (class_id) ON DELETE RESTRICT,
    FOREIGN KEY (day_letter) REFERENCES days_of_the_week (day_letter) ON DELETE RESTRICT,
    FOREIGN KEY (start_time, end_time) REFERENCES time_blocks (start_time, end_time) ON DELETE RESTRICT
);

CREATE VIEW class_schedules_view AS
SELECT  class_id, 
        course_id
        course_discipline,
        course_number,
        section,
        class_code,
        course_name,
        term_id,
        term_name,
        professor_id,
        professor_first_name,
        professor_last_name,
        professor_name,
        building_name,
        room_number,
        location,
        day_letter,
        start_time,
        end_time
FROM    class_schedules
        JOIN classes_view
        USING (class_id);


-- CREATE VIEW class_schedules_single_view AS
-- SELECT  class_id,
--         GROUP_CONCAT(
--             DISTINCT CONCAT(
--                 day_letter,
--                 ' ',
--                 DATE_FORMAT(start_time, '%l:%i%p'),  -- Format the start time (e.g., 1:00pm)
--                 '-',
--                 DATE_FORMAT(end_time, '%l:%i%p')   -- Format the end time (e.g., 2:00pm)
--             )
--             ORDER BY FIELD(day_letter, 'M', 'T', 'W', 'R', 'F', 'S', 'U'), start_time
--             SEPARATOR ', '
--         ) AS schedule
-- FROM    class_schedules_view
-- GROUP BY    class_id;


CREATE VIEW grouped_schedules AS
SELECT  class_id,
        start_time,
        end_time,
        GROUP_CONCAT(
            DISTINCT day_letter
            ORDER BY FIELD(day_letter, 'M', 'T', 'W', 'R', 'F', 'S', 'U')
            SEPARATOR ''
        ) AS grouped_days
FROM    class_schedules_view
GROUP BY    class_id, 
            start_time, 
            end_time;

CREATE VIEW class_schedules_single_view AS
SELECT  class_id,
        GROUP_CONCAT(
            DISTINCT CONCAT(
                grouped_days, ' ',
                DATE_FORMAT(start_time, '%l:%i%p'),  -- Format the start time (e.g., 8:00 AM)
                '-',
                DATE_FORMAT(end_time, '%l:%i%p')    -- Format the end time (e.g., 9:00 AM)
            )
            ORDER BY FIELD(grouped_days, 'M', 'T', 'W', 'R', 'F', 'S', 'U'), start_time
            SEPARATOR ', '
        ) AS schedule
FROM    grouped_schedules
GROUP BY    class_id;

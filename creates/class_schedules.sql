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
        section,
        term_id,
        professor_id,
        building_name,
        room_number,
        class_max_capacity,
        day_letter,
        start_time,
        end_time
FROM    class_schedules
        JOIN classes
        USING (class_id);


CREATE VIEW class_schedules_single_view AS
SELECT  class_id,
        GROUP_CONCAT(
            DISTINCT CONCAT(
                day_letter,
                ' ',
                DATE_FORMAT(start_time, '%l:%i%p'),  -- Format the start time (e.g., 1:00pm)
                '-',
                DATE_FORMAT(end_time, '%l:%i%p')   -- Format the end time (e.g., 2:00pm)
            )
            ORDER BY FIELD(day_letter, 'M', 'T', 'W', 'R', 'F', 'S', 'U'), start_time
            SEPARATOR ', '
        ) AS schedule
FROM    class_schedules_view
GROUP BY    class_id;

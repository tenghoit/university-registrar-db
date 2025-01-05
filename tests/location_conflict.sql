INSERT INTO classes (
    course_id,
    term_id,
    building_name,
    room_number,
    professor_id,
    section,
    class_max_capacity
)
VALUES
    (1, 1, 'OLIN', '101', 1, 'a', 25), -- 1
    (2, 1, 'OLIN', '101', 2, 'b', 25); -- 2

SELECT * FROM classes_view;

INSERT INTO class_schedules(
    class_id,
    day_letter,
    start_time,
    end_time
)
VALUES
    (1, 'M', '08:00:00', '09:00:00'),
    (2, 'M', '08:00:00', '09:00:00');


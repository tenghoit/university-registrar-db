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
    (1, 1, 'OLIN', '101', 1, 'a', 2); -- 1

SELECT * FROM classes_view;

INSERT INTO class_schedules(
    class_id,
    day_letter,
    start_time,
    end_time
)
VALUES
    (1, 'M', '08:00:00', '09:00:00'),
    (1, 'W', '08:00:00', '09:00:00'),
    (1, 'F', '08:00:00', '09:00:00'),
    (1, 'T', '09:10:00', '10:10:00');

SELECT * FROM class_schedules_view;

INSERT INTO student_class_history(
    student_id,
    class_id
)
VALUES
    (3, 1),
    (4, 1);


SELECT * FROM student_class_history_view;

SELECT * FROM classes_full_view;

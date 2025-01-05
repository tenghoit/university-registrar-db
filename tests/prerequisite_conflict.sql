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
    (1, 1, 'OLIN', '101', 1, 'a', 20), -- 1
    (2, 1, 'OLIN', '102', 2, 'a', 20); -- 2

SELECT * FROM classes_view;

INSERT INTO student_class_history(
    student_id,
    class_id
)
VALUES
    -- (3, 1),
    (3, 2);

SELECT * FROM student_class_history_view;

SELECT * FROM classes_full_view;
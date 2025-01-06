INSERT INTO classes (
    course_id, 
    section,
    term_id,
    professor_id, 
    building_name, 
    room_number,
    class_max_capacity
)
VALUES (:course_id, :section, :term_id, :professor_id, :building_name, :room_number, :class_max_capacity);

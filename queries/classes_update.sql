UPDATE classes
SET     course_id = :course_id,
        section = :section,
        term_id = :term_id,
        professor_id = :professor_id,
        building_name = :building_name,
        room_number = :room_number,
        class_max_capacity = :class_max_capacity
WHERE   class_id = :class_id;

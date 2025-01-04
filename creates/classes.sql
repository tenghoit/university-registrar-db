CREATE TABLE classes (
    class_id            INT AUTO_INCREMENT,
    course_id           INT,
    term_id             INT,
    building_name       VARCHAR(64),
    room_number         VARCHAR(64),
    professor_id        INT,
    section             VARCHAR(1) DEFAULT 'a',
    class_max_capacity  INT DEFAULT 25,
    PRIMARY KEY (class_id),
    FOREIGN KEY (course_id) REFERENCES courses (course_id) ON DELETE RESTRICT,
    FOREIGN KEY (term_id) REFERENCES terms (term_id) ON DELETE RESTRICT,
    FOREIGN KEY (building_name, room_number) REFERENCES locations (building_name, room_number) ON DELETE SET NULL,
    FOREIGN KEY (professor_id) REFERENCES professors (professor_id) ON DELETE RESTRICT,
    UNIQUE (course_id, term_id, section)
);


CREATE VIEW classes_view AS
SELECT      class_id, 
            course_id,
            course_discipline,
            course_number,
            section,
            course_name,
            term_id,
            term_name,
            professor_id,
            professor_first_name,
            professor_last_name,
            building_name,
            room_number,
            class_max_capacity
FROM        classes
            JOIN courses_view
                USING (course_id)
            JOIN terms_view
                USING (term_id)
            JOIN professors_view
                USING (professor_id);


DROP FUNCTION IF EXISTS get_building_name_by_class;
CREATE FUNCTION get_building_name_by_class(class_id_input INT)
RETURNS VARCHAR(64)
RETURN (
    SELECT  building_name
    FROM    classes
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS get_room_number_by_class;
CREATE FUNCTION get_room_number_by_class(class_id_input INT)
RETURNS VARCHAR(64)
RETURN (
    SELECT  room_number
    FROM    classes
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS get_course_id_by_class;
CREATE FUNCTION get_course_id_by_class(class_id_input INT)
RETURNS INT
RETURN (
    SELECT  course_id
    FROM    classes
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS get_term_id_by_class;
CREATE FUNCTION get_term_id_by_class(class_id_input INT)
RETURNS INT
RETURN (
    SELECT  term_id
    FROM    classes
    WHERE   class_id = class_id_input
);

DROP FUNCTION IF EXISTS get_professor_id_by_class;
CREATE FUNCTION get_professor_id_by_class(class_id_input INT)
RETURNS INT
RETURN (
    SELECT  professor_id
    FROM    classes
    WHERE   class_id = class_id_input
);


DROP FUNCTION IF EXISTS get_class_max_capacity;
CREATE FUNCTION get_class_max_capacity(class_id_input INT)
RETURNS INT
RETURN (
    SELECT class_max_capacity
    FROM    classes
    WHERE   class_id = class_id_input
);
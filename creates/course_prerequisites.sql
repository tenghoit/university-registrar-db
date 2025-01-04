CREATE TABLE course_prerequisites(
    course_id       INT,
    prerequisite_id INT,
    PRIMARY KEY (course_id, prerequisite_id),
    FOREIGN KEY (course_id) REFERENCES courses (course_id) ON DELETE RESTRICT,
    FOREIGN KEY (prerequisite_id) REFERENCES courses (course_id) ON DELETE RESTRICT
);


CREATE VIEW course_prerequisites_view AS
SELECT      primary_course.course_id                AS primary_course_id,
            primary_course.course_discipline        AS primary_course_discipline,
            primary_course.course_number            AS primary_course_number,
            primary_course.course_name              AS primary_course_name,
            prerequisite_course.course_id           AS prerequisite_course_id,
            prerequisite_course.course_discipline   AS prerequisite_course_discipline,
            prerequisite_course.course_number       AS prerequisite_course_number,
            prerequisite_course.course_name         AS prerequisite_course_name
FROM        course_prerequisites
            JOIN courses AS primary_course
            ON course_prerequisites.course_id = primary_course.course_id
            JOIN courses AS prerequisite_course
            ON course_prerequisites.prerequisite_id = prerequisite_course.course_id
ORDER BY    primary_course_discipline ASC,
            primary_course_number ASC;



CREATE VIEW course_prerequisites_single_view AS
SELECT      primary_course_id,
            primary_course_discipline,
            primary_course_number,
            primary_course_name,
            GROUP_CONCAT( DISTINCT CONCAT(prerequisite_course_discipline, ' ', prerequisite_course_number)
                        ORDER BY prerequisite_course_discipline, prerequisite_course_number ASC ) AS prerequisites
FROM        course_prerequisites_view
GROUP BY    primary_course_id;

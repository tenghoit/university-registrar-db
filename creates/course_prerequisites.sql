CREATE TABLE course_prerequisites(
    course_id       INT,
    prerequisite_id INT,
    PRIMARY KEY (course_id, prerequisite_id),
    FOREIGN KEY (course_id) REFERENCES courses (course_id) ON DELETE RESTRICT,
    FOREIGN KEY (prerequisite_id) REFERENCES courses (course_id) ON DELETE RESTRICT
);


CREATE VIEW course_prerequisites_view AS
SELECT      primary_course.course_id,
            primary_course.course_discipline,
            primary_course.course_number,
            primary_course.course_name,
            prerequisite_course.course_id,
            prerequisite_course.course_discipline,
            prerequisite_course.course_number,
            prerequisite_course.course_name,
FROM        course_prerequisites
            JOIN courses AS primary_course
            ON course_prerequisites.course_id = primary_course.course_id
            JOIN courses AS prerequisite_course
            ON course_prerequisites.prerequisite_id = prerequisite_course.course_id
ORDER BY    primary_course.course_discipline ASC,
            primary_course.course_number ASC;


CREATE VIEW course_prerequisites_single_view AS
SELECT      primary_course.course_id,
            primary_course.course_discipline,
            primary_course.course_number,
            primary_course.course_name,
            GROUP_CONCAT( DISTINCT CONCAT(prerequisite_course.course_discipline, ' ', prerequisite_course.course_number)
                        ORDER BY prerequisite_course.course_discipline, prerequisite_course.course_number ASC ) AS prerequisites
FROM        course_prerequisites_view
GROUP BY    primary_course.course_id;


DROP FUNCTION IF EXISTS met_course_prerequisites;
CREATE FUNCTION met_course_prerequisites (course_id_input INT, student_id_input INT)
RETURNS INT
RETURN (
    SELECT  COUNT(*)
    FROM    course_prerequisites
            LEFT OUTER student_class_history
            USING student_id_input
    WHERE   course_prerequisites.course_id = course_id_input
            AND student_class_history.course_id = prerequisite_id;
);
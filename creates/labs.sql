CREATE TABLE labs (
    course_id           INT,
    parent_course_id    INT,
    PRIMARY KEY (course_id),
    FOREIGN KEY (course_id) REFERENCES courses (course_id) ON DELETE CASCADE,
    FOREIGN KEY (parent_course_id) REFERENCES courses (course_id) ON DELETE CASCADE
);

CREATE VIEW labs_view AS
SELECT      primary_course.course_id            AS primary_course_id,
            primary_course.course_discipline    AS primary_course_discipline,
            primary_course.course_number        AS primary_course_number,
            primary_course.course_name          AS primary_course_name,
            parent_course.course_id             AS parent_course_id,
            parent_course.course_discipline     AS parent_course_discipline,
            parent_course.course_number         AS parent_course_number,
            parent_course.course_name           AS parent_course_name
FROM        labs
            JOIN courses AS primary_course
            ON primary_course.course_id = labs.course_id
            JOIN courses AS parent_course
            ON parent_course.course_id = labs.parent_course_id
ORDER BY    primary_course.course_discipline ASC,
            primary_course.course_number ASC;

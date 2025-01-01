CREATE TABLE labs (
    course_id           INT,
    parent_course_id    INT,
    PRIMARY KEY (course_id),
    FOREIGN KEY (parent_course_id) REFERENCES courses (course_id) ON DELETE CASCADE
)

CREATE VIEW labs_view AS
SELECT  course_id,
        parent_course_id
FROM    labs;
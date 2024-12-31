CREATE TABLE courses (
    course_id           INT AUTO_INCREMENT,
    course_discipline   VARCHAR(64),
    course_number       VARCHAR(8),
    course_name         VARCHAR(128),
    course_credits      INT,
    course_description  VARCHAR(512),
    PRIMARY KEY (course_id),
    CONSTRAINT unique_course UNIQUE (course_discipline, course_number)
);

CREATE VIEW courses_view AS
SELECT      course_id,
            course_discipline,
            course_number,
            course_name,
            course_credits,
            course_description
FROM        courses
ORDER BY    course_discipline ASC,
            course_number ASC;  

CREATE TABLE labs (
    course_id           INT,
    parent_course_id    INT,
    PRIMARY KEY (course_id),
    FOREIGN KEY (parent_course_id) REFERENCES courses (course_id) ON DELETE CASCADE
)
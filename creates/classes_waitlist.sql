CREATE TABLE classes_waitlist(
    student_id          INT,
    class_id            INT,
    waitlist_timestamp  DATETIME DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (student_id, class_id),
    FOREIGN KEY (student_id) REFERENCES students (student_id) ON DELETE RESTRICT,
    FOREIGN KEY (class_id) REFERENCES classes (class_id) ON DELETE RESTRICT
);

CREATE VIEW classes_waitlist_view AS
SELECT      student_id,
            student_first_name,
            student_last_name,
            student_name,
            class_id,
            course_id,
            course_discipline, 
            course_number,
            section,
            class_code,
            course_name,
            term_id,
            term_name
FROM        classes_waitlist
            JOIN students_view
            USING (student_id)
            JOIN classes_view
            USING (class_id)
ORDER BY    term_id DESC,
            course_discipline ASC,
            course_number ASC,
            section ASC;


DROP FUNCTION IF EXISTS check_waitlist;
CREATE FUNCTION check_waitlist(class_id_input INT)
RETURNS INT
RETURN(
    SELECT  COUNT(*)
    FROM    classes_waitlist
    WHERE   class_id = class_id_input
    ORDER BY waitlist_timestamp ASC
);

DROP FUNCTION IF EXISTS admit_student_from_waitlist;
CREATE FUNCTION admit_student_from_waitlist(stude)
            
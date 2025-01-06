DELETE FROM course_prerequisites
WHERE   course_id = :course_id
        AND  prerequisite_id = :prerequisite_id;

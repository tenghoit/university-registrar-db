DELETE FROM degree_requirements
WHERE   degree_id = :degree_id
        AND course_id = :course_id;
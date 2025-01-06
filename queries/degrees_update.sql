UPDATE degrees
SET     degree_name = :degree_name,
        degree_type = :degree_type
WHERE   degree_id = :degree_id;

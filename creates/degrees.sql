CREATE TABLE degree_types (
    degree_type VARCHAR(64),
    PRIMARY KEY (degree_type)
);

INSERT INTO degree_types (degree_type)
VALUES  ('Major'),
        ('Minor');


CREATE TABLE degrees (
    degree_id   INT AUTO_INCREMENT,
    degree_name VARCHAR(128),
    degree_type VARCHAR(64),
    UNIQUE (degree_name, degree_type),
    FOREIGN KEY (degree_type) REFERENCES degree_types (degree_type) ON DELETE CASCADE,
    PRIMARY KEY (degree_id)
);

CREATE VIEW degrees_view AS
SELECT  degree_id,
        degree_name,
        degree_type
FROM    degrees
ORDER BY    degree_name ASC,
            degree_type ASC;

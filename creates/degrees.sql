CREATE TABLE degrees (
    degree_id    INT AUTO_INCREMENT,
    degree_name  VARCHAR(128),
    PRIMARY KEY (degree_id)
);

CREATE VIEW degrees_view AS
SELECT      degree_id,
            degree_name
FROM        degrees
ORDER BY    degree_name ASC;


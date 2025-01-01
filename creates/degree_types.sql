CREATE TABLE degree_types (
    degree_type VARCHAR(64),
    PRIMARY KEY (degree_type)
);

INSERT INTO degree_types (degree_type)
VALUES  ('Major'),
        ('Minor');
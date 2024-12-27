CREATE TABLE designations (
    designation    VARCHAR(64),
    PRIMARY KEY (designation)
);

INSERT INTO designations (designation)
VALUES  ("student"),
        ("admin");

CREATE TABLE users (
    user_id         INT AUTO_INCREMENT,
    user_name       VARCHAR(128) NOT NULL,
    user_password   VARCHAR(256) NOT NULL,
    designation     VARCHAR(64),
    designation_id  INT,
    FOREIGN KEY (designation) REFERENCES roles (designation) ON DELETE RESTRICT,
    PRIMARY KEY (user_id),
    UNIQUE (user_name)
);

CREATE VIEW users_view AS
SELECT  user_id,
        user_name,
        user_password,
        designation,
        designation_id
FROM users;


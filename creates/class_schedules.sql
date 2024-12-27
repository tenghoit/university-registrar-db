CREATE TABLE days (
    day_letter  VARCHAR(8),
    PRIMARY KEY (day_letter)
);

INSERT INTO days (day_letter)
VALUES  ('M'),
        ('T'),
        ('W'),
        ('R'),
        ('F'),
        ('S'),
        ('U');

CREATE TABLE class_schedules(
    class_schedule_id   INT,
    day_letter          VARCHAR(8),
    PRIMARY KEY (class_schedule_id, day_letter),
    FOREIGN KEY (day_letter) REFERENCES days (day_letter) ON DELETE RESTRICT
);


CREATE VIEW class_schedules_view AS
SELECT  class_schedule_id,
        GROUP_CONCAT(day_letter ORDER BY FIELD(day_letter, 'M', 'T', 'W', 'R', 'F', 'S', 'U') SEPARATOR '') AS class_schedule
FROM    class_schedules
GROUP BY class_schedule_id;


CREATE VIEW class_schedule_conflicts_view AS
SELECT *
FROM    class_schedules as cs1
        JOIN class_schedules as cs2
        ON cs1.day_letter = cs2.day_letter; -- check if have same day


DROP FUNCTION IF EXISTS find_class_schedule_conflict
CREATE FUNCTION find_class_schedule_conflict(class_schedule_id_one_input INT, class_schedule_id_two_input INT)
RETURNS INT
RETURN (
SELECT COUNT(*)
FROM    class_schedule_conflicts_view
WHERE   cs1 = class_schedule_id_one_input
        AND cs2 = class_schedule_id_two_input
);



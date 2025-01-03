CREATE TABLE days (
    day_letter  VARCHAR(1),
    day_name    VARCHAR(32),
    PRIMARY KEY (day_letter)
);

INSERT INTO days (day_letter, day_name)
VALUES  ('M', 'Monday'),
        ('T', 'Tuesday'),
        ('W', 'Wednesday'),
        ('R', 'Thursday'),
        ('F', 'Friday'),
        ('S', 'Saturday'),
        ('U', 'Sunday');

CREATE VIEW days_view AS
SELECT  day_letter,
        day_name
FROM    days;
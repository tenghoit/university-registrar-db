CREATE TABLE terms (
    term_id          INT AUTO_INCREMENT,
    term_start_date  DATE,
    term_end_date    DATE,
    PRIMARY KEY (term_id)
);

CREATE VIEW terms_view AS
SELECT  term_id,
        term_start_date,
        term_end_date,
        CONCAT(
            CASE
                WHEN MONTH(term_start_date) IN (12, 1, 2) THEN 'Winter'
                WHEN MONTH(term_start_date) IN (3, 4, 5) THEN 'Spring'
                WHEN MONTH(term_start_date) IN (6, 7, 8) THEN 'Summer'
                WHEN MONTH(term_start_date) IN (9, 10, 11) THEN 'Fall'
            END,
            ' ',
            YEAR(term_start_date)
        ) AS term_name
FROM    terms;


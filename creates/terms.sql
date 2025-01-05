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
                WHEN MONTH(term_start_date) IN (1) THEN 'Winter'
                WHEN MONTH(term_start_date) IN (2, 3, 4, 5, 6) THEN 'Spring'
                WHEN MONTH(term_start_date) IN (7) THEN 'Summer'
                WHEN MONTH(term_start_date) IN (8, 9, 10, 11, 12) THEN 'Fall'
            END,
            ' ',
            YEAR(term_start_date)
        ) AS term_name
FROM    terms;


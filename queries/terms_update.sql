UPDATE terms
SET    term_start_date = :term_start_date,
       term_end_date = :term_end_date
WHERE  term_id = :term_id;

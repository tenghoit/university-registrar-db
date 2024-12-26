CREATE TABLE time_blocks(
  start_time   TIME,
  end_time     TIME,
  PRIMARY KEY (start_time, end_time)
);

CREATE VIEW time_blocks_view AS
SELECT * FROM time_blocks;

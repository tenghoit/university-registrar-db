DROP DATABASE IF EXISTS ku_registrar;
CREATE DATABASE ku_registrar;

USE ku_registrar;

-- creates statments
SOURCE creates/buildings.sql;
SOURCE creates/locations.sql;
SOURCE creates/terms.sql;
SOURCE creates/class_schedules.sql;
SOURCE creates/time_blocks.sql;
SOURCE creates/professors.sql;
SOURCE creates/students.sql;

SOURCE creates/courses.sql;
SOURCE creates/degrees.sql;
SOURCE creates/degree_requirements.sql;
SOURCE creates/course_prerequisites.sql;

SOURCE creates/classes.sql;
SOURCE creates/student_class_history.sql;
SOURCE creates/classes_waitlist.sql;
SOURCE creates/users.sql;

-- test data, order matters here
SOURCE data/buildings_data.sql;
SOURCE data/locations_data.sql;
SOURCE data/terms_data.sql;
SOURCE data/class_schedules_data.sql;
SOURCE data/time_blocks_data.sql;
SOURCE data/professors_data.sql;
SOURCE data/students_data.sql;

SOURCE data/courses_data.sql;
SOURCE data/degrees_data.sql;
SOURCE data/degree_requirements_data.sql;
SOURCE data/course_prerequisites_data.sql;

SOURCE data/classes_data.sql;
SOURCE data/student_class_history_data.sql;
SOURCE data/classes_waitlist_data.sql;
SOURCE data/users_data.sql;

-- checking if everythings good
SELECT * FROM buildings_view;
SELECT * FROM locations_view;
SELECT * FROM terms_view;
SELECT * FROM class_schedules_view;
SELECT * FROM time_blocks_view;
SELECT * FROM professors_view;
SELECT * FROM students_view;

SELECT * FROM courses_view;
SELECT * FROM degrees_view;
SELECT * FROM degree_requirements_view;
SELECT * FROM course_prerequisites_view;

SELECT * FROM classes_view;
SELECT * FROM student_class_history_view;
SELECT * FROM classes_waitlist_view;
SELECT * FROM users_view;


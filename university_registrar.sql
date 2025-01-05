DROP DATABASE IF EXISTS university_registrar;
CREATE DATABASE university_registrar;

USE university_registrar;


-- creates statements
SELECT 'Building buildings table';
SOURCE creates/buildings.sql;
SELECT 'Building locations table';
SOURCE creates/locations.sql;
SELECT 'Building terms table';
SOURCE creates/terms.sql;
SELECT 'Building days_of_the_week table';
SOURCE creates/days_of_the_week.sql;
SELECT 'Building time_blocks table';
SOURCE creates/time_blocks.sql;
SELECT 'Building users table';
SOURCE creates/users.sql;
SELECT 'Building professors table';
SOURCE creates/professors.sql;
SELECT 'Building students table';
SOURCE creates/students.sql;
SELECT 'Building admins table';
SOURCE creates/admins.sql;
SELECT 'Building user_logins table';
SOURCE creates/user_logins.sql;

SELECT 'Building courses table';
SOURCE creates/courses.sql;
SELECT 'Building labs table';
SOURCE creates/labs.sql;
SELECT 'Building course_prerequisites table';
SOURCE creates/course_prerequisites.sql;
SELECT 'Building degree_types table';
SOURCE creates/degree_types.sql;
SELECT 'Building degrees table';
SOURCE creates/degrees.sql;
SELECT 'Building degree_requirements table';
SOURCE creates/degree_requirements.sql;
SELECT 'Building student_degrees table';
SOURCE creates/student_degrees.sql;

SELECT 'Building classes table';
SOURCE creates/classes.sql;
SELECT 'Building class_schedules table';
SOURCE creates/class_schedules.sql;
SELECT 'Building class_schedules_triggers table';
SOURCE creates/class_schedules_triggers.sql;
SELECT 'Building student_class_history table';
SOURCE creates/student_class_history.sql;
SELECT 'Building student_class_history_triggers table';
SOURCE creates/student_class_history_triggers.sql;
SELECT 'Building classes_waitlist table';
SOURCE creates/classes_waitlist.sql;


-- test data, order matters here
SOURCE data/buildings_data.sql;
SELECT * FROM buildings_view;
SOURCE data/locations_data.sql;
SELECT * FROM locations_view;
SOURCE data/terms_data.sql;
SELECT * FROM terms_view;
SOURCE data/time_blocks_data.sql;
SELECT * FROM time_blocks_view;
SOURCE data/users_data.sql;
SELECT * FROM users_view;
SOURCE data/professors_data.sql;
SELECT * FROM professors_view;
SOURCE data/students_data.sql;
SELECT * FROM students_view;
SOURCE data/admins_data.sql;
SELECT * FROM admins_view;
SOURCE data/user_logins_data.sql;
SELECT * FROM user_logins_view;

SOURCE data/courses_data.sql;
SELECT * FROM courses_view;
SOURCE data/labs_data.sql;
SELECT * FROM labs_view;
SOURCE data/course_prerequisites_data.sql;
SELECT * FROM course_prerequisites_view;
SOURCE data/degrees_data.sql;
SELECT * FROM degrees_view;
SOURCE data/degree_requirements_data.sql;
SELECT * FROM degree_requirements_view;

-- SOURCE data/classes_data.sql;
-- SOURCE data/class_schedules_data.sql;
-- SOURCE data/student_class_history_data.sql;
-- SOURCE data/classes_waitlist_data.sql;


-- checking if everythings good
-- SELECT * FROM buildings_view;
-- SELECT * FROM locations_view;
-- SELECT * FROM terms_view;
-- SELECT * FROM class_schedules_view;
-- SELECT * FROM time_blocks_view;
-- SELECT * FROM professors_view;
-- SELECT * FROM students_view;

-- SELECT * FROM courses_view;
-- SELECT * FROM degrees_view;
-- SELECT * FROM degree_requirements_view;
-- SELECT * FROM course_prerequisites_view;

-- SELECT * FROM classes_view;
-- SELECT * FROM student_class_history_view;
-- SELECT * FROM classes_waitlist_view;
-- SELECT * FROM users_view;

-- tests
-- SOURCE tests/location_conflict.sql;
-- SOURCE tests/professor_conflict.sql;
SOURCE tests/class_size_conflict.sql;
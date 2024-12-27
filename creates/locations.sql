CREATE TABLE locations (
    building_name  VARCHAR(64),
    room_number    INT,
    room_capacity  INT,
    FOREIGN KEY (building_name) REFERENCES buildings (building_name) ON DELETE CASCADE,
    PRIMARY KEY (building_name, room_number)
);

CREATE VIEW locations_view AS
SELECT      building_name,
            room_number,
            room_capacity
FROM        locations
ORDER BY    building_name ASC,
            room_number ASC;

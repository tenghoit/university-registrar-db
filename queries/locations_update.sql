UPDATE locations
SET     room_capacity = :room_capacity
WHERE   building_name = :building_name
        AND room_number = :room_number;

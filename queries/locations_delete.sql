DELETE FROM locations
WHERE   building_name = :building_name
        AND room_number = :room_number;

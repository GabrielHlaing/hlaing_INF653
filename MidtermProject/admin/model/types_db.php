<?php
// Name - Gabriel Hlaing
// Version - 26/03/2025
// Description - Handles database operations for vehicle types.

function get_types()
{
    global $db;
    $query = "SELECT * FROM types ORDER BY type";
    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function add_type($type)
{
    global $db;
    $query = "INSERT INTO types (type) VALUES (:type)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':type', $type, PDO::PARAM_STR);
    $stmt->execute();
}

function delete_type($type_id)
{
    global $db;

    // Check if the type is used in any vehicle
    $query = 'SELECT COUNT(*) FROM vehicles WHERE type_id = :type_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();
    $count = $statement->fetchColumn();
    $statement->closeCursor();

    if ($count > 0) {
        die("Cannot delete. Vehicles are associated with this type.");
    }

    // If no vehicles use this type, proceed with deletion
    $query = 'DELETE FROM types WHERE type_id = :type_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':type_id', $type_id);
    $statement->execute();
    $statement->closeCursor();

    return true;
}

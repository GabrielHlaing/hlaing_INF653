<?php
// Name - Gabriel Hlaing
// Version - 26/03/2025
// Description - Handles database operations for vehicle makes.

function get_makes()
{
    global $db;
    $query = "SELECT * FROM makes ORDER BY make";
    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function add_make($make)
{
    global $db;
    $query = "INSERT INTO makes (make) VALUES (:make)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':make', $make, PDO::PARAM_STR);
    $stmt->execute();
}

function delete_make($make_id)
{
    global $db;

    // Check if the make is used in any vehicle
    $query = 'SELECT COUNT(*) FROM vehicles WHERE make_id = :make_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $count = $statement->fetchColumn();
    $statement->closeCursor();

    if ($count > 0) {
        die("Cannot delete. Vehicles are associated with this make.");
    }

    // If no vehicles use this make, proceed with deletion
    $query = 'DELETE FROM makes WHERE make_id = :make_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':make_id', $make_id);
    $statement->execute();
    $statement->closeCursor();

    return true;
}

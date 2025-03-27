<?php
// Name - Gabriel Hlaing
// Version - 26/03/2025
// Description - Handles database operations for vehicle classes.

function get_classes()
{
    global $db;
    $query = "SELECT * FROM classes ORDER BY class";
    return $db->query($query)->fetchAll(PDO::FETCH_ASSOC);
}

function add_class($class)
{
    global $db;
    $query = "INSERT INTO classes (class) VALUES (:class)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':class', $class, PDO::PARAM_STR);
    $stmt->execute();
}

function delete_class($class_id)
{
    global $db;

    // Check if the class is used in any vehicle
    $query = 'SELECT COUNT(*) FROM vehicles WHERE class_id = :class_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $count = $statement->fetchColumn();
    $statement->closeCursor();

    if ($count > 0) {
        die("Cannot delete. Vehicles are associated with this class.");
    }

    // If no vehicles use this class, proceed with deletion
    $query = 'DELETE FROM classes WHERE class_id = :class_id';
    $statement = $db->prepare($query);
    $statement->bindValue(':class_id', $class_id);
    $statement->execute();
    $statement->closeCursor();

    return true;
}

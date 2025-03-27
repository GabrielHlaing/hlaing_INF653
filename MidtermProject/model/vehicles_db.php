<?php
// Name - Gabriel Hlaing
// Version - 26/03/2025
// Description - Handles database operations for vehicles.

function get_vehicles($sort_by = 'price', $make_id = null, $type_id = null, $class_id = null)
{
    global $db;
    $query = "SELECT vehicles.*, makes.make, types.type, classes.class 
              FROM vehicles
              JOIN makes ON vehicles.make_id = makes.make_id
              JOIN types ON vehicles.type_id = types.type_id
              JOIN classes ON vehicles.class_id = classes.class_id";

    // Apply filtering if parameters are set
    $conditions = [];
    if ($make_id) $conditions[] = "vehicles.make_id = :make_id";
    if ($type_id) $conditions[] = "vehicles.type_id = :type_id";
    if ($class_id) $conditions[] = "vehicles.class_id = :class_id";

    if (!empty($conditions)) {
        $query .= " WHERE " . implode(" AND ", $conditions);
    }

    // Apply sorting
    $query .= " ORDER BY " . ($sort_by === 'year' ? "vehicles.year DESC" : "vehicles.price DESC");

    $stmt = $db->prepare($query);
    if ($make_id) $stmt->bindValue(':make_id', $make_id, PDO::PARAM_INT);
    if ($type_id) $stmt->bindValue(':type_id', $type_id, PDO::PARAM_INT);
    if ($class_id) $stmt->bindValue(':class_id', $class_id, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

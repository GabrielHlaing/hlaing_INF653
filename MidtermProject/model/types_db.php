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

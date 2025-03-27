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

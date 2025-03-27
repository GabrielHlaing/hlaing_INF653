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

<?php
// Name - Gabriel Hlaing
// Version - 26/03/2025
// Description - Controls the main homepage view of vehicles.

require_once('model/database.php');
require_once('model/vehicles_db.php');
require_once('model/makes_db.php');
require_once('model/types_db.php');
require_once('model/classes_db.php');

// Get sorting and filtering options
$sort_by = filter_input(INPUT_GET, 'sort', FILTER_SANITIZE_STRING) ?? 'price';
$make_id = filter_input(INPUT_GET, 'make_id', FILTER_VALIDATE_INT);
$type_id = filter_input(INPUT_GET, 'type_id', FILTER_VALIDATE_INT);
$class_id = filter_input(INPUT_GET, 'class_id', FILTER_VALIDATE_INT);

// Fetch required data
$makes = get_makes();
$types = get_types();
$classes = get_classes();
$vehicles = get_vehicles($sort_by, $make_id, $type_id, $class_id);

// Load the homepage view
include('view/vehicle_list.php');

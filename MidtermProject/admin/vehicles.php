
<?php
require_once('model/database.php');
require_once('model/vehicles_db.php');
require_once('model/makes_db.php');
require_once('model/types_db.php');
require_once('model/classes_db.php');

$action = filter_input(INPUT_POST, 'action') ?? filter_input(INPUT_GET, 'action') ?? 'list_vehicles';

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

switch ($action) {
    case 'list_vehicles':
        // Fetch data for displaying vehicles
        $vehicles = get_vehicles();
        $makes = get_makes();
        $types = get_types();
        $classes = get_classes();
        include('view/vehicle_list.php');
        break;

    case 'add_vehicle':
        // Process form to add new vehicle
        $year = filter_input(INPUT_POST, 'year', FILTER_VALIDATE_INT);
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_STRING);
        $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_INT);
        $make_id = filter_input(INPUT_POST, 'make_id', FILTER_VALIDATE_INT);
        $type_id = filter_input(INPUT_POST, 'type_id', FILTER_VALIDATE_INT);
        $class_id = filter_input(INPUT_POST, 'class_id', FILTER_VALIDATE_INT);

        if ($year && $model && $price && $make_id && $type_id && $class_id) {
            add_vehicle($year, $model, $price, $make_id, $type_id, $class_id);
            header('Location: vehicles.php?action=list_vehicles');
        } else {
            $error = "Invalid vehicle data. Please check all fields.";
            include('../view/error.php');
        }
        break;

    case 'delete_vehicle':
        // Process vehicle deletion
        $vehicle_id = filter_input(INPUT_POST, 'vehicle_id', FILTER_VALIDATE_INT);
        if ($vehicle_id) {
            delete_vehicle($vehicle_id);
            header('Location: vehicles.php?action=list_vehicles');
        } else {
            $error = "Invalid vehicle ID.";
            include('../view/error.php');
        }
        break;

    default:
        include('../view/error.php');
        break;
}
?>
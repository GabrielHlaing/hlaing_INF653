<?php
require_once('../model/database.php');
require_once('../model/classes_db.php');

$classes = get_classes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'add_class' && !empty($_POST['class_name'])) {
        add_class($_POST['class_name']);
    } elseif ($_POST['action'] == 'delete_class' && !empty($_POST['class_id'])) {
        delete_class($_POST['class_id']);
    }
    header("Location: update_classes.php");
    exit();
}
?>

<?php include('../view/header.php'); ?>
<h2>Manage Classes</h2>

<!-- Add Class Form -->
<form action="update_classes.php" method="post">
    <input type="hidden" name="action" value="add_class">
    <label>Class Name:</label>
    <input type="text" name="class_name" required>
    <button type="submit">Add Class</button>
</form>

<!-- List of Classes -->
<table>
    <tr>
        <th>Class Name</th>
        <th>Action</th>
    </tr>
    <?php foreach ($classes as $class) : ?>
        <tr>
            <td><?= htmlspecialchars($class['class']) ?></td>
            <td>
                <form action="update_classes.php" method="post">
                    <input type="hidden" name="action" value="delete_class">
                    <input type="hidden" name="class_id" value="<?= $class['class_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include('../view/footer.php'); ?>
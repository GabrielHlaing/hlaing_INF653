<?php
require_once('../model/database.php');
require_once('../model/types_db.php');

$types = get_types();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'add_type' && !empty($_POST['type_name'])) {
        add_type($_POST['type_name']);
    } elseif ($_POST['action'] == 'delete_type' && !empty($_POST['type_id'])) {
        delete_type($_POST['type_id']);
    }
    header("Location: update_types.php");
    exit();
}
?>

<?php include('../view/header.php'); ?>
<h2>Manage Types</h2>

<!-- Add Type Form -->
<form action="update_types.php" method="post">
    <input type="hidden" name="action" value="add_type">
    <label>Type Name:</label>
    <input type="text" name="type_name" required>
    <button type="submit">Add Type</button>
</form>

<!-- List of Types -->
<table>
    <tr>
        <th>Type Name</th>
        <th>Action</th>
    </tr>
    <?php foreach ($types as $type) : ?>
        <tr>
            <td><?= htmlspecialchars($type['type']) ?></td>
            <td>
                <form action="update_types.php" method="post">
                    <input type="hidden" name="action" value="delete_type">
                    <input type="hidden" name="type_id" value="<?= $type['type_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include('../view/footer.php'); ?>
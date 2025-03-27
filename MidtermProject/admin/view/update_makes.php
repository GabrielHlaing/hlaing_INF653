<?php
require_once('../model/database.php');
require_once('../model/makes_db.php');

$makes = get_makes();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST['action'] == 'add_make' && !empty($_POST['make_name'])) {
        add_make($_POST['make_name']);
    } elseif ($_POST['action'] == 'delete_make' && !empty($_POST['make_id'])) {
        delete_make($_POST['make_id']);
    }
    header("Location: update_makes.php");
    exit();
}
?>

<?php include('../view/header.php'); ?>
<h2>Manage Makes</h2>

<!-- Add Make Form -->
<form action="update_makes.php" method="post">
    <input type="hidden" name="action" value="add_make">
    <label>Make Name:</label>
    <input type="text" name="make_name" required>
    <button type="submit">Add Make</button>
</form>

<!-- List of Makes -->
<table>
    <tr>
        <th>Make Name</th>
        <th>Action</th>
    </tr>
    <?php foreach ($makes as $make) : ?>
        <tr>
            <td><?= htmlspecialchars($make['make']) ?></td>
            <td>
                <form action="update_makes.php" method="post">
                    <input type="hidden" name="action" value="delete_make">
                    <input type="hidden" name="make_id" value="<?= $make['make_id']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include('../view/footer.php'); ?>
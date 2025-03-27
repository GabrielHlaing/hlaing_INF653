<?php include('header.php'); ?>

<h2>Zippy Used Autos - Admin Panel</h2>

<!-- Sorting & Filtering -->
<form action="." method="get">
    <label>Sort by:</label>
    <select name="sort" onchange="this.form.submit()">
        <option value="price" <?= ($sort_by === 'price') ? 'selected' : '' ?>>Price (High to Low)</option>
        <option value="year" <?= ($sort_by === 'year') ? 'selected' : '' ?>>Year (New to Old)</option>
    </select>
</form>

<form action="." method="get">
    <label>Filter by Make:</label>
    <select name="make_id" onchange="this.form.submit()">
        <option value="">All</option>
        <?php foreach ($makes as $make) : ?>
            <option value="<?= $make['make_id'] ?>" <?= ($make_id == $make['make_id']) ? 'selected' : '' ?>>
                <?= $make['make'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<form action="." method="get">
    <label>Filter by Type:</label>
    <select name="type_id" onchange="this.form.submit()">
        <option value="">All</option>
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type['type_id'] ?>" <?= ($type_id == $type['type_id']) ? 'selected' : '' ?>>
                <?= $type['type'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<form action="." method="get">
    <label>Filter by Class:</label>
    <select name="class_id" onchange="this.form.submit()">
        <option value="">All</option>
        <?php foreach ($classes as $class) : ?>
            <option value="<?= $class['class_id'] ?>" <?= ($class_id == $class['class_id']) ? 'selected' : '' ?>>
                <?= $class['class'] ?>
            </option>
        <?php endforeach; ?>
    </select>
</form>

<!-- Vehicle Listings -->
<table>
    <tr>
        <th>Year</th>
        <th>Model</th>
        <th>Price</th>
        <th>Type</th>
        <th>Class</th>
        <th>Make</th>
        <th>Action</th>
    </tr>
    <?php foreach ($vehicles as $vehicle) : ?>
        <tr>
            <td><?= $vehicle['year'] ?></td>
            <td><?= htmlspecialchars($vehicle['model']) ?></td>
            <td>$<?= number_format($vehicle['price'], 2) ?></td>
            <td><?= htmlspecialchars($vehicle['type']) ?></td>
            <td><?= htmlspecialchars($vehicle['class']) ?></td>
            <td><?= htmlspecialchars($vehicle['make']) ?></td>
            <td>
                <form action="vehicles.php" method="post">
                    <input type="hidden" name="action" value="delete_vehicle">
                    <input type="hidden" name="vehicle_id" value="<?= $vehicle['ID']; ?>">
                    <button type="submit">Delete</button>
                </form>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<!-- Form for adding vehicles -->
<h2>Add Vehicle</h2>
<form action="vehicles.php" method="post">
    <input type="hidden" name="action" value="add_vehicle">

    <label for="year">Year:</label>
    <input type="number" name="year" id="year" required>

    <label for="model">Model:</label>
    <input type="text" name="model" id="model" required>

    <label for="price">Price:</label>
    <input type="number" name="price" id="price" step="0.01" required>

    <label for="make_id">Make:</label>
    <select name="make_id" id="make_id" required>
        <option value="">Select Make</option>
        <?php foreach ($makes as $make) : ?>
            <option value="<?= $make['make_id'] ?>"><?= htmlspecialchars($make['make']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="type_id">Type:</label>
    <select name="type_id" id="type_id" required>
        <option value="">Select Type</option>
        <?php foreach ($types as $type) : ?>
            <option value="<?= $type['type_id'] ?>"><?= htmlspecialchars($type['type']) ?></option>
        <?php endforeach; ?>
    </select>

    <label for="class_id">Class:</label>
    <select name="class_id" id="class_id" required>
        <option value="">Select Class</option>
        <?php foreach ($classes as $class) : ?>
            <option value="<?= $class['class_id'] ?>"><?= htmlspecialchars($class['class']) ?></option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Add Vehicle</button>
</form>


<h2>Manage Makes</h2>
<form action="view/update_makes.php" method="get">
    <button type="submit">Edit Makes</button>
</form>

<h2>Manage Types</h2>
<form action="view/update_types.php" method="get">
    <button type="submit">Edit Types</button>
</form>

<h2>Manage Classes</h2>
<form action="view/update_classes.php" method="get">
    <button type="submit">Edit Classes</button>
</form>

<?php include('footer.php'); ?>
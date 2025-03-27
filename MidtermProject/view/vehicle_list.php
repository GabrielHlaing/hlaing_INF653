<?php include('header.php'); ?>

<h1>Zippy Used Autos</h1>

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
    </tr>
    <?php foreach ($vehicles as $vehicle) : ?>
        <tr>
            <td><?= $vehicle['year'] ?></td>
            <td><?= htmlspecialchars($vehicle['model']) ?></td>
            <td>$<?= number_format($vehicle['price'], 2) ?></td>
            <td><?= htmlspecialchars($vehicle['type']) ?></td>
            <td><?= htmlspecialchars($vehicle['class']) ?></td>
            <td><?= htmlspecialchars($vehicle['make']) ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php include('footer.php'); ?>
<?php include('header.php'); ?>

<section class="error-container">
    <h2>Error</h2>
    <p><?= isset($error) ? htmlspecialchars($error) : 'An unknown error occurred.' ?></p>
    <a href="." class="btn">Back to Home</a>
</section>

<?php include('footer.php'); ?>
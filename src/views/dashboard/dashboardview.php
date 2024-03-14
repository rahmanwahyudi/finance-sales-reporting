<?php
$pageTitle = 'Dashboard';
$additionalCss = [
    // Include any additional CSS files if needed, specific to the dashboard
];
include __DIR__ . '/../templates/header.php';
include __DIR__ . '/../templates/navbar.php';
?>

<!-- Dashboard Content Below -->
<div class="p-6">
    <h1 class="text-2xl font-semibold">Welcome <?php echo htmlspecialchars($_SESSION['user_role']). ',' .htmlspecialchars($_SESSION['user_fullName']); ?>!</h1>
</div>

<?php include __DIR__ . '/../templates/footer.php'; ?>
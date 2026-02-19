<?php
$title = "User Guide Manager";
require_once '../view/header.php';

// First, check if user is logged in
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to manage the user guide.';
    include '../view/error_page.php';
    die();
}

// Check if they have permission
if (!in_array('AG-ROLE-STAFF', $_SESSION['Role'])) {
    $errorMessage = 'You do not have permission to view this page.';
    include '../view/error_page.php';
    die();
}
?>

<!-- Success message -->
<p><?php echo $message; ?></p>

<?php
require_once '../view/footer.php';
?>

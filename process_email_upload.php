<?php
$title = "Input Manager";
//This is the page for admin to manage the availability of buildings and such
require_once '../view/header.php'; //THis requires the header
// First, check if user is logged ini
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to manage inputs.';
    include '../view/error_page.php';
    die();
}
// If they are logged in, ensure they have permission to view the page
else {
    if (!(in_array('AG-ROLE-STAFF', $_SESSION['Role']))) {
        $errorMessage = 'You do not have permission to view this page.';
        include '../view/error_page.php';
        die();
    }
}
?>

    <p><?php echo $message;?></p> <!--Dislay the message for successfully uploading a txt file for emails-->

<?php
require_once '../view/footer.php'; //This requires the footer
?>
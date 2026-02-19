<?php
$title = "Email Manager";
//This is the page for admin to manage the email that gets sent
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




<div class="container-lg">
    <div class="row">
        <div class="col-lg-5">
            <h1>Email / Guide Manager</h1> <!--title is chill-->
        </div>
        <div class="row" style="margin-top: 2%;">
            <div class="col-lg-4">
                <h4 style="margin-top: 8px;">Upload a file for the Email:</h4>
            </div>
            <div class="col-lg-4">
                <form enctype="multipart/form-data" action="../controller/controller.php?action=ProcessEmail"
                    method="post">
                    <div class="input-group" style="padding-left:0px">
                        <!--We only want to allow txt docs, make it required-->
                        <input class="form-control" type="file" name="user_email" accept=".txt" required>
                        <button class="btn btn-outline-secondary" type="submit" value="Upload File">Upload</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row border-top border-bottom border-subtle" style="margin-top: 3%; padding-top:3%; margin-bottom: 2%; padding-bottom: 2%;">
            <div class="col-lg-4">
                <h4 style="margin-top: 8px;">Upload a file for the User Guide:</h4>
            </div>
            <div class="col-lg-4">
                <form enctype="multipart/form-data" action="../controller/controller.php?action=ProcessUserGuide"
                    method="post">
                    <div class="input-group" style="padding-left:0px">
                        <input class="form-control" type="file" name="user_guide" accept=".docx" required>
                        <button class="btn btn-outline-secondary" type="submit">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="row" >
        <div class="col-lg-12">
            <h4 style="text-align: left;">File Tips</h4>
            <h5> <!--tell user what files are allowed-->
                Only .txt files are supported for email uploads.
            </h5>
            <h5>
                Only .docx files are supported for User Guide uploads.
            </h5>
            <br>
            <h5>Most Recent Email File <a href="../view/notification_email.php" target="_blank">Here</a></h5>
        </div>
    </div>
</div>

<?php
require_once '../view/footer.php'; //This requires the footer
?>
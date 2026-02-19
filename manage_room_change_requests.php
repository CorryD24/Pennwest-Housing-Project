<?php
$title = "Room Change Request Manager";
//This page is the page to manage room change requests
require_once '../view/header.php'; //THis requires the header
// First, check if user is logged ini
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to manage room change requests.';
    include '../view/error_page.php';
    die();
}
// If they are logged in, ensure they have permission to view the page
else {
    if (!(in_array('AG-ROLE-STAFF', $_SESSION['Role']))) {
        $errorMessage = 'You do not have permission  to view this page.';
        include '../view/error_page.php';
        die();
    }
}
?>
<!-- This page will have the links to the table view for each campus, and a search bar for name and email searching of  room change requets-->
<div class="container-lg">
    <div class="row">
        <div class="col-lg-12">
            <h1>Room Change Request Manager</h1><!--Title-->
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4">
            <h3 style="text-align: left;">Room Change Request Search:</h3>
        </div>

        <div class="col-lg-5">
            <input type="text" class="form-control" id="Criteria" name="Criteria" required>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4 d-grid">
            <button type="button" value="First Name Search" onclick="name_search4()"
                class="btn btn-outline-secondary">Search First Name</button>
        </div>
        <div class="col-lg-4 d-grid">
            <button type="button" value="Last Name Search" onclick="name_search5()"
                class="btn btn-outline-secondary">Search Last Name</button>
        </div>
        <div class="col-lg-4 d-grid">
            <button type="button" value="Email Search" onclick="name_search6()" class="btn btn-outline-secondary">Search
                Email</button>
        </div>
    </div>
    <br>
    <!--We use 1 for table mode because displaying by first choice is default-->
    <div class="row font15">
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomChangeRequestsUncomplete&TableMode=1&Campus=Clarion">Incomplete
                Clarion Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomChangeRequestsUncomplete&TableMode=1&Campus=Edinboro">Incomplete
                Edinboro Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomChangeRequestsUncomplete&TableMode=1&Campus=California">Incomplete
                California Room
                Change Requests</a>
        </div>
    </div>
    <br> <!--space-->
    <div class="row font15">
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomChangeRequests&TableMode=1&Campus=Clarion">Complete
                Clarion Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomChangeRequests&TableMode=1&Campus=Edinboro">Complete
                Edinboro Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomChangeRequests&TableMode=1&Campus=California">Complete
                California Room
                Change Requests</a>
        </div>
    </div>
    <br>
    <div class="row font15">

        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=ChangeDeletedUncomplete&TableMode=1&Campus=Clarion">Incomplete
                Deleted Clarion Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=ChangeDeletedUncomplete&TableMode=1&Campus=Edinboro">Incomplete
                Deleted Edinboro Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=ChangeDeletedUncomplete&TableMode=1&Campus=California">Incomplete
                Deleted California Room
                Change Requests</a>
        </div>
    </div>
    <br>
    <div class="row font15">

        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=ChangeDeleted&TableMode=1&Campus=Clarion">
                Complete Deleted Clarion Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=ChangeDeleted&TableMode=1&Campus=Edinboro">Complete
                Deleted Edinboro Room
                Change Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=ChangeDeleted&TableMode=1&Campus=California">Complete
                Deleted California Room
                Change Requests</a>
        </div>
    </div>
</div>

<?php
require_once '../view/footer.php'; //THis requires the header

?>
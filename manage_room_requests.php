<?php
$title = "Room Request Manager";
//This page is the page to manage room requests
require_once '../view/header.php'; //THis requires the header
// First, check if user is logged ini
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to manage room requests.';
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
        <div class="col-lg-12">
            <h1>Room Request Manager</h1><!--Title-->
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-3">
            <h3 style="text-align:left;">Room Request Search:</h3>
        </div>

        <div class="col-lg-5">
            <input type="text" class="form-control" id="Criteria" name="Criteria" required>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-4 d-grid">
            <button type="button" value="First Name Search" onclick="name_search1()"
                class="btn btn-outline-secondary">Search First Name</button>
        </div>
        <div class="col-lg-4 d-grid">
            <button type="button" value="Last Name Search" onclick="name_search2()"
                class="btn btn-outline-secondary">Search Last Name</button>
        </div>
        <div class="col-lg-4 d-grid">
            <button type="button" value="Email Search" onclick="name_search3()" class="btn btn-outline-secondary">Search
                Email</button>
        </div>
    </div>
    <br>
    <div class="row font15">
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomRequestsUncomplete&TableMode=1&Campus=Clarion">Incomplete
                Clarion Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomRequestsUncomplete&TableMode=1&Campus=Edinboro">Incomplete
                Edinboro Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomRequestsUncomplete&TableMode=1&Campus=California">Incomplete
                California Room Requests</a>
        </div>
    </div>
    <br> <!--space-->
    <div class="row font15">
        <div class="col-lg-4">
            <a href="../controller/controller.php?action=ListStudents&ListType=RoomRequests&TableMode=1&Campus=Clarion">Complete
                Clarion Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomRequests&TableMode=1&Campus=Edinboro">Complete
                Edinboro Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=RoomRequests&TableMode=1&Campus=California">Complete
                California Room Requests</a>
        </div>
    </div>
    <br>
    <div class="row font15">

        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=DeletedUncomplete&TableMode=1&Campus=Clarion">Incomplete
                Deleted Clarion Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=DeletedUncomplete&TableMode=1&Campus=Edinboro">Incomplete
                Deleted Edinboro Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a
                href="../controller/controller.php?action=ListStudents&ListType=DeletedUncomplete&TableMode=1&Campus=California">Incomplete
                Deleted California Room Requests</a>
        </div>
    </div>
    <br>
    <div class="row font15">

        <div class="col-lg-4">
            <a href="../controller/controller.php?action=ListStudents&ListType=Deleted&TableMode=1&Campus=Clarion">
                Complete Deleted Clarion Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a href="../controller/controller.php?action=ListStudents&ListType=Deleted&TableMode=1&Campus=Edinboro">Complete
                Deleted Edinboro Room Requests</a>
        </div>
        <div class="col-lg-4">
            <a href="../controller/controller.php?action=ListStudents&ListType=Deleted&TableMode=1&Campus=California">Complete
                Deleted California Room Requests</a>
        </div>
    </div>
</div>
<?php
require_once '../view/footer.php'; //THis requires the header

?>
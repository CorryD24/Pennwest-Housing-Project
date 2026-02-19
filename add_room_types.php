<?php
$title = "Add Room Type";
//This is the page for admin to add new room types.
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
//We need to check if $roomtypeID is set, this prevents users from directly navigating to this page from the search bar
if (!isset($roomTypeID)) {
    $errorMessage = 'Room type ID is required.';
    include '../view/error_page.php';
    die();
}
?>

<!--Essentially this page will be a form similar to the request form, but for adding a new room type-->
<div class="container-lg">
    <div class="row">
        <div class="col-lg-12">
            <h1> <?php echo $title ?></h1>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
        </div>

        <div class="col-lg-6 centerColumnGray">
            <form id="BuildingForm" action="../controller/controller.php?action=ProcessAddRoomType" method="post"
                enctype="multipart/form-data">
                <h2><span class="spanRed">*</span>Required</h2>
                <!--Hidden inputs for the form-->
                <input type="hidden" name="RoomTypeID" id="RoomTypeID"
                    value="<?php echo htmlspecialchars($roomTypeID); ?>" maxlength="50">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="Campus"><span class="spanRed">*</span>Choose a
                            Campus:</label>
                    </div>
                    <select class="form-control" name="inputCampus" id="inputCampus" required>
                        <?php
                        //it wont let them because its empty, no required astrik
                        echo "<option value='' selected disabled></option>";
                        //require '../model/model.php';
                        $campuses = load_campuses();
                        foreach ($campuses as $campusLoop) {
                            echo "<option id='" . $campusLoop['id'] . "' value='" . $campusLoop['name'] . "'>" . $campusLoop['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <!--Input for the buidling, the room type is in-->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputBuilding01"><span
                                class="spanRed">*</span>Choose a Building:</label>
                    </div>
                    <select name="inputBuilding01" class="form-control" id="inputBuilding01" required>
                        <?php echo "<option selected disabled></option>"; ?>
                    </select>
                </div>

                <!--Input for the room types name/description-->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="RoomTypeName">Room Type Name: </label>
                    </div>
                    <input required type="text" name="RoomTypeName" class="form-control" id="RoomTypeName"
                        value="<?php echo htmlspecialchars($roomTypeName); ?>" pattern="[a-zA-Z0-9\(\) ]*"
                        maxlength="50">
                </div>
                <!--Input for the buildings availability-->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label style="margin-top: 2px; font-size: 13px;" class="input-group-text" for="Available">Room
                            Type Availability: </label>
                    </div>
                    <input style="margin: 5px; width: 20px; height: 20px;" type="checkbox" id="Available"
                        name="Available">

                </div>

                <div class="d-grid border-top border-secondary-subtle">
                    <input style="margin-top: 10px; margin-bottom: 10px;" class="btn btn-outline-secondary"
                        type="submit" value="Add Room Type">
                </div>
            </form>
        </div>
    </div>
</div>


<?php
require_once '../view/footer.php'; //THis requires the header

?>
<?php
$title = "Add Building";
//This is the page for admin to add a new building
require_once '../view/header.php'; //THis requires the header
// First, check if user is logged ini
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to manage inputs.';
    include '../view/error_page.php';
    die();
} // If they are logged in, ensure they have permission to view the page
else {
    if (!(in_array('AG-ROLE-STAFF', $_SESSION['Role']))) {
        $errorMessage = 'You do not have permission to view this page.';
        include '../view/error_page.php';
        die();
    }
}
//We need to check if $buildingID is set, this prevents users from directly navigating to this page from the search bar
if (!isset($buildingID)) {
    $errorMessage = 'Building ID is required.';
    include '../view/error_page.php';
    die();
}
?>
<!--Essentially this page will be a form similar to the request form, but for adding a new building-->
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
            <form id="BuildingForm" action="../controller/controller.php?action=ProcessAddBuilding" method="post"
                enctype="multipart/form-data">
                <h2><span class="spanRed">*</span>Required</h2>
                <!--Hidden inputs for the form-->
                <input type="hidden" name="BuildingID" id="BuildingID"
                    value="<?php echo htmlspecialchars($buildingID); ?>" maxlength="50">
                <input type="hidden" name="AvailableLLC" id="AvailableLLC"
                    value="<?php echo htmlspecialchars($availableLLC); ?>" maxlength="50">
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="Campus"><span class="spanRed">*</span>Choose a
                            Campus:</label>
                    </div>
                    <select class="form-control" name="Campus" id="Campus" required>
                        <?php
                        //it wont let them because its empty, no required astrik
                        echo "<option value='' selected disabled></option>";
                        //require '../model/model.php';
                        $campuses = load_campuses();
                        foreach ($campuses as $campusLoop) {
                            //if in add mode display the campuses like normal
                            echo "<option id='" . $campusLoop['id'] . "' value='" . $campusLoop['name'] . "'>" . $campusLoop['name'] . "</option>";
                        }
                        ?>
                    </select>
                </div>
                <!--Input for the buildings name-->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="BuildingName">Building Name:
                        </label>
                    </div>
                    <input required type="text" name="BuildingName" class="form-control" id="BuildingName"
                        value="<?php echo htmlspecialchars($buildingName); ?>" pattern="[a-zA-Z0-9\(\) ]*"
                        maxlength="50">
                </div>
                <!--Input for the buildings availability-->
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label style="margin-top: 2px; font-size: 13px;" class="input-group-text"
                            for="Available">Building Availability: </label>
                    </div>
                    <input style="margin: 5px; width: 20px; height: 20px;" type="checkbox" id="Available"
                        name="Available">
                </div>
                <div class="d-grid border-top border-secondary-subtle">
                    <input style="margin-top: 10px; margin-bottom: 10px;" class="btn btn-outline-secondary"
                        type="submit" value="Add Building">
                </div>
            </form>
        </div>
    </div>
</div>
<?php
require_once '../view/footer.php'; //THis requires the header
?>
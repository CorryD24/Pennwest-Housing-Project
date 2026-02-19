<?php
$title = "Housing Community Manager";
//This is the page for admin to manage the availability of buildings and such
require_once '../view/header.php'; //THis requires the header
// First, check if user is logged ini
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to manage LLC inputs.';
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
//We need to check if $buildings, $roomTypes, and $llcs are set, this prevents navigating directly to this page via search bar
if (!isset($buildings)) {
    $errorMessage = "Error, buildings failed to load. Or page was navigated to incorrectly."; //error message
    include '../view/error_page.php';
    die();
} else if (!isset($roomTypes)) {
    $errorMessage = "Error, room types failed to load. Or page was navigated to incorrectly."; //error message
    include '../view/error_page.php';
    die();
} else if (!isset($llcs)) {
    $errorMessage = "Error, housing communities failed to load. Or page was navigated to incorrectly."; //error message
    include '../view/error_page.php';
    die();
}
?>
<!--Will be a form similar to the request ones-->
<div class="container-lg">
    <div class="row">
        <div class="col-lg-12">
            <h1> <?php echo $title ?></h1> <!--helps to tell users if they are adding or editing-->
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3">
        </div>
        <div class="col-lg-6 centerColumnGray">
            <div class="form-responsive">
                <form id="LLCInputManager" class="w-100 w-md-auto" style="min-width: 600px;"
                    action="../controller/controller.php?action=ProcessEditFormLLCInputs" method="post"
                    enctype="multipart/form-data">
                    <!--All the options can simply be checkboxes. Checked options show up on the form, unchecked options don't-->
                    <!--We need an option for each building-->
                    <div class="row">
                        <div class="col-1">
                            <?php foreach ($buildings as $building) { ?>
                                <!--THese checkboxes toggle all LLCs in a building off-->
                                <?php if ($building['available_llc'] == 'Y') { //If the building's availablellc col is a 'Y' then its LLCs can be made available ?>
                                    <input class="managerCheck2" type="checkbox" id="<?php echo $building['id'] . 'Input'; ?>"
                                        name="<?php echo $building['id'] . 'Input'; ?>" checked>
                                <?php } else {//Otherwise display an unchecked checkbox ?>
                                    <input class="managerCheck2" type="checkbox" id="<?php echo $building['id'] . 'Input'; ?>"
                                        name="<?php echo $building['id'] . 'Input'; ?>">
                                <?php } ?>
                            <?php } //closes the foreach loop for the buildings checkboxs ?>
                        </div>
                        <div class="col-11">
                            <?php
                            foreach ($buildings as $building) {//This loop generates a checked or checked checkbox for each building depending on if that building is availiable or not ?>
                                <div class="dropdown d-grid">
                                    <!-- <button type="button" class="btn btn-outline-dark dropdown-toggle managerDrop"
                                        data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                        >
                                        Under each building we want to have the room types associated with that building
                                        Sum room types will be listed twice this is because they are availbile in multiple buildings
                                        Housing Communities in <?php echo $building['building_name']; ?>Title for separation
                                    </button> THis is the original button-->
                                    <!--New color coded buttons-->
                                    <?php if ($building['campus_id'] == 1) { //Case for cal buildings ?>
                                        <button type="button"
                                            class="btn californiaBtn btn-outline-dark dropdown-toggle managerDrop"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <!--Under each building we want to have the room types associated with that building-->
                                            <!--Sum room types will be listed twice this is because they are availbile in multiple buildings-->
                                            Housing Communites in
                                            <?php echo $building['building_name']; ?><!--Title for separation-->
                                        </button>
                                    <?php } //Closes the caase for  coloring cal building backgorunds
                                        elseif ($building['campus_id'] == 2) { //Case for clarion buildings ?>
                                        <button type="button"
                                            class="btn clarionBtn btn-outline-dark dropdown-toggle managerDrop"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <!--Under each building we want to have the room types associated with that building-->
                                            <!--Sum room types will be listed twice this is because they are availbile in multiple buildings-->
                                            Housing Communites in
                                            <?php echo $building['building_name']; ?><!--Title for separation-->
                                        </button>
                                    <?php } //Closes the ccase for coloring Clarion backgrounds
                                        elseif ($building['campus_id'] == 3) { //Case for edinoboro buildings ?>
                                        <button type="button"
                                            class="btn edinboroBtn btn-outline-dark dropdown-toggle managerDrop"
                                            data-bs-toggle="dropdown" data-bs-auto-close="outside">
                                            <!--Under each building we want to have the room types associated with that building-->
                                            <!--Sum room types will be listed twice this is because they are availbile in multiple buildings-->
                                            Housing Communities in
                                            <?php echo $building['building_name']; ?><!--Title for separation-->
                                        </button>
                                    <?php } //Ends the case for coloring Edinboro building backgrounds ?>
                                    <ul class="dropdown-menu">
                                        <?php
                                        foreach ($roomTypes as $roomType) { //This loop generates a checked or unchecked box depending on the room types available status ?>
                                            <?php if ($roomType['building_id'] == $building['id']) {
                                                //Now we must check that the llc is in that room type
                                                foreach ($llcs as $llc) {
                                                    if ($llc['room_type_id'] == $roomType['room_type_id'] && $llc['building_id'] == $building['id']) { //Now we show the check box ?>
                                                        <li><label
                                                                class="user-select-none custom-label dropdown-item border-top border-secondary-subtle"
                                                                style="margin-top: 2px; font-size: 15px; cursor: pointer;"
                                                                for="<?php echo $llc['building_id'] . $llc['room_type_id'] . $llc['llc_id']; ?>"><?php echo $roomType['room_type'] . ' ' . $llc['llc_name'] . ": "; ?>
                                                                <?php if ($llc['available'] == 'Y') { //If the building is available disply a checked checkbox for that roomtype ?>
                                                                    <input class="managerCheck" type="checkbox"
                                                                        id="<?php echo $llc['building_id'] . $llc['room_type_id'] . $llc['llc_id']; ?>"
                                                                        name="<?php echo $llc['building_id'] . $llc['room_type_id'] . $llc['llc_id']; ?>"
                                                                        checked>
                                                                <?php } else {//Otherwise display an unchecked checkbox ?>
                                                                    <input class="managerCheck" type="checkbox"
                                                                        id="<?php echo $llc['building_id'] . $llc['room_type_id'] . $llc['llc_id']; ?>"
                                                                        name="<?php echo $llc['building_id'] . $llc['room_type_id'] . $llc['llc_id']; ?>">
                                                                <?php } ?> <!--Each checkbax has name/id building_id.room_type_id.llc_id-->
                                                            </label></li>
                                                    <?php } //Ends the if statement for checkbox generation ?>
                                                <?php } //Ends the foreach(llc) ?>
                                            <?php } //Ends the if id == id
                                        } ?><!--The '}' on this line ends the above forach loop for the roomtypes-->
                                    </ul>
                                </div>
                            <?php } ?> <!--The '}' on this line ends the outter forach loop fr the buildings-->
                        </div>
                        <br>
                        <span style="margin-bottom: 20px;"></span>
                        <div class="d-grid border-top border-secondary-subtle">
                            <input style="margin-top: 10px; margin-bottom: 10px;" class="btn btn-outline-secondary"
                                type="submit" value="Update Availability"><!--Form submit button-->
                        </div>
                </form>
            </div>
        </div>
        <div class="col-lg-3">
        </div>
    </div>
</div>
<?php
require_once '../view/footer.php'; //This requires the footer
?>
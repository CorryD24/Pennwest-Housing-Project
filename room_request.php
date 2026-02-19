<!--This page is the room request form-->

<?php
$title = "$mode Room Request";
//This is the page with the room change request form
require_once '../view/header.php'; //THis requires the header
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to view the room request form.';
    include '../view/error_page.php';
    die();
}
//There needs to be another check here so that the student doesn't try to navigate directly to this page
if (!isset($mode)) {
    //If someone tried navigating directly to this page these vars wouldn't be set
    //The only way the student should be able to navigate here is if they are both FALSE
    $errorMessage = 'Please navigate to this page using the navbar or edit request button.'; //IDRK what else to say here
    include '../view/error_page.php';
    die();
}
?>
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
            <form id="RoomRequestForm" action="../controller/controller.php?action=ProcessAddEditRoomRequest"
                method="post" enctype="multipart/form-data">

                <h2 style="font-size: 22px; text-align: center;"><span class="spanRed">*</span>Required</h2>

                <!--Hidden inputs for the form-->
                <input type="hidden" name="RoomRequestID" id="RoomRequestID"
                    value="<?php echo htmlspecialchars($roomRequestID); ?>" maxlength="50">
                <input type="hidden" name="Mode" id="Mode" value="<?php echo htmlspecialchars($mode); ?>"
                    maxlength="50">
                <input type="hidden" name="Email" id="Email" value="<?php echo htmlspecialchars($email); ?>"
                    maxlength="50">
                <input type="hidden" name="FirstName" id="FirstName" value="<?php echo htmlspecialchars($firstName); ?>"
                    maxlength="50">
                <input type="hidden" name="LastName" id="LastName" value="<?php echo htmlspecialchars($lastName); ?>"
                    maxlength="50">
                <input type="hidden" name="Completed" id="Completed" value="<?php echo htmlspecialchars($completed); ?>"
                    maxlength="1">
                <input type="hidden" name="EmailDateTime" id="EmailDateTime"
                    value="<?php echo htmlspecialchars($emailDateTime); ?>">
                <input type="hidden" name="Deleted" id="Deleted" value="<?php echo htmlspecialchars($deleted); ?>">


                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="preferredNameInput">Preferred Name (Max 15
                            Characters):</label> <!--pattern="[A-Za-z]{0,15}"-->
                    </div>
                    <input type="text" name="preferredNameInput" class="form-control" id="preferredNameInput"
                        value="<?php echo htmlspecialchars($perferredName); ?>" pattern="[a-zA-Z ]*" maxlength="25">
                    <!--Same pattern as roommates-->
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputCampus"><span class="spanRed">*</span>Choose a
                            Campus:</label>
                    </div>
                    <select class="form-control" name="inputCampus" id="inputCampus" required>
                        <?php
                        //it wont let them because its empty, no required astrik
                        echo "<option value='' selected disabled></option>";
                        //require '../model/model.php';
                        $campuses = load_campuses();
                        foreach ($campuses as $campusLoop) {
                            if ($mode == "Add") {
                                //if in add mode display the campuses like normal
                                echo "<option id='" . $campusLoop['id'] . "' value='" . $campusLoop['name'] . "'>" . $campusLoop['name'] . "</option>";
                            } else if ($mode == "Edit") {
                                if ($campusLoop['name'] == $campus) { //Current checks on id because id gets passed to db instead of name, will change
                                    //when fixxed
                                    //If in Edit mode and the name of this campus == the value sored in the $campus varible then display this campus
                                    //No need to let students change their campus, should prevent odd requests, and if needed they could delete it and resubmit
                                    //echo "<option></option>";
                                    echo "<option value=''>Click to clear drop downs</option>"; //They can click this to reset all drop downs if they want to redo the form
                                    //if they don't want to change the drop downs they can change one of the text fields and it should repost just fine
                                    echo "<option id='" . $campusLoop['id'] . "' value='" . $campusLoop['name'] . "' selected>" . $campusLoop['name'] . "</option>";
                                }
                            }
                        }
                        ?>
                    </select>
                    <?php if ($mode == "Edit") {?>
                        <small>*To clear the dropdowns, please select "Click to clear dropdowns"
                            under the campus selection, then reselect your campus.</small> <?php } ?>
                </div>

                <h5>Choose your most preferred Building, Room, and Housing Community:</h5>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputBuilding01"><span
                                class="spanRed">*</span>Choose a Building:</label>
                    </div>
                    <select name="inputBuilding01" class="form-control" id="inputBuilding01" required>
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                    var building1 = <?php echo json_encode($building1); ?>; //Take whats stored in $building1 and bring it into js
                                    if (building.name == building1) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$building1'>$building1</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputRoom01"><span class="spanRed">*</span>Choose a
                            Room Type:</label>
                    </div>
                    <select name="inputRoom01" class="form-control" id="inputRoom01" required>
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var roomType1 = <?php echo json_encode($roomType1); ?>; //Take whats stored in $roomType1 and bring it into js
                                    if (room.type == roomType1) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$roomType1'>$roomType1</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputLLC01">Choose a Housing
                            Community:</label>
                    </div>
                    <select name="inputLLC01" class="form-control" id="inputLLC01">
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var llc1 = <?php echo json_encode($llc1); ?>; //Take whats stored in $llc1 and bring it into js
                                    if (llc.name == llc1) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$llc1'>$llc1</option>";
                        }
                        ?>
                    </select>
                </div>

                <h5>Choose your second most preferred Building, Room, and Housing Community:</h5>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputBuilding02">Choose a Building:</label>
                    </div>
                    <select name="inputBuilding02" class="form-control" id="inputBuilding02">
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var building2 = <?php echo json_encode($building2); ?>; //Take whats stored in $building2 and bring it into js
                                    if (building.name == building2) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$building2'>$building2</option>";


                        }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputRoom02">Choose a Room Type:</label>
                    </div>
                    <select name="inputRoom02" class="form-control" id="inputRoom02">
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var roomType2 = <?php echo json_encode($roomType2); ?>; //Take whats stored in $roomType2 and bring it into js
                                    if (room.type == roomType2) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$roomType2'>$roomType2</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputLLC02">Choose a Housing
                            Community:</label>
                    </div>
                    <select name="inputLLC02" class="form-control" id="inputLLC02">
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var llc2 = <?php echo json_encode($llc2); ?>; //Take whats stored in $llc2 and bring it into js
                                    if (llc.name == llc2) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$llc2'>$llc2</option>";
                        }
                        ?>
                    </select>
                </div>

                <h5>Choose your third most preferred Building, Room, and Housing Community:</h5>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputBuilding03">Choose a Building:</label>
                    </div>
                    <select name="inputBuilding03" class="form-control" id="inputBuilding03">
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var building3 = <?php echo json_encode($building3); ?>; //Take whats stored in $building3 and bring it into js
                                    if (building.name == building3) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$building3'>$building3</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputRoom03">Choose a Room Type:</label>
                    </div>
                    <select name="inputRoom03" class="form-control" id="inputRoom03">
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var roomType3 = <?php echo json_encode($roomType3); ?>; //Take whats stored in $roomType3 and bring it into js
                                    if (room.type == roomType3) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$roomType3'>$roomType3</option>";
                        }
                        ?>
                    </select>
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="inputLLC03">Choose a Housing
                            Community:</label>
                    </div>
                    <select name="inputLLC03" class="form-control" id="inputLLC03">
                        <?php
                        if ($mode == "Add") {
                            echo "<option selected disabled></option>";
                        } else if ($mode == "Edit") { ?>
                                <script type="text/javascript"> //Combined js and php
                                        var llc3 = <?php echo json_encode($llc3); ?>; //Take whats stored in $llc3 and bring it into js
                                    if (llc.name == llc3) //compare to builidng.id in main file I think
                                </script>
                            <?php //Echo out what student previously selected
                                echo "<option selected value='$llc3'>$llc3</option>";
                        }
                        ?>
                    </select>
                </div>

                <h5>Choose up to 3 roommates:</h5>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="roommateInput01">Roommate 1 Name:</label>
                    </div>
                    <input name="roommateInput01" type="text" class="form-control" id="roommateInput01"
                        value="<?php echo htmlspecialchars($roommate1) ?>" pattern="[a-zA-Z \']*"
                        maxlength="25"><!--THis pattern only allows upper case, lower case, and spaces-->
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="roommateInput02">Roommate 2 Name:</label>
                    </div>
                    <input name="roommateInput02" type="text" class="form-control" id="roommateInput02"
                        value="<?php echo htmlspecialchars($roommate2) ?>" pattern="[a-zA-Z \']*" maxlength="25">
                </div>

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <label class="input-group-text font13" for="roommateInput03">Roommate 3 Name:</label>
                    </div>
                    <input name="roommateInput03" type="text" class="form-control" id="roommateInput03"
                        value="<?php echo htmlspecialchars($roommate3) ?>" pattern="[a-zA-Z \']*" maxlength="25">
                </div>

                <div class="d-grid border-top border-secondary-subtle">
                    <input style="margin-top: 10px;" class="btn btn-outline-secondary btnMarginB" type="submit"
                        value="<?php echo $mode; ?> Request ">
                </div>
            </form>
        </div>
        <div class="col-lg-3">
        </div>
    </div>
</div>


<?php
require_once '../view/footer.php'; //THis requires the header

?>
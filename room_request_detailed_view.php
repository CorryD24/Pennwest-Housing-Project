<?php
$title = "Room Request Detailed View";
//This page will have the detailed view of a room request
require_once '../view/header.php'; //This requires the header
// First, check if user is logged ini
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to view the room request.';
    include '../view/error_page.php';
    die();
}
//Next will be condition checking to see tht $row is set, this prevents users from navigating directly to the page via search bar
if (!isset($row)) {
    $errorMessage = 'No row was selected.'; //error message
    include '../view/error_page.php';
    die();
}
// If they are logged in, ensure they have permission to view the page
/*else {
    if (!(in_array('AG-ROLE-STAFF', $_SESSION['Role']))) {
        header("Location: index.php");
        exit;
    }
}*/
?>
<!--Detailed view of a room change request-->
<div class="container-lg">
    <div class="row">
        <div class="col-lg-12">
            <h1>Room Request Details</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-1">
        </div>

        <div class="col-lg-10 centerColumnGray">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-responsive">
                        <table class="table" style="margin-top: 10px;">
                            <thead class="font15">
                                <tr>
                                    <!--The if statment hides the postion form the students view-->
                                    <?php if ((in_array('AG-ROLE-STAFF', $_SESSION['Role']))) { ?>
                                        <th scope="col">Position</th>
                                        <!--Handy addition, for bumping to bottom, user knows it worked-->
                                        <th scope="col">Name</th>
                                        <th scope="col">Preferred Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Campus</th>
                                    <?php } else { ?>
                                        <th colspan="2" scope="col">Name</th>
                                        <th scope="col">Preferred Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Campus</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody class="font13">
                                <tr>
                                    <!--All that is need to echo the correct info is the following php
                                    row was returned by the view_my_request function in the controller
                                    row is an associative array of the students request in the db-->
                                    <!--Again the if statement only shows the postion to admins-->
                                    <?php if ((in_array('AG-ROLE-STAFF', $_SESSION['Role']))) { ?>
                                        <td scope="row">
                                            <?php echo htmlspecialchars($row['id']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['last_name'] . ", " . $row['first_name']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['preferred_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['campus']); ?></td>
                                    <?php } else { ?>
                                        <td colspan="2" scope="row">
                                            <?php echo htmlspecialchars($row['last_name'] . ", " . $row['first_name']); ?>
                                        </td>
                                        <td><?php echo htmlspecialchars($row['preferred_name']); ?></td>
                                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                                        <td><?php echo htmlspecialchars($row['campus']); ?></td>
                                    <?php } ?>

                                </tr>
                            </tbody>

                            <thead class="font15">
                                <tr>
                                    <th colspan="2" scope="col">Building 1</th>
                                    <th colspan="2" scope="col">Room 1</th>
                                    <th scope="col">Housing Community 1</th>
                                </tr>
                            </thead>
                            <tbody class="font13">
                                <tr>
                                    <td colspan="2" scope="row"><?php echo htmlspecialchars($row['building1']); ?></td>
                                    <td colspan="2"><?php echo htmlspecialchars($row['room_type1']); ?></td>
                                    <td>
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['llc1'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['llc1']);
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>


                            <thead class="font15">
                                <tr>
                                    <th colspan="2" scope="col">Building 2</th>
                                    <th colspan="2" scope="col">Room 2</th>
                                    <th scope="col">Housing Community 2</th>
                                </tr>
                            </thead>
                            <tbody class="font13">
                                <tr>
                                    <td colspan="2" scope="row">
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['building2'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['building2']);
                                        }
                                        ?>
                                    </td>
                                    <td colspan="2">
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['room_type2'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['room_type2']);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['llc2'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['llc2']);
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>


                            <thead class="font15">
                                <tr>
                                    <th colspan="2" scope="col">Building 3</th>
                                    <th colspan="2" scope="col">Room 3</th>
                                    <th scope="col">Housing Community 3</th>
                                </tr>
                            </thead>
                            <tbody class="font13">
                                <tr>
                                    <td colspan="2" scope="col">
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['building3'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['building3']);
                                        }
                                        ?>
                                    </td>
                                    <td colspan="2">
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['room_type3'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['room_type3']);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['llc3'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['llc3']);
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>


                            <thead class="font15">
                                <tr>
                                    <th colspan="2" scope="col">Roommate 1</th>
                                    <th colspan="2" scope="col">Roommate 2</th>
                                    <th scope="col">Roommate 3</th>
                                </tr>
                            </thead>
                            <tbody class="font13">
                                <tr>
                                    <td colspan="2" scope="row">
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['roommate1'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['roommate1']);
                                        }
                                        ?>
                                    </td>
                                    <td colspan="2">
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['roommate2'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['roommate2']);
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                        if (!isset($row['roommate3'])) {
                                            echo "NOT CHOSEN";
                                        } else {
                                            echo htmlspecialchars($row['roommate3']);
                                        }
                                        ?>
                                    </td>
                                </tr>
                            </tbody>

                            <thead class="font15">
                                <tr>
                                    <th colspan="5" scope="col">Email Timestamp</th>
                                </tr>
                            </thead>
                            <tbody sclass="font13">
                                <td colspan="5" scope="row">
                                    <?php // Either display the date and time or a message saying it hasn't been sent (null)
                                    if (!isset($row['email_datetime'])) {
                                        echo "Confirmation email has not been sent yet.";
                                    } else {
                                        $dateTime = new DateTime($row['email_datetime']);
                                        echo $dateTime->format('l, F j, Y h:i A');
                                    }
                                    ?>

                                </td>
                            </tbody>
                            <thead class="font15">
                                <tr>
                                    <th colspan="5" scope="col">Completed</th>
                                </tr>
                            </thead>
                            <tbody class="font13">
                                <td colspan="5" scope="row">
                                    <?php //completed stores Y or N we want to display yes or no
                                    if ($row['completed'] == 'N') {
                                        echo "No";
                                    } else if ($row['completed'] == 'Y') {
                                        echo "Yes";
                                    }
                                    ?>
                                </td>
                            </tbody>
                            <?php if ($row['deleted'] == 'Y') { //We only diplay this if the request was 'deleted' by admin ?>
                                <thead class="font15">
                                    <tr>
                                        <th colspan="5" scope="col">Deleted</th>
                                    </tr>
                                </thead>
                                <tbody class="font13">
                                    <td colspan="5" scope="row">
                                        <?php echo 'Yes'; ?>
                                    </td>
                                </tbody>
                            <?php } ?>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12 centerColumnGray">
                        <!--Both Admins and students need to be able to edit their own requests. Since admins can view a request they submitted,
                            then they need to be allowed to edit it, but hey can only be allowed to edit their own request-->
                        <?php if ($_SESSION['Email'] == $row['email']) { //User that is logged in email must match the email in the row being displayed
                                //THis means whoever is using the site can onl edit requests they submitted ?>
                            <!--This is the buton for editing your roomchange reques-->
                            <input type="button" class="btn btn-outline-success btnMarginB" name="EditButton"
                                id="EditButton" value="Edit Request"
                                onclick="document.location='../controller/controller.php?action=EditRoomRequest&RoomRequestID=<?php echo $row['id'] ?>';">
                        <?php }
                            //Studensts need to be able to delete and edit their requests
                            if (in_array('AG-ROLE-STUDENT', $_SESSION['Role'])) { ?>
                            <!--This is the button for deleting your room change request-->
                            <input type="button" style="float: right; " class="btn btn-outline-danger btnMarginB"
                                name="DeleteButton" id="DeleteButton" value="Delete Request" onclick="conformation()">

                        <?php } else if (in_array('AG-ROLE-STAFF', $_SESSION['Role'])) { ?>
                                <!-- Staff buttons, deleteX, bump to bottom, mark as complete, send email-->
                                <!-- Send automated email button -->
                                <input type="button" class="btn btn-outline-primary btnMarginB" name="SendEmailButton"
                                    id="SendEmailButton" value="Send Email"
                                    onclick="document.location='../controller/controller.php?action=SendEmail&Form=RoomRequest&ReqID=<?php echo $row['id'] ?>&Email=<?php echo $row['email'] ?>&FirstName=<?php echo $row['first_name'] ?>&PreferredName=<?php echo $row['preferred_name'] ?>&LastName=<?php echo $row['last_name'] ?>'">
                                <!--Bump to bottom button-->

                                <input type="button" class="btn btn-outline-primary btnMarginB" name="BumpToBottomButton"
                                    id="BumpToBottomButton" value="Bump to Bottom"
                                    onclick="bump_to_bottom_confirmation()"><!--Call the confirmation fctn-->
                                <!--We must send the row to for this feature as we are deketeing and reuploading the request so it gets
                               the newwest id number and therefore displayed last when sorting normally.-->

                                <!--Change Completition Status Button-->
                                <input type="button" class="btn btn-outline-success btnMarginB" name="Completition"
                                    id="Completition" <?php
                                    if ($row['completed'] == 'Y') { //'Y' would mean the request is already completed
                                        ?> value="Mark Uncomplete" <?php } elseif ($row['completed'] == 'N') { //'N' would mean the request is uncomplete ?> value="Mark Complete" <?php } ?>
                                    onclick="document.location = '../controller/controller.php?action=ChangeRoomRequestCompleted&RoomRequestID=<?php echo $row['id']; ?>'">


                                <!--Admin delete button-->
                                <input type="button" style="float: right;" class="btn btn-outline-danger btnMarginB"
                                    name="DeleteButton2" id="DeleteButton2" value="Delete Request"
                                    onclick="admin_conformation()">

                                <!--Undo "Delete Button"-->
                            <?php if ($row['deleted'] == 'Y') { ?>
                                    <input type="button" style="float: right; margin-right: 3px;"
                                        class="btn btn-outline-primary btnMarginB" name="UndoDelete" id="UndoDelete"
                                        value="Undo Delete" onclick="undo_confirmation()">
                            <?php } ?> <!--Ends if statment around undo button-->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<!--Java script-->
<script>
    function conformation() { //This function asks the user if they are sure they want to dlete their request
        if (confirm("Are you sure that want to delete your request?") === true) {
            document.location.href = '../controller/controller.php?action=DeleteRoomRequest&RoomRequestID=<?php echo $row['id'] ?>&DeleteType=Permanate';
        }
        else {
            exit;
        }
    }
    /**
     * This function handles when an admin goes to delete a request. If handles the correct navigation
     */
    function admin_conformation() {
        var deletedRow = <?php echo json_encode($row['deleted']); ?>; //get the deleted status of the row
        if (deletedRow == 'N') {//If the row hasn't been 'deleted' as in pretend deleted we want to pretend to delete it
            if (confirm("Are you sure you want to delete the request?") === true) {
                document.location.href = '../controller/controller.php?action=DeleteRoomRequest&RoomRequestID=<?php echo $row['id'] ?>&DeleteType=Pretend';
            }
            else { //Dont 'delete'row
                exit;
            }
        }
        else if (deletedRow == 'Y') { //Otherwise if we already pretneded to delete we really are gonna now
            if (confirm("This request has already been marked for deletion. If you procede the request will be permanately deleted.") === true) {
                document.location.href = '../controller/controller.php?action=DeleteRoomRequest&RoomRequestID=<?php echo $row['id'] ?>&DeleteType=Permanate';
            }
            else { //Dont 'delete'row
                exit;
            }
        }

    } s
    /**
     * This function confirms that the user wants to bumpt the request to the bottom of the queue
     */
    function bump_to_bottom_confirmation() {
        if (confirm("Are you sure you want to bump this request to the bottom of the queue?") === true) {
            document.location.href = '../controller/controller.php?action=BumpRoomRequestToBottom&Row=<?php echo $row['id']; ?>';
        }
        else {
            exit; //Dont bumpt to bottom
        }
    }

    /**
     * This funtion handles the confirmation of revoering a row fromt the pretend delete
     */
    function undo_confirmation() {
        if (confirm("Are you sure that you'd like to recover this request?") === true) {
            document.location.href = '../controller/controller.php?action=UndoDeleteRoomRequest&RoomRequestID=<?php echo $row['id'] ?>';
            //Go to case to undo delete
        }
        else {
            exit; //Do nothing
        }
    }
</script>
<?php
require_once '../view/footer.php'; //THis requires the footer

?>
<?php
//This is the controller it will have a big switch staement and various fctns
// Sum of these fctns will call the fctns in the model

session_start();
require '../model/model.php'; //so we can see fctns in model

//require_once '../lib/gerneralfunctions.php'; //If needed

if (isset($_POST['action'])) { // check get and post
    $action = $_POST['action'];
} else if (isset($_GET['action'])) {
    $action = $_GET['action'];
} else {
    include('../view/index.php'); // default action
    exit();
}
//Switch statment handles zsite navigation
switch($action) {
    //These cases are for both views
    //We should try to alphabetize the cases in both sections student and admin
    case 'About':
        include '../view/about.php'; //This is the case for if the student clicks on the about page
        break;
    case 'Home': //This would be the case if the user clicks on the button to go to the home page
        include('../view/index.php'); //This includes the proper page, in this case the home page of our site
        break; //This is to break out of the switch block I think
    case 'DeleteRoomChangeRequest':
        remove_room_change_request(); //Case for deleting a room change request
        break;
    case 'DeleteRoomRequest':
        remove_room_request();  //Case for deleting a room request;
        break;
    //The following are student specific actions
    case 'EditRoomChangeRequest':
        edit_room_change_request(); //Case for editing room change requests
        break;
    case 'EditRoomRequest':
        edit_room_request(); //Case for editing a room request
        break;
    case 'ProcessAddEditRoomChangeRequest':
        process_add_edit_room_change_request(); //Case for adding or editing a room change request
        break;
    case 'ProcessAddEditRoomRequest':
        process_add_edit_room_request(); //Case for adding and editing a room request
        break;
    case 'RoomChangeRequest': //This is the case for if the user clicks on the button to go to the room change request form
        add_room_change_request();
        break;
    case 'RoomRequest': //This is the case for if the user clicks on the button to go to the room request form
        add_room_request();
        break;
    case 'ViewMyRequest': //This is the case for if the user clicks on the button to go to the page to view their request
        view_my_request();
        break;
    //I think that is all of the student specific navigation actions, if not we can add more easily
    //The next navigation actions I think would be specific to admins(the clients)
    case 'AddBuilding':
        add_buildings(); //This is the case for if the user wants to add new buildings
        break;
    case 'AddRoomType':
        add_room_types(); //This is the case for adding new room types
        break;
    case 'AddLLC':
        add_llcs(); //This is the case for adding new LLCs
        break;
    case 'BumpRoomChangeRequestToBottom':
        bump_room_change_request_to_bottom(); //This is the case for bumping a room change request to the bottom
        break;
    case 'BumpRoomRequestToBottom':
        bump_room_request_to_bottom(); //This is the case for bumping a room request to the bottom
        break;
    case 'ChangeRoomChangeRequestCompleted': //THis is the case for changing the completion status of a room change request
        change_room_change_request_completed();
        break;
    case 'ChangeRoomRequestCompleted': //THis is the case for changing the completion status of a room request
        change_room_request_completed();
        break;
    case 'EmailManager':
        include '../view/email_manager.php'; //This is the case for is the admin clicks on the  email manager page
        break;
    case 'DisplayRoomChangeRequest': //Case fo if the user wants a detailed view of a room change request
        display_room_change_request();
        break;
    case 'DisplayRoomRequest': //This is the case for if the user clicks on a room request in the table to view in depth
        display_room_request(); //This fctn is called it can be found below
        break;
    case 'InputManager':
        input_manager_form_load(); //THis is the case for if the admin cliscks on the link to manage form input
        break;
    case 'LLCInputManager':
        llc_input_manager_form_load(); //THis is the case for if the user clicks on the link to maange llc form input
        break;
    case 'ListStudents':
        list_requests(); //THis the case that is used when a user wants to table view a set of requests
        break;
    case 'ManageRoomChangeRequests': //This is the case for if the user clicks on the button to go to the manage room change requests page
        include '../view/manage_room_change_requests.php';
        break;
    case 'ManageRoomRequests': //This is the case for if the user clicks on the button to go to the manage room requests page
        include '../view/manage_room_requests.php';
        break;
    case 'ProcessAddBuilding':
        process_add_building(); //Case for the handling of the adding of a building
        break;
    case 'ProcessAddRoomType':
        process_add_room_type(); //Case for is the user wants to add a new room type
        break;
    case 'ProcessAddLLC':
        process_add_llc(); //Case for if the user is adding a new LLC
        break;
    case 'ProcessEditFormInputs': //THis is the case for when the user wants tos submit the modifications to the availible rooms/ buildings
        process_edit_form_inputs();
        break;
    case 'ProcessEditFormLLCInputs':
        process_edit_form_llc_inputs(); //THis is the case for processing updates made to LLC availability
        break;
    case 'ProcessEmail':
        process_email_upload(); //This occurs when admin uploads new email via txt file
        break;
    case 'ProcessUserGuide':
        process_user_guide_upload();
        break;
    case 'SendEmail': // Case for sending automatic confirmation email to student
        send_email();
        break;
    case 'UndoDeleteRoomChangeRequest':
        undo_delete_room_change_request(); //Case for undoing a delete on a room change request
        break;
    case 'UndoDeleteRoomRequest':
        undo_delete_room_request(); //Case for undoing a delte on room request
        break;
    default:
        include('../view/index.php'); // default case
}
//Below will be various functions sum of them will call functions in the model
//We should try to sort these alphabetically too

function add_buildings() {
    //No need to set up checks like the request forms, just set up the vars
    $buildingID = 0;
    $campus = "";
    $buildingName = "";
    $available = ''; //char
    $availableLLC = 'Y'; //force a default value
    include '../view/add_buildings.php';
}
function add_room_types() {
    //No need to set up checks here either
    $roomTypeID = 0;
    $campus = "";
    $roomTypeName = "";
    $available = '';
    include '../view/add_room_types.php';
}
function add_llcs() {
    $llcID = 0;
    $campus = "";
    $llcName = "";
    $available = '';
    include '../view/add_llcs.php';
}
/**This function handles navigating to the room change request form
 * @return void
 */
function add_room_change_request() {
    //We need to do some checking, we don't want to let the user into the form if they already have an unfullfilled request
    //We do this here because this the fctn that is called when a student clicks on the link to the form
    $testRow = get_room_change_request_by_email($_SESSION['Email']);
    $testRow2 = get_room_request_by_email($_SESSION['Email']);
    //We pass the students email from SSO if there email is in a row in room_chnage_request table it returns that row otherwise
    //it returns FALSE, so if $testRow isn't FALSE then the student already has a room change reqquest that is fullfilled yet

    if($testRow != FALSE){ //Replace with $testRow != FALSE when want these in use, commented out for simplicity of testing
        $errorMessage = "You have already submitted a room change request that hasn't been fullfilled. You can only have 1 room change request at a time.
        If you would like to edit your room change request, you may do so.";
        include '../view/error_page.php';
    }
    //Now lets check for if the studen has an unfillfilled room request, this prevents students from submint a cahnge request after subing a room
    //request before the semester start
    else if ($testRow2 != FALSE){ //Replace with testRow2 != FALSE if youd like it to work
        $errorMessage = "You currently have an unfilled room request. You cannot open a room change request if you have an unfullfilled 
        room request.";
        include '../view/error_page.php'; //include error page
    }
    //If both testRows are FALSE then we allow them to create a request
    else {
        $mode = "Add"; //$mode will tell us if the user is addind or editing a request, we are adding here
        $roomChangeRequestID = 0;
        $email = $_SESSION['Email'];
        $firstName = $_SESSION['FirstName'];
        $lastName = $_SESSION['LastName']; //THESE SHOULD BE THE CORRECT VALUES
        $perferredName = "";
        $campus = ""; //COULD BE REPLACED BY PULLING FROM SSO
        $building1 = "";
        $roomType1 = "";
        $llc1 = "";
        $building2 = "";
        $roomType2 = "";
        $llc2 = "";
        $building3 = "";
        $roomType3 = "";
        $llc3 = "";
        $roommate1 = "";
        $roommate2 = "";
        $roommate3 = "";
        $reason = ""; //unique to room change requests
        //$emailDateTime = "";
        $completed = 'N'; //default completed to No because it is jsut being submitted
        $deleted = 'N'; //Default delted to No because it is just being submitted
        //Now just include the form
        include '../view/room_change_request.php';
    }
}

/**This function handles navigating to the room request form
 * @return void
 */
function add_room_request() {
    //We need to do some checking, we don't want to let the user into the form if they already have an unfullfilled request
    //We do this here because this the fctn that is called when a student clicks on the link to the form
    $testRow = get_room_request_by_email($_SESSION['Email']);
    $testRow2 = get_room_change_request_by_email($_SESSION['Email']);
    //We pass the students email from SSO if there email is in a row in room_request table it returns that row otherwise
    //it returns FALSE, so if $testRow isn't FALSE then the student already has a room reqquest that is fullfilled yet

    if($testRow != FALSE){ //Replace with $testRow != FALSE when want to use the checks, commented out for ease of testing
        $errorMessage = "You have already submitted a room request that hasn't been fullfilled. You can only have 1 room request at a time.
        If you would like to edit your room request, you may do so.";
        include '../view/error_page.php'; //include error page
    }
    //Dont allow sumone with an unfullfilled room change request to submit a room request
    else if ($testRow2 != FALSE){ //Replace with testRow2 != FALSE if you want it to work
        $errorMessage = "You currently have an unfilled room change request. You cannot submit a room request if you have an unfullfilled
        room change request.";
        include '../view/error_page.php';
    }
    //If both testRows are  FALSE then we allow them to create a request
    else {
        $mode = "Add"; //$mode will tell us if the user is addind or editing a request, we are adding here
        $roomChangeRequestID = 0;
        $email = $_SESSION['Email'];
        $firstName = $_SESSION['FirstName'];
        $lastName = $_SESSION['LastName']; //THESE SHOULD BE THE CORRECT VALUES
        $perferredName = "";
        $campus = ""; //COULD BE REPLACED BY PULLING FROM SSO
        $building1 = "";
        $roomType1 = "";
        $llc1 = "";
        $building2 = "";
        $roomType2 = "";
        $llc2 = "";
        $building3 = "";
        $roomType3 = "";
        $llc3 = "";
        $roommate1 = "";
        $roommate2 = "";
        $roommate3 = "";
        //$emailDateTime = "";
        $completed = 'N'; //default completed to No because it is jsut being submitted
        $deleted = 'N'; //Default delted to No because it is just being submitted
        //Now just include the form
        include '../view/room_request.php';
    }
}
/** This is the function for bumping a roo change request to the bottom. It saves the row, deletes the row then reuploads it so it
 * has the largest id number and is the newwest request.
 * @return void
 */
function bump_room_change_request_to_bottom(){
    $roomChangeRequestId = $_GET['Row']; //id of the row
    $rowToBump = get_room_change_request($roomChangeRequestId); //get the row so we have it
    $rowsAffected = delete_room_change_request($roomChangeRequestId);//Pass in the id of the row we want to delete
    //The delete fctn retruns the number of rows affected
    if ($rowsAffected > 1){
        $errorMessage = "The delete effected multiple rows. " . $rowsAffected ." rows exactly. Request has been deleted.";
        include '../view/error_page.php';//Include the error page
    }
    else{
        //If we avaoid error we shall continue
        //now we need to reupload the request
        $rowToBump['Deleted'] = 'N'; //Its get mad about deleted being null this fixes it
        $roomChangeRequestId = reinsert_room_change_request($rowToBump['email'], $rowToBump['first_name'], $rowToBump['last_name'], $rowToBump['preferred_name'], $rowToBump['campus'], $rowToBump['building1'], $rowToBump['room_type1'], $rowToBump['llc1'], $rowToBump['building2'], $rowToBump['room_type2'], $rowToBump['llc2'], $rowToBump['building3'], $rowToBump['room_type3'], $rowToBump['llc3'], $rowToBump['roommate1'], $rowToBump['roommate2'], $rowToBump['roommate3'], $rowToBump['reason'], $rowToBump['email_datetime'], $rowToBump['completed'], $rowToBump['Deleted']);
        //We reinsert the row intot he $db, and reset the id
        //The request will now have the highest id
        //Lets redirect back to the detailed view
        $row = get_room_change_request($roomChangeRequestId); //This is the new row for the request after being bumped down
        header("Location: ../controller/controller.php?action=DisplayRoomChangeRequest&RoomChangeRequestID=$roomChangeRequestId");
        //This redirect ensures that the correct row is displayed with the new id, when using tha php var in a header fctn use "" not ''
    }
}
/** This is the function for bumping a room request to the bottom. It saves the row, deletes the row then reuploads it so it
 * has the largest id number and is the newwest request.
 * @return void
 */
function bump_room_request_to_bottom(){
    $roomRequestId = $_GET['Row']; //id of the row
    $rowToBump = get_room_request($roomRequestId); //get the row so we have it
    $rowsAffected = delete_room_request($roomRequestId);//Pass in the id of the row we want to delete
    //The delete fctn retruns the number of rows affected
    if ($rowsAffected > 1){
        $errorMessage = "The delete effected multiple rows. " . $rowsAffected ." rows exactly. Request has been deleted.";
        include '../view/error_page.php';//Include the error page
    }
    else{
        //If we avaoid error we shall continue
        //now we need to reupload the request
        $rowToBump['Deleted'] = 'N'; //Its get mad about deleted being null this fixes it
        $roomRequestId = reinsert_room_request($rowToBump['email'], $rowToBump['first_name'], $rowToBump['last_name'], $rowToBump['preferred_name'], $rowToBump['campus'], $rowToBump['building1'], $rowToBump['room_type1'], $rowToBump['llc1'], $rowToBump['building2'], $rowToBump['room_type2'], $rowToBump['llc2'], $rowToBump['building3'], $rowToBump['room_type3'], $rowToBump['llc3'], $rowToBump['roommate1'], $rowToBump['roommate2'], $rowToBump['roommate3'], $rowToBump['email_datetime'], $rowToBump['completed'], $rowToBump['Deleted']);
        //We reinsert the row intot he $db, and reset the id
        //The request will now have the highest id
        $row = get_room_request($roomRequestId); //This is the new row for the request after being bumped down
        header("Location: ../controller/controller.php?action=DisplayRoomRequest&RoomRequestID=$roomRequestId");
        //This redirect ensures that the correct row is displayed with the new id, when using tha php var in a header fctn use "" not ''
    }
}

/**
 * @return void This function gets the row by $POST and determines whhich parametes to use when calling the function in the model
 * that will modify the row.
 */
function change_room_change_request_completed(){
    $roomChangeRequestID = $_GET['RoomChangeRequestID']; //This is the row we are changing the completition status of
    $row = get_room_change_request($roomChangeRequestID); //get the orw associated with the request
    if($row == FALSE){
        //Row will be false if now row is returned
        $errorMessage = "A row with id=".$roomChangeRequestID." does not exist.";
        include '../view/error_page.php'; //Include error message and page
    }
    else {
        $current = $row['completed'];
        if ($row['completed'] == 'Y') {
            $new = 'N'; // new completed status
            manage_room_change_request_completed($roomChangeRequestID, $new);
            //If the request is already complete then we want to mark it as uncomplete. To do this we pass in the id of the row, the word
            //"complete" whcih will be used in the function along with the 'N'.
        } else if ($row['completed'] == 'N') {
            $new = 'Y'; //new completed status
            manage_room_change_request_completed($roomChangeRequestID, $new);
            //Otherwise if the request is uncomplete then we want to mark it as complete. To do this we pass in the id of the row, the word
            //"uncomplete" whcih will be used in the function along with the 'Y'.
        }
        $row = get_room_change_request($roomChangeRequestID); //Re gt the updated row so it displays correctly
        include '../view/room_change_request_detailed_view.php'; //return to the detailed view to see the updated completition status
    }
}

/**
* @return void This function gets the row by $POST and determines whhich parametes to use when calling the function in the model
* that will modify the row.
 */
function change_room_request_completed(){
    $roomRequestID = $_GET['RoomRequestID']; //This is the row we are changing the completition status of
    $row = get_room_request($roomRequestID); //get the orw associated with the request
    if($row == FALSE){
        //Row will be false if now row is returned
        $errorMessage = "A row with id=".$roomRequestID." does not exist.";
        include '../view/error_page.php'; //Include error message and page
    }
    else {
        $current = $row['completed'];
        if ($row['completed'] == 'Y') {
            $new = 'N'; // new completed status
            manage_room_request_completed($roomRequestID, $new);
            //If the request is already complete then we want to mark it as uncomplete. To do this we pass in the id of the row, the word
            //"complete" whcih will be used in the function along with the 'N'.
        } else if ($row['completed'] == 'N') {
            $new = 'Y'; //new completed status
            manage_room_request_completed($roomRequestID, $new);
            //Otherwise if the request is uncomplete then we want to mark it as complete. To do this we pass in the id of the row, the word
            //"uncomplete" whcih will be used in the function along with the 'Y'.
        }
        $row = get_room_request($roomRequestID); //Reget the updated row so i displays correctly
        include '../view/room_request_detailed_view.php'; //return to the detailed view to see the updated completition status
    }
}
/**
 * @return void
 * This function will be called when he user clicks on a request in table displaying the room change requests.
 * It will give the user an indepth view of that request
 */
function display_room_change_request(){
    $roomChangeRequestID = $_GET['RoomChangeRequestID']; //GET room change request ID
    if(!isset($roomChangeRequestID)){
        //If the id isn't set then we want to error out
        $errorMessage = "A room change request ID must be provided."; //error message
        include '../view/error_page.php'; //include the error page
    }
    else{
        //Otherwise we want to go to the detailed view for that request
        $row = get_room_change_request($roomChangeRequestID); //get the row from the db that matches the ID provided
        if ($row == FALSE){
            //$row will be false if the no row is returned, this means this ID isn't in the db
            $errorMessage = "There is no room change request with that ID."; //error message
            include '../view/error_page.php'; //include ther error page
        }
        else{
            //Otherwise we want to go to the detailed view for that request
            include "../view/room_change_request_detailed_view.php"; //include detailed view
        }
    }
}

/**
 * @return void
 * This function will be called when he user clicks on a request in table displaying the room requests.
 *  It will give the user an indepth view of that request
 */
function display_room_request(){
    $roomRequestID = $_GET['RoomRequestID']; //GET room request ID
    if(!isset($roomRequestID)){
        //If the id isn't set then we want to error out
        $errorMessage = "A room request ID must be provided."; //error message
        include '../view/error_page.php'; //include the error page
    }
    else{
        //Otherwise we want to go to the detailed view for that request
        $row = get_room_request($roomRequestID); //get the row from the db that matches the ID provided
        if ($row == FALSE){
            //$row will be false if the no row is returned, this means this ID isn't in the db
            $errorMessage = "There is no room request with that ID."; //error message
            include '../view/error_page.php'; //include ther error page
        }
        else{
            //Otherwise we want to go to the detailed view for that request
            include "../view/room_request_detailed_view.php"; //include detailed view
        }
    }
}

/**This is the function that is called when the user wants to edit their request. It setsup the editing process but doesn't actually handle the editing.
 * @return void
 */
function edit_room_change_request(){
    $roomChangeRequestID = $_GET['RoomChangeRequestID']; //We navigate to the edit form from the view my request page so we have this
    if(!isset($roomChangeRequestID)){ //Make sure there is an ID
        $errorMessage = "Room Change Request ID is required";
        include ('../view/error.php'); //include the error page if error happens
    }
    else{
        $row = get_room_change_request($roomChangeRequestID); //This function will return the db row with the provided ID from table room_change_request
        if($row == FALSE){
            $errorMessage = "That room change request does not exist";
            include ('../view/error_page.php');// include the error page
        }
        else{
            $mode = "Edit"; //this varible tells us we are in edit mode and not add mode
            //We must set the vars that are associated with the request type
            //These varibles are used to populate the form when in edit mode with the users originall values
            //This is why we are stting them to their old values, this function justs sets up the editing process, it foesn't actually do the editing
            $roomChangeRequestID = $row['id'];
            $email = $row['email'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $perferredName = $row['preferred_name'];
            $campus = $row['campus'];
            $building1 = $row['building1'];
            $roomType1 = $row['room_type1'];
            $llc1 = $row['llc1'];
            $building2 = $row['building2'];
            $roomType2 = $row['room_type2'];
            $llc2 = $row['llc2'];
            $building3 = $row['building3'];
            $roomType3 = $row['room_type3'];
            $llc3 = $row['llc3'];
            $roommate1 = $row['roommate1'];
            $roommate2 = $row['roommate2'];
            $roommate3 = $row['roommate3'];
            $reason = $row['reason']; //unique to room change requests
            $completed = $row['completed'];
            $deleted = $row['deleted'];
            //Now we can include the form
            include '../view/room_change_request.php'; //room change request form
        }
    }
}

function edit_room_request(){
    $roomRequestID = $_GET['RoomRequestID']; //We navigate to the edit form from the view my request page so we have this
    if(!isset($roomRequestID)){ //Make sure there is an ID
        $errorMessage = "Room request ID is required";
        include ('../view/error.php'); //include the error page if error happens
    }
    else{
        $row = get_room_request($roomRequestID); //This function will return the db row with the provided ID from table room_change_request
        if($row == FALSE){
            $errorMessage = "That room request does not exist";
            include ('../view/error_page.php');// include the error page
        }
        else{
            $mode = "Edit"; //this varible tells us we are in edit mode and not add mode
            //We must set the vars that are associated with the request type
            //These varibles are used to populate the form when in edit mode with the users originall values
            //This is why we are stting them to their old values, this function justs sets up the editing process, it foesn't actually do the editing
            $roomChangeRequestID = $row['id'];
            $email = $row['email'];
            $firstName = $row['first_name'];
            $lastName = $row['last_name'];
            $perferredName = $row['preferred_name'];
            $campus = $row['campus'];
            $building1 = $row['building1'];
            $roomType1 = $row['room_type1'];
            $llc1 = $row['llc1'];
            $building2 = $row['building2'];
            $roomType2 = $row['room_type2'];
            $llc2 = $row['llc2'];
            $building3 = $row['building3'];
            $roomType3 = $row['room_type3'];
            $llc3 = $row['llc3'];
            $roommate1 = $row['roommate1'];
            $roommate2 = $row['roommate2'];
            $roommate3 = $row['roommate3'];
            $completed = $row['completed'];
            $deleted = $row['deleted'];
            //Now we can include the form
            include '../view/room_request.php'; //room change request form
        }
    }
}

function input_manager_form_load(){
    //Get the existing values from the db
    $buildings = get_buildings(); //This is an associative array of every row in the building table. It has every col associated which each
    $roomTypes = get_rooms_types(); //THis is an associtive array of each roow in the buildings_room_types table along with each rows building and
    //$llcs = get_llcs();
    //THese arrays are i for here I think.
    include '../view/input_manager.php';
}

/**
 * @return void
 *This functions handles the listing of requests in the table view. It handles both request types. Each different way the table can be sorted
 * is a different case in the function

 */
function list_requests(){
    $listType = filter_input(INPUT_GET, 'ListType'); //stupid warnings
    $tableMode = filter_input(INPUT_GET, 'TableMode');
    //The ListType comes from action=ListStudents&ListType=SampleListType
    $requestType = 0; //1 if room request, 2 if room change request tells which table to include
    //THis is how we will differentiate between listTypes, such as Clarion_Room_Request and Clarion_Room_Change_Request
    //FIrst are the conditions for general search
    if ($listType == 'GeneralSearch'){
        $criteria = $_GET['criteria'];
        $table = $_GET['table'];
        if ($table == "waitlist_request"){
            $requestType = 1; //1 is for a room request
        }
        else{
            $requestType = 2; //We only have 2 different requests types so else is okay, 2 is a room change request
        }
        $column = $_GET['column'];
        $results = get_requests_by_general_search($criteria, $table, $column); //Call the fctn in the model
    }
    elseif ($listType == 'GeneralSearchUncomplete'){ //Case for uncompleted requests when using the general search
        $criteria = $_GET['criteria'];
        $table = $_GET['table'];

        if ($table == "waitlist_request"){
            $requestType = 1; //1 is for a room request
        }
        else{
            $requestType = 2; //We only have 2 different requests types so else is okay, 2 is a room change request
        }
        $column = $_GET['column'];
        $results = get_requests_by_general_search_uncompleted($criteria, $table, $column); //Call the fctn in the model
    }
    elseif ($listType == 'GeneralSearchAlphabetical'){ //Case for general search sorted alphabetical
        $criteria = $_GET['criteria'];
        $table = $_GET['table'];
        if ($table == "waitlist_request"){
            $requestType = 1; //1 is for a room request
        }
        else{
            $requestType = 2; //We only have 2 different requests types so else is okay, 2 is a room change request
        }
        $column = $_GET['column'];
        $results = get_requests_by_general_search_alpha($criteria, $table, $column); //Call the fctn in the model
    }
    elseif ($listType == 'GeneralSearchAlphabeticalUncomplete'){ //Case for general search sorted alphabetical uncompleted requests
        $criteria = $_GET['criteria'];
        $table = $_GET['table'];
        if ($table == "waitlist_request"){
            $requestType = 1; //1 is for a room request
        }
        else{
            $requestType = 2; //We only have 2 different requests types so else is okay, 2 is a room change request
        }
        $column = $_GET['column'];
        $results = get_requests_by_general_search_alpha_uncompleted($criteria, $table, $column); //Call the fctn in the model
    }
    //The next cases are for room requests
    elseif ($listType == "RoomRequests"){
        $requestType = 1;
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "RoomRequestsUncomplete"){
        $requestType = 1;
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "Alphabetical"){
        $requestType = 1; //These are room requests
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "AlphabeticalUncomplete"){
        $requestType = 1; //These are room requests
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "Deleted")
    {
        $requestType = 1;
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_deleted_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "DeletedAlphabetical")
    {
        $requestType = 1;
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_deleted_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "DeletedUncomplete")
    {
        $requestType = 1;
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_deleted_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "DeletedUncompleteAlphabetical")
    {
        $requestType = 1;
        $table = "waitlist_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_deleted_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    //Now we do the same thing but for the room_change_requests
    elseif ($listType == "RoomChangeRequestsUncomplete"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "RoomChangeRequests"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "ChangeAlphabetical"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "ChangeAlphabeticalUncomplete"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "ChangeDeleted"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_deleted_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "ChangeDeletedAlphabetical"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_deleted_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "ChangeDeletedUncomplete"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_deleted_requests($table, $campus); //call the fctn in the model
    }
    elseif ($listType == "ChangeDeletedUncompleteAlphabetical"){
        $requestType = 2;
        $table = "room_change_request";
        $campus = $_GET['Campus'];
        $results = get_uncompleted_deleted_requests_alphabetical($table, $campus); //call the fctn in the model
    }
    /*if (count($results) == 0){ //incase the table is empty
        $errorMessage = "No Requests found.";
        include '../view/error_page.php';
    }*/
    //If one row is returned go straight to detailed view,, otherwise go to table
    if (count($results) == 1) {
        //We must also use requestType here to deocide which detailed view to use
        $row = $results[0];
        if ($requestType == 1)
        {
            include '../view/room_request_detailed_view.php'; // 1 means room request
        }
        if ($requestType == 2){
            include '../view/room_change_request_detailed_view.php'; //2 is a room chnage request
        }
    }
    else { //This is if many rows are returned
        if ($requestType == 1) {
            include '../view/room_request_table_view.php'; //1 means it was a room request search so we want this table.
        }
        if ($requestType == 2) {
            include '../view/room_change_request_table_view.php'; //2 means it was a room change request
        }
    }
}
function llc_input_manager_form_load(){
    $buildings = get_buildings_for_llc_manager(); //This is an associative array of every row in the building table that is associated with a LLC
    $roomTypes = get_rooms_types_for_llc_manager(); //This is an associtive array of the rows for each roomtype that has an LLC
    $llcs = get_llcs();
    //THese arrays are i for here I think.
    include '../view/llc_manager.php';
}
function process_add_building(){
    //This fctn handles the actual addition of a buidling to the database
    $buildingID = $_POST['BuildingID']; //Buildings ID
    $campus = $_POST['Campus']; //The campus
    $buildingName = $_POST['BuildingName']; //Name of new building
    $availableLLC = $_POST['AvailableLLC']; //Toggle for turning off all LLCs in a building
    if(isset($_POST['Available'])){
        $available = 'Y'; ///If box is checked the building is available.
    }
    else if(!(isset($_POST['Available']))){
        $available = 'N'; //Otherwise the building is not available
    }
    //We have the campus name but need the id, do this here because we are guarenteed to have a campus
    //Now error check
    $errors = "";
    if (empty($campus)){
        $errors .= "A campus must be selected. \n";
        $errorMessage = $errors;
        require '../view/error_page.php'; //Kick out early to prevent bug in getting buidling id
    }
    if (empty($buildingName) || strlen($buildingName) > 50){ //If this is blank it wont error as NULL != a buildings name
        $errors .= "Building name must be filled in and contain 50 or fewer characters. \n";
    }
    $campusArr = load_campuses(); //Assoc array of campuses
    foreach ($campusArr as $c) { //for each campus
        if ($c['name'] == $campus) {
            $campusID = $c['id']; //if the name matches what the user provided we get that id
        }
    }
    //We must also check that building name is unique at that campus
    $buildings = get_buildings(); //get all the buildings
    foreach ($buildings as $building){
        if($buildingName == $building['building_name']){
            if ($campusID == $building['campus_id']) {
                $errors .= "A building named " . $buildingName . " already exists at the " . $campus . " campus. \n";
            }
        }
    }
    if ($errors != ""){
        $errorMessage = $errors;
        include '../view/error_page.php'; //Display the error page with all the errors
    }
    else {
        //Now call the model fctn
        $buildingID = insert_building($campusID, $buildingName, $available, $availableLLC);
        header("Location: ../controller/controller.php?action=InputManager"); //Goes to input manager
    }
}
/**This function handles the adding and editing of room change requests. It takes the values from the form, checks them and if they are valid
 * pass them into insert_room_change_request() or update_room_change_request depending on the mode. In the final version it will redirect to the
 * detailed view of the request that was added or edited
 * @return void
 */
function process_add_edit_room_change_request(){
    //This fctn will handle the actual editing and adding of room chnage requests
    //We are setting a var for each field to the value that that sepcific field has
    //The text is brackets is the name of the input fields
    //Eventually these vars will be passed into the db
    $roomChangeRequestID = $_POST['RoomChangeRequestID'];
    $mode = $_POST['Mode'];
    $email = $_POST['Email'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $perferredName = $_POST['preferredNameInput'];
    $campus = $_POST['inputCampus'];
    $building1 = $_POST['inputBuilding01'];
    $roomType1 = $_POST['inputRoom01'];
    $llc1 = $_POST['inputLLC01'];
    $building2 = $_POST['inputBuilding02'];
    $roomType2 = $_POST['inputRoom02'];
    $llc2 = $_POST['inputLLC02'];
    $building3 = $_POST['inputBuilding03'];
    $roomType3 = $_POST['inputRoom03'];
    $llc3 = $_POST['inputLLC03'];
    $roommate1 = $_POST['roommateInput01'];
    $roommate2 = $_POST['roommateInput02'];
    $roommate3 = $_POST['roommateInput03'];
    $reason = $_POST['Reason']; //unique to room chnage requests
    $completed = $_POST['Completed'];
    $deleted = $_POST['Deleted'];

    //Now we need to error check
    $errors = ""; //will get added to it if there is errors
    //The firstName, lastName, and email are pulled from SSO so I don't think it is nessasry to check them, it can be added tho
    if(strlen($perferredName) > 25){
        $errors .= "Perferred name should be less than 25 characters ";
    }
    if (empty($campus)){
        $errors .= "A campus must be selected \n";
    }
    if (empty($building1) || strlen($building1) > 50){
        $errors .= "Building 1 must be filled in and contain 50 or fewer characters. \n";

    }
    if (empty($roomType1) || strlen($roomType1) > 50){
        $errors .= "Room Type1 must be filled in and contain 50 or fewer characters. \n";
    }
    //LLCs are allowd to be null (blank)
    //We are now only requiring the students first choice
    if (strlen($building2) > 50){
        $errors .= "Building 2 must contain 50 or fewer characters. \n";
    }
    if (strlen($roomType2) > 50){
        $errors .= "Room Type2 must contain 50 or fewer characters. \n";
    }
    if (strlen($building3) > 50){
        $errors .= "Building3 must cotain 50 or fewer characters. \n";
    }
    if (strlen($roomType3) > 50){
        $errors .= "Room Type3 must contain 50 or fewer characters. \n";
    }
    //Reason is still required
    if (empty($reason) || strlen($reason) > 200){
        $errors .= "Reason must contain 200 or fewer characters. \n";
    }
    //Check is dun
    if ($errors != ""){
        $errorMessage = $errors;
        include '../view/error_page.php'; //Display the error page with all the errors
    }

    else{
        if($mode == "Add"){ //if the student is adding new request

            $roomChangeRequestID = insert_room_change_request($email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $reason, $completed, $deleted);
        }
        else if($mode == "Edit"){
            $rowsAffected = update_room_change_request($roomChangeRequestID, $email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $reason, $completed, $deleted);
        }
        //header("Location: ../controller/controller.php?action=Home");
        header("Location: ../controller/controller.php?action=DisplayRoomChangeRequest&RoomChangeRequestID=$roomChangeRequestID");
        //Redirect to the detailed view after editing
    }

}
/**This function handles the adding and editing of room requests. It takes the values from the form, checks them and if they are valid
 * pass them into insert_room_request() or update_room_request depending on the mode. In the final version it will redirect to the
 * detailed view of the request that was added or edited
 * @return void
 */
function process_add_edit_room_request(){
    //This fctn will handle the actual editing and adding of room requests
    //We are setting a var for each field to the value that that sepcific field has
    //The text is brackets is the name of the input fields
    //Eventually these vars will be passed into the db
    $roomRequestID = $_POST['RoomRequestID'];
    $mode = $_POST['Mode'];
    $email = $_POST['Email'];
    $firstName = $_POST['FirstName'];
    $lastName = $_POST['LastName'];
    $perferredName = $_POST['preferredNameInput'];
    $campus = $_POST['inputCampus'];
    $building1 = $_POST['inputBuilding01'];
    $roomType1 = $_POST['inputRoom01'];
    $llc1 = $_POST['inputLLC01'];
    $building2 = $_POST['inputBuilding02'];
    $roomType2 = $_POST['inputRoom02'];
    $llc2 = $_POST['inputLLC02'];
    $building3 = $_POST['inputBuilding03'];
    $roomType3 = $_POST['inputRoom03'];
    $llc3 = $_POST['inputLLC03'];
    $roommate1 = $_POST['roommateInput01'];
    $roommate2 = $_POST['roommateInput02'];
    $roommate3 = $_POST['roommateInput03'];
    $completed = $_POST['Completed'];
    $deleted = $_POST['Deleted'];

    //Now we need to error check
    $errors = ""; //will get added to it if there is errors
    //The firstName, lastName, and email are pulled from SSO so I don't think it is nessasry to check them, it can be added tho
    if(strlen($perferredName) > 25){
        $errors .= "Perferred name should be less than 25 characters ";
    }
    if (empty($campus)){
        $errors .= "A campus must be selected \n";
    }
    if (empty($building1) || strlen($building1) > 50){
        $errors .= "Building 1 must be filled in and contain 50 or fewer characters. \n";

    }
    if (empty($roomType1) || strlen($roomType1) > 50){
        $errors .= "Room Type1 must be filled in and contain 50 or fewer characters. \n";
    }
    //LLCs are allowd to be null (blank)
    if (strlen($building2) > 50){
        $errors .= "Building 2 must contain 50 or fewer characters. \n";
    }
    if (strlen($roomType2) > 50){
        $errors .= "Room Type2 must contain 50 or fewer characters. \n";
    }
    if (strlen($building3) > 50){
        $errors .= "Building3 must cotain 50 or fewer characters. \n";
    }
    if (strlen($roomType3) > 50){
        $errors .= "Room Type3 must contain 50 or fewer characters. \n";
    }
    //I think it is a good idea to to reset completed to 'N' here, it should already be 'N', but this makes sure it is
    //Students cannot modify requests that are completed ('Y')


    //Check is dun
    if ($errors != ""){
        $errorMessage = $errors;
        include '../view/error_page.php'; //Display the error page with all the errors
    }

    else{
        if($mode == "Add"){ //if the student is adding new request

            $roomRequestID = insert_room_request($email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $completed, $deleted);
        }
        else if($mode == "Edit"){
            $rowsAffected = update_room_request($roomRequestID, $email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $completed, $deleted);
        }
        //header("Location: ../controller/controller.php?action=Home");
        header("Location: ../controller/controller.php?action=DisplayRoomRequest&RoomRequestID=$roomRequestID");
        //Redirect to the detailed view after editing
    }
}

/**This fctn handles the actual addition of a room type to the database
 * @return void
 */
function process_add_room_type(){

    $roomTypeID = $_POST['RoomTypeID'];
    $campus = $_POST['inputCampus'];// Only used in dependant drop downs, here
    $building = $_POST['inputBuilding01']; //building the room type is located in
    $buildingID; //id of the building the room type is in
    $roomTypeName = $_POST['RoomTypeName'];
    if(isset($_POST['Available'])){
        $available = 'Y'; ///If box is checked the building is available.
    }
    else if(!(isset($_POST['Available']))){
        $available = 'N'; //Otherwise the building is not available
    }
    //Now we have the buidlings name but not its id, and we need the id for the new row i buildings_room_types table
    //Now error check
    $errors = "";
    if (empty($campus)){
        $errors .= "A campus must be selected. \n";
    }
    if (empty($building)){
        $errors .= "A building must be selected. \n";
        $errorMessage = $errors;
        require '../view/error_page.php'; //Kick out early to prevent bug in getting buidling id
    }
    if (empty($roomTypeName) || strlen($roomTypeName) > 50){
        $errors .= "Room type name must be filled in and contain 50 or fewer characters. \n";
    }
    $buildings = get_buildings(); //get assoc array of all buildings
    foreach($buildings as $b){
        if($b['building_name'] == $building){
            $buildingID = $b['id']; //If b's name matches the user input building name then thats the ID we want
        }
    }
    //We also make sure that each roomtype has a uniquie name within its building
    $roomTypes = get_rooms_types(); //get all the buildings
    foreach ($roomTypes as $roomType){
        if($roomTypeName == $roomType['room_type'] && $buildingID == $roomType['building_id']) {
            $errors .= "A room type named " . $roomTypeName . " already exists in " . $building . ". \n";
        }
    }
    if ($errors != ""){
        $errorMessage = $errors;
        include '../view/error_page.php'; //Display the error page with all the errors
    }
    else {
        //Now we have everything we need, now we must make calls to model fctns to add the rows we need.
        $roomTypeID = insert_room_type($roomTypeName); //adds row to room_type
        $buildingsRoomTypesID = insert_buildings_room_types($buildingID, $roomTypeID, $available); //adds row to buidlings_room_types
        header("Location: ../controller/controller.php?action=InputManager"); //Goes to input manager
    }


}
function process_add_llc () {
    // This function handles adding the llc to the database
    $llcID = $_POST['LLCID'];
    $campus = $_POST['inputCampus'];// Only used in dependant drop downs, here
    $building = $_POST['inputBuilding01']; //building the llc is in
    $buildingID; //id of the building
    $roomTypeName = $_POST['inputRoom01']; //room type the llc is in
    $llcName = $_POST['LLCName'];
    if(isset($_POST['Available'])){
        $available = 'Y'; ///If box is checked the building is available.
    }
    else if(!(isset($_POST['Available']))){
        $available = 'N'; //Otherwise the building is not available
    }
    //Now error check
    $errors = "";
    if (empty($campus)){
        $errors .= "A campus must be selected. \n";
    }
    if (empty($building)){
        $errors .= "A building must be selected. \n";
        $errorMessage = $errors;
        require '../view/error_page.php'; //Kick out early to prevent bug in getting buidling id
    }
    if (empty($roomTypeName)){
        $errors .= "A room type must be selected. \n";
        $errorMessage = $errors;
        require '../view/error_page.php'; //Kick out early to prevent bug in getting roomtype id
    }
    if (empty($llcName) || strlen($llcName) > 50){
        $errors .= "LLC Name must be filled in and contain less than 50 characters. \n";

    }
    //Now we have the buildings name but not its id, and we need the id for the new row i buildings_room_types table
    $buildings = get_buildings(); //get assoc array of all buildings
    foreach ($buildings as $b) {
        if ($b['building_name'] == $building) {
            $buildingID = $b['id']; //If b's name matches the user input building name then thats the ID we want
        }
    }
    //Also have to get the room type id
    $roomTypes = get_rooms_types();
    foreach($roomTypes as $r){
        if($r['room_type'] == $roomTypeName){
            $roomTypeID = $r['room_type_id'];
        }
    }
    $llcs = get_llcs(); //get llcs, this fctn will return the buildingID and roomTtypeID associated with each LLC so we can just compare with that
    foreach ($llcs as $llc){
        if($llcName == $llc['llc_name'] && $roomTypeID == $llc['room_type_id']){ //Each roomtype has unique id so no need to chacke buildings
            $errors .= "A housing community named " . $llcName . " already exists for the " . $roomTypeName . " in " . $building . ".\n";
        }
    }
    //We must also force the llc name to be unique for the room type. 2 roomtypes in 1 building can have same llc
    //But 1 roomtype cant have dup LLCs

    if ($errors != ""){
        $errorMessage = $errors;
        include '../view/error_page.php'; //Display the error page with all the errors
    }
    else {
        //Now we have everything we need, now we must make 3 calls to model fctns to add the rows we need.
        $llcID = insert_llc($llcName);
        $buildingsLLCsID = insert_buildings_llcs($buildingID, $llcID); // Still adding to this table just in case we need it
        $roomTypesLLcsID = insert_rooms_llcs($roomTypeID, $llcID); // Still adding to this table just in case we need it
        $buildingsRoomTypesLLCsID = insert_buildings_room_types_llcs($buildingID, $roomTypeID, $llcID, $available);
        header("Location: ../controller/controller.php?action=LLCInputManager"); //Goes to input manager
    }
}

/** This is the function for processing the updating of the availability of buildings and room types. It loops thru each building, and
 * for each building it loops thru that buildings room types. THis fctn appropriately calls the model fctns to interact with the db
 * @return void
 */
function process_edit_form_inputs(){
    $buildings = get_buildings();//Associtive array each column in the building table
    $roomTypes = get_rooms_types();//Associtive array of each column in the buildings_room_types table
    $rCounter = 1; //counter like roomcCounter on input_manager.php
    $buildingToggle; //Used for limiting room types based off of their buildings availability

    foreach($buildings as $b){ //Essentially For each building
        //$bName = $buildings[$i-1]['building_name']; //name of the building, must be i-1 because of array indexs
        $bID = $b['id']; //We use ID to ensure we are ereading the cirrect checkbox as the checkboxes are named with ids
        $availableStatus; //var for the availible status of a building
        if (isset($_POST[$bID."Input"])){ //THis is where ids come in. I spent sevral hours trouble shooting this. I originally wanted
            //names but it wouldn't work with the concatenation in $_POST
            $availableStatus = 'Y'; //If check box is set the building needs to be available.
            $buildingToggle = TRUE;
        }
        else if (!isset($_POST[$bID."Input"])){
            $availableStatus = 'N';//Otherwise if the the box isn't chekeced then the building isn't available.
            $buildingToggle = FALSE;
        }
        change_building_availability($bID, $availableStatus); //Call fctn in the model to update the availabiilty of the $building
        //I think to work Ill need to set this up juest like the form so after we check each building let check its rooms, like how its displayed
        foreach($roomTypes as $r){
            //So for each building we will check all of that buildings check boxes
            if ($r['building_id'] == $bID){
                //if the roomTpes building id matches the current buildings ID then check that checkboxes status
                $rID = $r['room_type_id']; //The id of the room type
                $buildingRoomTypeID = $rID . $bID; //THis is the name of the check box
                if ($buildingToggle == TRUE && isset($_POST[$buildingRoomTypeID])){
                    $availableStatus = 'Y'; //If the building is available and the room type check box is checked then set the room type's
                    //available to Y
                }
                else if ($buildingToggle == FALSE || !isset($_POST[$buildingRoomTypeID])){
                    $availableStatus = 'N';//Elif the building isn't available or the room types box isn't checked then set the room types
                    //available to N
                }
                change_room_type_availability($bID, $rID, $availableStatus); //call model function to update the avilability
            }
        }
    }
    header("Location: ../controller/controller.php?action=InputManager"); //reload page with correct values
}
/** This is the function for processing the updating of the availability of buildings and room types. It loops thru each building, and
 * for each building it loops thru that buildings room types. THis fctn appropriately calls the model fctns to interact with the db
 * @return void
 */
function process_edit_form_llc_inputs(){
    $buildings = get_buildings_for_llc_manager();//Associative array each column in the building table
    $roomTypes = get_rooms_types_for_llc_manager();//Associative array of each column in the buildings_room_types table
    $llcs = get_llcs();
    $rCounter = 1; //counter like roomCounter on input_manager.php

    foreach($buildings as $b){ //Essentially For each building
        //$bName = $buildings[$i-1]['building_name']; //name of the building, must be i-1 because of array indices
        $bID = $b['id']; //We use ID to ensure we are reading the correct checkbox as the checkboxes are named with ids
        $availableLLCStatus = $b['available_llc'];
        if(isset($_POST[$bID."Input"])){
            $availableLLCStatus = 'Y'; //if the building box is checked then its LLCs can be available
            $buildingToggle = TRUE;
        }
        else if (!isset($_POST[$bID."Input"])){
            $availableLLCStatus = 'N'; //Otherwise they cannot be
            $buildingToggle = FALSE;
        }
        //Now we must update this buidlings avilable_llc row.
        change_building_availability_llc($bID, $availableLLCStatus); //Call model fctn
        //I think to work I'll need to set this up just like the form so after we check each building let check its rooms, like how its displayed
        foreach($roomTypes as $r){ //This loop goes thru all the roomtypes and checks for roomtypes in that building
            if ($r['building_id'] == $bID){ //if the roomTypes building id matches the current buildings ID then check that checkboxes status
                $rID = $r['room_type_id']; //The id of the room type
                foreach($llcs as $l) {
                    if ($l['room_type_id'] == $rID && $l['building_id'] == $bID){
                        $lID = $l['llc_id'];
                        $brtlID = $bID . $rID . $lID;
                        if ($buildingToggle == TRUE && isset($_POST[$brtlID])){
                            $availableStatus = 'Y';
                        } elseif($buildingToggle == FALSE || !isset($_POST[$brtlID])) {
                            $availableStatus = 'N';
                        }
                        change_llc_availability($bID, $rID, $lID, $availableStatus); //call model function to update the availability
                    }
                }
            }
        }
    }
    header("Location: ../controller/controller.php?action=LLCInputManager"); //reload page with correct values
}

/**This function is called when the user submits the form to upload a new notification email.
 * @return void
 */
function process_email_upload(){
    $uploadFile = '../datafiles/notification_email.txt'; //current email we send
    //Valid that there is a file, this input is also required on the form
    if($_FILES['user_email']['error'] == UPLOAD_ERR_NO_FILE){
        //if there is no file
        $errorMessage = "No file was selected. Upload aborted."; //error message
        include '../view/error_page.php'; //include error page
        exit();
    }
    if (file_exists($uploadFile)){ //This is for if the user tries to upload a file that has already been uploaded
        $message = "The email file was replaced successfully."; //file is new
    }
    else{
        $message = "The email file was uploaded successfully."; //file is already there
    }
    //We need to check the file type before we do the move
    if ($_FILES['user_email']['type'] == "text/plain"){ //We only want txt files

        if (move_uploaded_file($_FILES['user_email']['tmp_name'],$uploadFile)) { //Get the file out of the temp storage
            //We are always replacing the notification_email.tct file
            //When the user uploads an email it replaces the contents of the one in the project rather than adding that email file in addition
            include '../view/process_email_upload.php';
        }
        else if ($_FILES['user_email']['size'] > 20000000){ //special case for too big of file, 20MB
            $errorMessage = "The selected file was to large please try again with a file smaller than 20MB.";
            include '../view/errorpage.php';
        }
        else { //Generic Error
            $errorMessage = "File Upload Error\n Debugging info:" .  print_r($_FILES);
            include '../view/errorpage.php'; //Pobs shouldn't see this in general use
        }
    }
    else{
        $errorMessage = "Only text files are supported for quote file uploads."; //We only support txt files
        include '../view/errorpage.php';
    }

}

function process_user_guide_upload() {
    $uploadFile = '../datafiles/user_guide.docx'; // fixed destination

    if ($_FILES['user_guide']['error'] == UPLOAD_ERR_NO_FILE) {
        $errorMessage = "No file selected. Upload aborted.";
        include '../view/error_page.php';
        exit();
    }

    if (file_exists($uploadFile)) {
        $message = "The user guide was replaced successfully.";
    } else {
        $message = "The user guide was uploaded successfully.";
    }

    // MIME type is not always reliable, so extension check is safer for DOCX
    $fileExtension = strtolower(pathinfo($_FILES['user_guide']['name'], PATHINFO_EXTENSION));

    if ($fileExtension === 'docx') {
        if (move_uploaded_file($_FILES['user_guide']['tmp_name'], $uploadFile)) {
            include '../view/process_user_guide.php'; // success page
        } else if ($_FILES['user_guide']['size'] > 20000000) {
            $errorMessage = "The file was too large. Please upload a file smaller than 20MB.";
            include '../view/error_page.php';
        } else {
            $errorMessage = "File upload failed. Debug: " . print_r($_FILES, true);
            include '../view/error_page.php';
        }
    } else {
        $errorMessage = "Only .docx files are supported.";
        include '../view/error_page.php';
    }
}

/***This function is called if a user wants to delete a room change request
 * @return void
 */
function remove_room_change_request(){
    $roomChangeRequestID = $_GET['RoomChangeRequestID']; //Get id of the request with GET
    $deleteType = $_GET['DeleteType']; //Type of delete
    if (!(isset($roomChangeRequestID))){ //checks if there is an id
        $errorMessage = "You must provide a room change request ID"; //error message
        include '../view/error_page.php'; //include the error page
    }
    else{
        //Now check delete type
        if ($deleteType == "Pretend") {
            //Pretend is the case for the pretend delete
            //All we need to do is change the value of deleted from 'N' to 'Y'
            $rowsAffected = change_deleted_room_change_request($roomChangeRequestID, 'Y'); //call model fctn to do the pretend delete
            //The fctn sets deleted to passed in value
            if ($rowsAffected != 1){
                $errorMessage = "The delete effected multiple rows. " . $rowsAffected . " rows exactly."; //error message
                include '../view/error_page.php'; //include the error page
            }
            else {
                //No need to check student/admin here
                header("Location: ../controller/controller.php?action=DisplayRoomChangeRequest&RoomChangeRequestID=$roomChangeRequestID");
                //Should take admins back to the room change detailed view
            }
        }
        elseif ($deleteType == "Permanate") {
            //Permanate is the case for the real deal delete
            $rowsAffected = delete_room_change_request($roomChangeRequestID); //call the fctn in the model to delete the specifified request
            if ($rowsAffected != 1) {
                $errorMessage = "The delete effected multiple rows. " . $rowsAffected . " rows exactly."; //error message
                include '../view/error_page.php'; //include the error page
            } else {
                //Now depending on student or admin we want to redirect them to a differe page
                if (in_array('AG-ROLE-STUDENT', $_SESSION['Role'])) {
                    //We will check students first
                    header("Location: ../controller/controller.php?action=ViewMyRequest");
                    //Should redirect to the view my request page and say they dont have one
                } else if (in_array('AG-ROLE-STAFF', $_SESSION['Role'])) {
                    //Staff
                    header("Location: ../controller/controller.php?action=ManageRoomChangeRequests");
                    //Should take admins back to the room change request manager
                }
            }
        }
    }
}

/***This function is called if a user want to delete a room request
 * @return void
 */
function remove_room_request(){
    $roomRequestID = $_GET['RoomRequestID']; //Get id of the request with GET
    $deleteType = $_GET['DeleteType']; //Type of delete
    if (!(isset($roomRequestID))){ //checks if there is an id
        $errorMessage = "You must provide a room request ID"; //error message
        include '../view/error_page.php'; //include the error page
    }
    else{
        if ($deleteType == "Pretend") {
            //This is cthe case for a pretend delete
            //Pretend is the case for the pretend delete
            //All we need to do is change the value of deleted from 'N' to 'Y'
            $rowsAffected = change_deleted_room_request($roomRequestID, 'Y'); //call model fctn to do the pretend delete
            //The fctn sets deleted to passed in value
            if ($rowsAffected != 1){
                $errorMessage = "The delete effected multiple rows. " . $rowsAffected . " rows exactly."; //error message
                include '../view/error_page.php'; //include the error page
            }
            else {
                //No need to check student/admin here
                header("Location: ../controller/controller.php?action=DisplayRoomRequest&RoomRequestID=$roomRequestID");
                //Should take admins back to the room change detailed view
            }
        }
        elseif ($deleteType == "Permanate") {
            //This is the case for the permeante delete
            $rowsAffected = delete_room_request($roomRequestID); //call the fctn in the model to delete the specifified request
            if ($rowsAffected != 1) {
                $errorMessage = "The delete effected multiple rows. " . $rowsAffected . " rows exactly."; //error message
                include '../view/error_page.php'; //include the error page
            } else {
                //Now depending on student or admin we want to redirect them to a differe page
                if (in_array('AG-ROLE-STUDENT', $_SESSION['Role'])) {
                    //We will check students first
                    header("Location: ../controller/controller.php?action=ViewMyRequest");
                    //Should redirect to the view my request page and say they dont have one
                } else if (in_array('AG-ROLE-STAFF', $_SESSION['Role'])) {
                    //Staff
                    header("Location: ../controller/controller.php?action=ManageRoomRequests");
                    //Should take admins back to the room request manager
                }
            }
        }
    }
}

/**This function is called when a student wants to view their request, it checks both tables for an uncompleted request.
 * If no request is found then then an error message is displayed
 * @return void
 */
function view_my_request(){
    //We need to take the student to the appropriate detailed view page
    //We also only want to show a request that isn't completed because depending on how long admins keep a request in the db a student could have several old ones

    //First lets check if the student made a room chnage request
    $row = get_room_change_request_by_email($_SESSION['Email']); //Passes in the students email pulled from SSO
    //That function called above will return FALSE if there is no row with that email
    if ($row != FALSE){ //enter this block if there is a row in room_change_request with that email
        //We shouldn't need to call get_room_change_request() because we already have the row
        include '../view/room_change_request_detailed_view.php'; //This should take the student to the page for a detailed view of a room change request
    }
    else{ //We go here if that student doesn't have a room chnage request, so they either have a room request or no request
        $row = get_room_request_by_email($_SESSION['Email']); //$row will remain false if there is no room request for that student either
        if ($row != FALSE){
            include '../view/room_request_detailed_view.php'; //Take student to the room request detailed view page
        }
        else{ //At this point the student doesn't have a request that has yet to be filled so there is no request to view
            $errorMessage = "You do not have a room request or room change request that hasn't been fufilled or deleted by an administrator. If you would like to submit a request please do so.";
            include '../view/error_page.php'; //include the error page
        }
    }
}
/** This function is called when the admin clicks the send button on the detailed view of a request for confirmation emails to students
 *      - Need to differentiate between room change and room request (waitlist)
 * @return void
 */
function send_email(){
    // Get the email and name of the student the email is going to
    $email = $_GET['Email'];
    $firstName = $_GET['FirstName'];
    $lastName = $_GET['LastName'];
    $preferredName = $_GET['PreferredName'];
    $form = $_GET['Form'];
    $requestID = $_GET['ReqID'];

    set_timestamp($requestID, $form);

    // If the preferred name isn't set, use first name to make full name
    if (strlen($preferredName) < 1){
        $fullName = $firstName . " " . $lastName;
    }
    // If the preferred name is set, use preferred name to make full name
    else{
        $fullName = $preferredName . " " . $lastName;
    }
    // Room Change Request email contents
    if ($form == 'RoomChange'){
        //$subject = $fullName . " Room Change Request";
        $subject = "Action Required: Room Change Request for " . $fullName;
    }
    // Room Request email contents
    else {
        $subject = "Action Required: Room Request for " . $fullName;
    }
    // Include send_button.php to send the email
    //include '../phpmailer/send_button.php';
    echo "Sending...";
    echo "
    <script>
    document.location.href = '../phpmailer/send_button.php?form=" . $form . "&email=" . $email ."&subject=" . $subject . "&requestID=" . $requestID . "';
    </script>
    ";
    //header("Location: ../controller/controller.php?action=DisplayRoomChangeRequest&RoomChangeRequestID=" . $requestID);
    }

/**This function handles the undo button case. It calls the model fctn to undo the pretened delete and returns to the detailed view.
 * @return void
 */
function undo_delete_room_change_request(){
    $roomChangeRequestID = $_GET['RoomChangeRequestID']; //get the id
    //Just undo a pretend delete
    $rowsAffected = change_deleted_room_change_request($roomChangeRequestID, 'N'); //call model fctn to do the pretend delete
    //The fctn sets deleted to passed in value
    if ($rowsAffected != 1){
        $errorMessage = "The undo effected multiple rows. " . $rowsAffected . " rows exactly."; //error message
        include '../view/error_page.php'; //include the error page
    }
    else {
        //No need to check student/admin here
        header("Location: ../controller/controller.php?action=DisplayRoomChangeRequest&RoomChangeRequestID=$roomChangeRequestID");
        //Should take admins back to the room change detailed view
    }
}

/**This function handles the undo button case. It calls the model fctn to undo the pretened delete and returns to the detailed view.
 * @return void
 */
function undo_delete_room_request(){
    $roomRequestID = $_GET['RoomRequestID']; //get the id
    //Just undo a pretend delete
    $rowsAffected = change_deleted_room_request($roomRequestID, 'N'); //call model fctn to do the pretend delete
    //The fctn sets deleted to passed in value
    if ($rowsAffected != 1){
        $errorMessage = "The undo effected multiple rows. " . $rowsAffected . " rows exactly."; //error message
        include '../view/error_page.php'; //include the error page
    }
    else {
        //No need to check student/admin here
        header("Location: ../controller/controller.php?action=DisplayRoomRequest&RoomRequestID=$roomRequestID");
        //Should take admins back to the room change detailed view
    }
}
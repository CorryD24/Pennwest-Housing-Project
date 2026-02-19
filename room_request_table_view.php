<?php
$title = "Room Request Table";
//This page will have the table with all room requests
require_once '../view/header.php'; //THis requires the header
// First, check if user is logged ini
// If the user is not logged in, use the error page to tell them to log in.
if (!isset($_SESSION['FirstName'])) {
    $errorMessage = 'Please log in to view the room requests.';
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
//We will check if $results is set to prevent direct access to page
if (!isset($results)) {
    $errorMessage = "Error, results failed to load or page was nvaigated to incorrectly."; //Error Message
    include '../view/error_page.php';
    die();
}
?>
<!--Table with the room requests-->
<div class="container-lg">
    <div class="row">
        <div class="col-lg-12">
            <?php
            if (fnmatch("*Deleted*", $listType)) { //if Deleted is in $listType, show different title ?>
                <h1>Deleted Room Request Table</h1> <!--Title helps differentiate the tables-->
            <?php } else { ?>
                <h1>Room Request Table</h1> <!--Title helps differentiate the tables-->
            <?php } ?>
            <br>
            <!--THis is the button that toggles completed-->
            <?php if ($listType == "RoomRequests" || $listType == "RoomRequestsUncomplete" || $listType == "Alphabetical" || $listType == "AlphabeticalUncomplete" || $listType == "Deleted" || $listType == "DeletedAlphabetical" || $listType == "DeletedUncomplete" || $listType == "DeletedUncompleteAlphabetical") {
                //Only display these buttons if not general searching, they have separate buttons bc js is dumb ?>
                <input type="button" style="margin-bottom: 15px;" class="btn btn-outline-success " name="CompletedSort"
                    id="CompletedSort" <?php
                    if ($listType == "DeletedUncomplete" || $listType == "DeletedUncompleteAlphabetical" || $listType == "AlphabeticalUncomplete" || $listType == "RoomRequestsUncomplete") {
                        //If we are showing uncomleted requests show a button that links to completed requests
                        ?> value="Show Completed Requests" <?php } elseif ($listType == "Deleted" || $listType == "DeletedAlphabetical" || $listType == "Alphabetical" || $listType == "RoomRequests") {
                        //Otherise we want to display a button to show uncompleted requets
                        ?> value="Show Incompleted Requests" <?php } ?>
                    onclick="completed_sort_validation2()">
                <!--Call the function to handle the the swithcing based on completed status-->
                <input type="button" class="btn btn-outline-success sortBtnMargin" name="AlphaSort" id="AlphaSort" <?php
                if ($listType == "DeletedUncomplete" || $listType == "Deleted" || $listType == "RoomRequests" || $listType == "RoomRequestsUncomplete") {
                    //If we are in a list type that isn't alphabetically sorting the value is Sort Alphabetically
                    ?> value="Sort Alphabetically" <?php } elseif ($listType == "DeletedUncompleteAlphabetical" || $listType == "DeletedAlphabetical" || $listType == "Alphabetical" || $listType == "AlphabeticalUncomplete") {
                    //Otherise we want to display a button to sort normally
                    ?> value="Sort Positionally" <?php } ?> onclick="alpha_sort_validation2()">
                <!--Call the function to handle the osrting-->
                <!--Now we need a button for the table to display the second and third options-->
                <input type="button" class="btn btn-outline-success sortBtnMargin" name="Option2Sort" id="Option2Sort" <?php
                if ($tableMode == 1 || $tableMode == 3) { //1 means we are displaying by first choice, 3 is displaying by 3rd choice
                    ?> value="Display Second Choices" <?php } elseif ($tableMode == 2) { //If we are dislplaying second choices we want to switch back to 1st choices ?> value="Display First Choices" <?php } ?>
                    onclick="choice_2_sort_validation2()">
                <!--Call fctn to handle switch choice displays-->
                <!--The next button is for displaying the 3rd choices-->
                <input type="button" class="btn btn-outline-success sortBtnMargin" name="Option3Sort" id="Option3Sort" <?php
                if ($tableMode == 1 || $tableMode == 2) { //1 means we are displaying by first choice, 2 is displaying by 2nd choice
                    ?> value="Display Third Choices" <?php } elseif ($tableMode == 3) { //If we are dislplaying third choices we want to switch back to 1st choices ?> value="Display First Choices" <?php } ?>
                    onclick="choice_3_sort_validation2()">
                <!--Call fctn to handle switch choice displays-->
            <?php } //Close the buttons for sorting alaphabetically and display other choices for non generals search
            if ($listType == "GeneralSearch" || $listType == "GeneralSearchUncomplete" || $listType == "GeneralSearchAlphabetical" || $listType == "GeneralSearchAlphabeticalUncomplete") { //Now show the same buttons but for general search ?>
                <!--This is the button for toggling complete and uncomplete requests for general searching-->
                <input type="button" style="margin-bottom: 15px;" class="btn btn-outline-success "
                    name="CompletedSortGenSearch" id="CompletedSortGenSearch" <?php
                    if ($listType == "GeneralSearchUncomplete" || $listType == "GeneralSearchAlphabeticalUncomplete") {
                        //If we are showing uncomleted requests show a button that links to completed requests
                        ?> value="Show Completed Requests" <?php } elseif ($listType == "GeneralSearch" || $listType == "GeneralSearchAlphabetical") {
                        //Otherise we want to display a button to show uncompleted requets
                        ?> value="Show Incompleted Requests" <?php } ?>
                    onclick="completed_sort_validation_gen_search2()">
                <!--Call the function to handle the the swithcing based on completed status-->
                <!--THis is the button for sorting alphabetically with a general search-->
                <input type="button" class="btn btn-outline-success sortBtnMargin" name="AlphaSortChangeGen"
                    id="AlphaSortChangeGen" <?php
                    if ($listType == "GeneralSearch" || $listType == "GeneralSearchUncomplete") {
                        //If we are in a list type that isn't alphabetically sorting the value is Sort Alphabetically
                        ?> value="Sort Alphabetically" <?php } elseif ($listType == "GeneralSearchAlphabetical" || $listType == "GeneralSearchAlphabeticalUncomplete") {
                        //Otherise we want to display a button to sort normally
                        ?> value="Sort Positionally" <?php } ?> onclick="alpha_sort_validation_gen_search2()">
                <!--Call the function to handle the osrting-->
                <!--THis is the button for displaying second choices with a general search-->
                <input type="button" class="btn btn-outline-success sortBtnMargin" name="Option2SortGen" id="Option2SortGen" <?php
                if ($tableMode == 1 || $tableMode == 3) { //1 means we are displaying by first choice, 3 is displaying by 3rd choice
                    ?> value="Display Second Choices" <?php } elseif ($tableMode == 2) { //If we are dislplaying second choices we want to switch back to 1st choices ?> value="Display First Choices" <?php } ?>
                    onclick="choice_2_sort_validation_gen_search2()">
                <!--Call fctn to handle switch choice displays-->
                <!--THis is the button for displaying 3rd choices in the table-->
                <input type="button" class="btn btn-outline-success sortBtnMargin" name="Option3SortGen" id="Option3SortGen" <?php
                if ($tableMode == 1 || $tableMode == 2) { //1 means we are displaying by first choice, 2 is displaying by 2nd choice
                    ?> value="Display Third Choices" <?php } elseif ($tableMode == 3) { //If we are dislplaying third choices we want to switch back to 1st choices ?> value="Display First Choices" <?php } ?>
                    onclick="choice_3_sort_validation_gen_search2()">
                <!--Call fctn to handle switch choice displays-->
            <?php } ?>
            <!--Must use different functions for it to work-->
            <?php if (count($results) == 0) {//If no results show up then show this "error" message and the sorting buttons so they could try toggling bsed off completion status ?>
                <p>No results returned, if you expected rows to be returned, try toggling the button to filter based on
                    completion status.</p>
            <?php } else { //Otherwise show the table ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead class="font16">
                            <tr>
                                <th class="border border-secondary-subtle" scope="col">Pos.#</th>
                                <th class="border border-top border-secondary-subtle" scope="col">Name</th>
                                <th class="border border-top border-secondary-subtle" scope="col">Email</th>
                                <th class="border border-top border-secondary-subtle" scope="col">Campus</th>
                                <th class="border border-top border-secondary-subtle" scope="col">#<?php echo $tableMode; ?>
                                    Building</th>
                                <th class="border border-top border-secondary-subtle" scope="col">#<?php echo $tableMode; ?>
                                    Room Style</th>
                                <th class="border border-top border-secondary-subtle" scope="col">#<?php echo $tableMode; ?>
                                    Housing Community</th> <!--Added php for displaying  the different choices-->
                                <th class="border border-top border-secondary-subtle" scope="col">Email Time Stamp</th>
                                <th class="border border-top border-secondary-subtle" scope="col">Completed</th>
                            </tr>
                        </thead>
                        <tbody class="font14">
                            <!--Below sill be the ofr loop for the php to dsiplay the room change requests-->
                            <?php foreach ($results as $row) { ?>
                                <tr>
                                    <th scope="row" class="border border-secondary-subtle">
                                        <?php echo htmlspecialchars($row['id']); ?>
                                    </th>
                                    <!-- Above echos the id of the request-->
                                    <td class="border border-secondary-subtle">
                                        <a
                                            href="../controller/controller.php?action=DisplayRoomRequest&RoomRequestID=<?php echo htmlspecialchars($row['id']); ?>"><?php echo htmlspecialchars($row['last_name'] . ", " . $row['first_name']) ?></a>
                                        <!-- Above is the students name, it serves as a link to the detailed view-->
                                    </td>
                                    <td class="border border-secondary-subtle"><?php echo htmlspecialchars($row['email']); ?>
                                    </td>
                                    <!--Above echos the email-->
                                    <td class="border border-secondary-subtle"><?php echo htmlspecialchars($row['campus']); ?>
                                    </td>
                                    <!--Above echos the campus-->
                                    <td class="border border-secondary-subtle">
                                        <?php echo htmlspecialchars($row['building' . $tableMode]); ?>
                                    </td>
                                    <!--Above echos the building choice, we are concatenating the tableMode to title of the associative array which matches the name of the columns like building2-->
                                    <td class="border border-secondary-subtle">
                                        <?php echo htmlspecialchars($row['room_type' . $tableMode]); ?>
                                    </td>
                                    <!--ABove echos room type choice-->
                                    <td class="border border-secondary-subtle">
                                        <?php echo htmlspecialchars($row['llc' . $tableMode]); ?>
                                    </td>
                                    <!--Added Php to display the correct choice, making tableMode a number was handy-->
                                    <!--And the llc choice-->
                                    <td class="border border-secondary-subtle">
                                        <?php echo htmlspecialchars($row['email_datetime']); ?>
                                    </td> <!--Date time for the email-->
                                    <!--Date time for the email-->
                                    <td class="border border-secondary-subtle">
                                        <?php
                                        if ($row['completed'] == 'Y') {
                                            echo "Yes";
                                        } else if ($row['completed'] == 'N') {
                                            echo "No";
                                        }
                                        ?>
                                    </td><!--Added in completed-->
                                </tr>
                            <?php } //End of the looop for displaying the room change requests ?>
                        </tbody>
                    </table>
                </div>
            <?php } //closes the if sttemtn for 0 results ?>
        </div>
    </div>
</div>
<!--Java scprit for sorting requests, these have to be on this file, bc we are pulling in the php varible to check agaisnt-->
<script>
    /**
     * This function hndles the toggling of completed or uncompleted requets
     */
    function completed_sort_validation2() {
        var listType = <?php echo json_encode($listType); ?>; //get the listType
        //If we are currently showing uncompleted requests which is the default, then show completed requests
        if (listType == "RoomRequestsUncomplete") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=RoomRequests&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        } else if (listType == "AlphabeticalUncomplete") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=Alphabetical&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        } else if (listType == "DeletedUncomplete") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=Deleted&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        } else if (listType == "DeletedUncompleteAlphabetical") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=DeletedAlphabetical&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }

        //Now to go from complete to uncomplete
        else if (listType == "RoomRequests") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=RoomRequestsUncomplete&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        } else if (listType == "Alphabetical") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=AlphabeticalUncomplete&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        } else if (listType == "Deleted") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=DeletedUncomplete&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        } else if (listType == "DeletedAlphabetical") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=DeletedUncompleteAlphabetical&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
    }
    /**
     * THis function switches the
     */
    function alpha_sort_validation2() {
        var listType = <?php echo json_encode($listType); ?>; //get the listType
        //We will check the list type, essentially if we arent alphbetically sorted and then we press the button the we will be
        //If we are currently alphabetically sorted then if we click button it goes back to normal
        if (listType == "RoomRequests") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=Alphabetical&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
        else if (listType == "RoomRequestsUncomplete") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=AlphabeticalUncomplete&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
        else if (listType == "Deleted") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=DeletedAlphabetical&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
        else if (listType == "DeletedUncomplete") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=DeletedUncompleteAlphabetical&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
        //Now we do the ones for going back to normal
        else if (listType == "Alphabetical") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=RoomRequests&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
        else if (listType == "AlphabeticalUncomplete") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=RoomRequestsUncomplete&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
        else if (listType == "DeletedAlphabetical") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=Deleted&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
        else if (listType == "DeletedUncompleteAlphabetical") {
            document.location = '../controller/controller.php?action=ListStudents&ListType=DeletedUncomplete&TableMode=<?php echo $tableMode; ?>&Campus=<?php echo $campus; ?>';
        }
    }

    /**
     * This function is used to change between showing students first and second choices.
     */
    function choice_2_sort_validation2() {
        var tableMode = <?php echo json_encode($tableMode); ?>; //get the tableMode
        if (tableMode == 1 || tableMode == 3) {
            //if the tableMode == 1 or tableMode == 3 then we want to switch to 2nd choices being displayed
            document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=2&Campus=<?php echo $campus; ?>';
        }
        else if (tableMode == 2) {
            document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=1&Campus=<?php echo $campus; ?>';
            //If we are displaying 2nd choice go back to first choices
        }
    }
    /**
     * This function is used to change between showing students first and third choices.
     */
    function choice_3_sort_validation2() {
        var tableMode = <?php echo json_encode($tableMode); ?>; //get the tableMode
        if (tableMode == 1 || tableMode == 2) {
            //if the tableMode == 1 or tableMode == 2 then we want to switch to 3rd choices being displayed
            document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=3&Campus=<?php echo $campus; ?>';
        }
        else if (tableMode == 3) {
            document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=1&Campus=<?php echo $campus; ?>';
            //If we are displaying 3rd choice go back to first choices
        }
    }
</script>
<!--This is the only way I could get it to work. I think js doesn't like the addition vars needed for general search so if this
fctn only exists if criteria isset it doesn't cause issues if your not general searching, but it will work when genral searching
bc criteria must be set-->
<?php if ($listType == "GeneralSearch" || $listType == "GeneralSearchUncomplete" || $listType == "GeneralSearchAlphabetical" || $listType == "GeneralSearchAlphabeticalUncomplete") { ?>
    <script>
        //Each fctn here is eaxactly the same as above, but for the general search feature
        function completed_sort_validation_gen_search2() {
            var listType = <?php echo json_encode($listType); ?>; //get the listType
            if (listType == "GeneralSearchUncomplete") { //Go to alpahbetical sorting
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearch&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (listType == "GeneralSearch") { //Go to alpahbetical sorting
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (listType == "GeneralSearchAlphabeticalUncomplete") { //Go to alpahbetical sorting
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearchAlphabetical&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (listType == "GeneralSearchAlphabetical") { //Go to alpahbetical sorting
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearchAlphabeticalUncomplete&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
        }
        function alpha_sort_validation_gen_search2() {
            var listType = <?php echo json_encode($listType); ?>; //get the listType
            if (listType == "GeneralSearch") { //Go to alpahbetical sorting
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearchAlphabetical&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (listType == "GeneralSearchUncomplete") { //Go from uncompleted to alpha sorted uncompleted
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearchAlphabeticalUncomplete&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (listType == "GeneralSearchAlphabetical") { //Go back to normal sorting
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearch&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (listType == "GeneralSearchAlphabeticalUncomplete") { //Go back to normal sorting for uncomplete requests
                document.location = '../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=<?php echo $tableMode; ?>&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
        }
        function choice_2_sort_validation_gen_search2() {
            var tableMode = <?php echo json_encode($tableMode); ?>; //get the tableMode
            if (tableMode == 1 || tableMode == 3) {
                //if the tableMode == 1 or tableMode == 3 then we want to switch to 2nd choices being displayed
                document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=2&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (tableMode == 2) {
                document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=1&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
                //If we are displaying 2nd choice go back to first choices
            }
        }
        function choice_3_sort_validation_gen_search2() {
            var tableMode = <?php echo json_encode($tableMode); ?>; //get the tableMode
            if (tableMode == 1 || tableMode == 2) {
                //if the tableMode == 1 or tableMode == 3 then we want to switch to 3rd choices being displayed
                document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=3&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
            }
            else if (tableMode == 3) {
                document.location = '../controller/controller.php?action=ListStudents&ListType=<?php echo $listType; ?>&TableMode=1&table=<?php echo $table; ?>&column=<?php echo $column; ?>&criteria=<?php echo $criteria; ?>';
                //If we are displaying 3rd choice go back to first choices
            }
        }
    </script>
<?php } //Close php if for sorting general search functions
require_once '../view/footer.php'; //THis requires the footer
?>
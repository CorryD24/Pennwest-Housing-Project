<?php
    //This is the model it will have alot of functions, most all of which will get called by the controller
/**
 * @return PDO The database object of the class PDO
 * This is the function that starts the connection to our database
 * It will be called in the other functions below that involve SQL queries
 */
    function get_db_connection(){
        $host = 'localhost';
        $dbname = 's_npkaltenba_housing_waitlist';

        $dsn = "mysql:host=$host;dbname=$dbname";

        $username = 'root';
        $password = '';


        //IF NO QUERIES WORK THEN CHECK HERE FIRST, IF THE ABOVE INFO ISNT CORRECT THEN WE CANT CONNECT TO THE DB
        try {
            $db = new PDO($dsn, $username, $password); //Create obj db of class PDO
        }
        catch (PDOException $e) {
            $errorMessage = $e->getMessage(); //get error message, this is security risk(Comment from 370)
            include '../view/error_page.php';
            die;}
        return $db; //return the db obj of class PDOs
    }
/** This function is used to changea buildings availability.
 * @param $buildingName
 * @param $status
 * @return int|void
 */
  function change_building_availability($buildingID, $status){
      $db = get_db_connection(); //get connection to db
      $query = "UPDATE building SET available = :Available WHERE id = :BuildingID"; //change to the new availiable value
      $statement = $db->prepare($query);
      $statement->bindValue('Available', $status);
      $statement->bindValue('BuildingID', $buildingID);
      $success = $statement->execute(); //success is true if the query ran properly
      $statement->closeCursor();
      if ($success){
          return $statement->rowCount(); //Returns the number of rows effected to the controller,, should match the number of buidlings
      }
      else{ //Include the error page
          $errorMessage = $statement->errorInfo();
          include '../view/error_page.php';
      }
  }

/**
 * @param $buildingID
 * @param $status
 * @return int|void This fctn is used to change the value of a buildings available_llc column.
 */
function change_building_availability_llc($buildingID, $status){
    $db = get_db_connection(); //get connection to db
    $query = "UPDATE building SET available_llc = :AvailableLLC WHERE id = :BuildingID"; //change to the new availiableLLC value
    $statement = $db->prepare($query);
    $statement->bindValue('AvailableLLC', $status);
    $statement->bindValue('BuildingID', $buildingID);
    $success = $statement->execute(); //success is true if the query ran properly
    $statement->closeCursor();
    if ($success){
        return $statement->rowCount(); //Returns the number of rows effected to the controller,, should match the number of buidlings
    }
    else{ //Include the error page
        $errorMessage = $statement->errorInfo();
        include '../view/error_page.php';
    }
}

/**THis function changes the value of  a row's deleted column to the passed in value. Returns the number rows effected.
 * @param $roomChangeRequestID
 * @param $deleted
 * @return int|void
 */
function change_deleted_room_request($roomRequestID, $deleted){
    try {
        $db = get_db_connection(); //get db connection
        $query = "UPDATE waitlist_request SET deleted = :Deleted WHERE id = :RoomRequestID";
        $statement = $db->prepare($query);
        $statement->bindValue(':RoomRequestID', $roomRequestID);
        $statement->bindValue(':Deleted', $deleted);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success) {
            return $statement->rowCount(); //return count of affected rows
        } else {
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //Error message and inlcude error page
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}

/**THis function changes the value of  a row's deleted column to the passed in value. Returns the number rows effected.
 * @param $roomChangeRequestID
 * @param $deleted
 * @return int|void
 */
function change_deleted_room_change_request($roomChangeRequestID, $deleted){
    try {
        $db = get_db_connection(); //get db connection
        $query = "UPDATE room_change_request SET deleted = :Deleted WHERE id = :RoomChangeRequestID";
        $statement = $db->prepare($query);
        $statement->bindValue(':RoomChangeRequestID', $roomChangeRequestID);
        $statement->bindValue(':Deleted', $deleted);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success) {
            return $statement->rowCount(); //return count of affected rows
        } else {
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //Error message and inlcude error page
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}

/** THis function is used to change the availability of a room type
 * @param $buildingID
 * @param $roomTypeID
 * @param $status
 * @return int|void
 */
  function change_room_type_availability($buildingID, $roomTypeID, $status){
      $db = get_db_connection(); //get connection to db
      $query = "UPDATE buildings_room_types SET available = :Available WHERE (building_id = :BuildingID AND room_type_id = :RoomTypeID)";
      //Using these 2 ids should guarentee we modify the right row
      $statement = $db->prepare($query);
      $statement->bindValue('Available', $status);
      $statement->bindValue('BuildingID', $buildingID);
      $statement->bindValue('RoomTypeID', $roomTypeID);
      $success = $statement->execute(); //TRUE if query ran right
      $statement->closeCursor();
      if ($success){
          return $statement->rowCount(); //Returns the number of rows effected to the controller,, should match the number of buidlings
      }
      else{ //Include the error page
          $errorMessage = $statement->errorInfo();
          include '../view/error_page.php';
      }
  }

/** THis function is used to change the availability of a llc
 * @param $buildingID
 * @param $roomTypeID
 * @param $status
 * @return int|void
 */
function change_llc_availability($buildingID, $roomTypeID, $llcID, $status){
    $db = get_db_connection(); //get connection to db
    $query = "UPDATE buildings_room_types_llcs SET available = :Available WHERE (building_id = :BuildingID AND room_type_id = :RoomTypeID AND llc_id = :LLCID)";
    //Using these 2 ids should guarentee we modify the right row
    $statement = $db->prepare($query);
    $statement->bindValue('Available', $status);
    $statement->bindValue('BuildingID', $buildingID);
    $statement->bindValue('RoomTypeID', $roomTypeID);
    $statement->bindValue('LLCID', $llcID);
    $success = $statement->execute(); //TRUE if query ran right
    $statement->closeCursor();
    if ($success){
        return $statement->rowCount(); //Returns the number of rows effected to the controller,, should match the number of buidlings
    }
    else{ //Include the error page
        $errorMessage = $statement->errorInfo();
        include '../view/error_page.php';
    }
}


/**This function returns all rows in the buildings table as an associative array.
 * @return array|false|void
 */
    function get_buildings(){
        try {
            $db = get_db_connection(); //Get cnnection to the db
            $query = "SELECT * FROM building ORDER BY campus_id, building_name"; //order by guarntees same order every time
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchall();
            $statement->closeCursor();
            return $results; //Return the array of results
        }catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/error_page.php'; //Get error message and include the error page
            die;
        }
    }
/**This function returns all rows from buildings that's id is in buildings_room_types_llcs. THis prevents the site from having to load
 * in buildings with no llcs on the llc manager page.
 * @return array|false|void
 */
function get_buildings_for_llc_manager(){
    try {
        $db = get_db_connection(); //Get cnnection to the db
        $query = "SELECT DISTINCT id, campus_id, building_name, available_llc FROM building inner join buildings_room_types_llcs brtl on building.id = brtl.building_id ORDER BY campus_id, building.building_name;"; //order by guarntees same order every time
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        return $results; //Return the array of results
    }catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Get error message and include the error page
        die;
    }
}

function get_requests($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "select * from $table Where campus = :Campus AND completed = 'Y' AND deleted = 'N' Order by id"; //Get all the 'deleted' rows from the table
        $statement = $db->prepare($query);
        //$statement->bindValue(':Table', $table);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}
function get_uncompleted_requests($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "select * from $table Where campus = :Campus AND completed = 'N' AND deleted = 'N' Order by id";
        $statement = $db->prepare($query);
        //$statement->bindValue(':Table', $table);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}

function get_requests_alphabetical($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "SELECT * FROM $table WHERE campus = :Campus AND completed = 'Y' AND deleted = 'N' ORDER BY last_name";
        $statement = $db->prepare($query);
        //$statement->bindValue(':Table', $table);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}
function get_uncompleted_requests_alphabetical($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "SELECT * FROM $table WHERE campus = :Campus AND completed = 'N' AND deleted = 'N' ORDER BY last_name";
        $statement = $db->prepare($query);
        //$statement->bindValue(':Table', $table);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}
function get_uncompleted_deleted_requests($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "SELECT * FROM $table WHERE campus = :Campus AND deleted = 'Y' AND completed = 'N' ORDER BY id"; //Get all the uncompleted'deleted' rows from the table
        $statement = $db->prepare($query);
        //$statement->bindValue(':Table', $table);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}

function get_deleted_requests($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "SELECT * FROM $table WHERE campus = :Campus AND completed = 'Y' AND deleted = 'Y' ORDER BY id"; //Get all the 'deleted' rows from the table
        $statement = $db->prepare($query);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}

function get_deleted_requests_alphabetical($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "SELECT * FROM $table WHERE campus = :Campus AND completed = 'Y' AND deleted = 'Y' ORDER BY last_name"; //Get all the 'deleted' rows from the table, alpha sorted
        $statement = $db->prepare($query);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}

function get_uncompleted_deleted_requests_alphabetical($table, $campus){
    try{
        $db = get_db_connection(); //get the db
        $query = "SELECT * FROM $table WHERE campus = :Campus AND completed = 'N' AND deleted = 'Y' ORDER BY last_name"; //Get all the 'deleted' rows from the table, alpha sorted
        $statement = $db->prepare($query);
        //$statement->bindValue(':Table', $table);
        $statement->bindValue(':Campus', $campus);
        $success = $statement->execute();
        $results = $statement->fetchall();
        $statement->closeCursor();
        if ($success){
            return $results; //assoc array of all the deleted requests at that campus
        }else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error page and error message
        }
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Error message and error page
    }
}

/**This funcion returns all rows fro buuilding room types as an associtive array, each array index also contains the corresponding building
 * and roomtype name for the row in buidlings_room_types
 * @return array|false|void
 */
    function get_rooms_types(){
        try {
            $db = get_db_connection(); //get db connection
            $query = "SELECT building_id,room_type_id, buildings_room_types.available, b.building_name, 
                            r.type AS room_type 
                        FROM buildings_room_types 
                        INNER JOIN building b ON building_id = b.id 
                        INNER JOIN room_type r on room_type_id = r.id
                        Order BY campus_id, room_type";
            //This query returns the 3 colums for each row in buildings-room_types, and the building and type of room associated with each row.
            //Order by the ids so the order is the same every time.
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchall(); //return the array of results
            $statement->closeCursor();
            return $results;
        }catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/error_page.php'; //Get error message and include the error page
            die;
        }
    }
/**This funcion returns all rows from buildings room types that are associated with an llc. This is used to lod in room types for llc manager.
 * and roomtype name for the row in buidlings_room_types
 * @return array|false|void
 */
function get_rooms_types_for_llc_manager(){
    try {
        $db = get_db_connection(); //get db connection
        $query = "SELECT DISTINCT buildings_room_types.building_id,buildings_room_types.room_type_id, b.building_name, 
                            r.type AS room_type 
                        FROM buildings_room_types 
                        INNER JOIN building b ON building_id = b.id 
                        INNER JOIN room_type r on room_type_id = r.id
                        INNER JOIN buildings_room_types_llcs brtl on r.id = brtl.room_type_id
                        Order BY campus_id, room_type;";
        //This query returns the 3 colums for each row in buildings-room_types, and the building and type of room associated with each row.
        //Order by the ids so the order is the same every time.
        $statement = $db->prepare($query);
        $statement->execute();
        $results = $statement->fetchall(); //return the array of results
        $statement->closeCursor();
        return $results;
    }catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php'; //Get error message and include the error page
        die;
    }
}
/**This funcion returns all rows fro buuilding room types llcs as an associtive array, each array index also contains the corresponding building
 * and roomtype name and llc name for the coresponding building, rom type and llc
 * @return array|false|void
 */
    function get_llcs(){
        try {
            $db = get_db_connection(); //get db connection
//          Original query using both binary relationship associative tables
//            $query = "SELECT
//                        llc.id AS llc_id,
//                        llc.name AS llc_name,
//                        building.id AS building_id,
//                        room_type.id AS room_type_id
//                    FROM llc
//                    INNER JOIN rooms_llcs ON llc.id = rooms_llcs.llc_id
//                    INNER JOIN room_type ON rooms_llcs.room_type_id = room_type.id
//                    INNER JOIN buildings_room_types ON room_type.id = buildings_room_types.room_type_id
//                    INNER JOIN building ON buildings_room_types.building_id = building.id
//                    INNER JOIN buildings_llcs ON llc.id = buildings_llcs.llc_id
//                        AND buildings_llcs.building_id = building.id
//                    GROUP BY llc.id, llc.name, building.id, room_type.id";
//          New query using the new ternary relationship associative table buildings_room_types_llcs, which allows us to check for availability
            $query = "SELECT llc.id AS llc_id, llc.name AS llc_name, building.id AS building_id, room_type.id AS room_type_id, brtl.available AS available
                        FROM llc
                        INNER JOIN buildings_room_types_llcs brtl ON llc.id = brtl.llc_id
                        --    AND brtl.available = TRUE
                        INNER JOIN building ON brtl.building_id = building.id
                        INNER JOIN room_type ON brtl.room_type_id = room_type.id
                        ORDER BY llc_name";
            //This query returns the 3 columns for each row in llcs, and the building and type of room associated with each row.
            //Order by the ids so the order is the same every time.
            $statement = $db->prepare($query);
            $statement->execute();
            $results = $statement->fetchall(); //return the array of results
            $statement->closeCursor();
            return $results;
        }catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/error_page.php'; //Get error message and include the error page
            die;
        }
    }

/**
 * @param $criteria This is what the user typed into search
 * @param $table This is the table that is searched, either room_request or roo_change_request depedning on what search button is clicked
 * @param $column This is the column we are searching against either, first_name, last_name, or email
 * @return void*
 */
    function get_requests_by_general_search($criteria, $table, $column){
        try{
            $db = get_db_connection(); //Get our connection to the database
            $query = "Select * From $table Where $column Like :criteria AND completed = 'Y' Order by id"; //only returns the uncompleted requests
            //Show nocompleted requests first then all completed ones after, each set will be sorted by id so the oldest requests are first
            //We are selcting * from the specified table with the specified column for the specified criteria
            $statement = $db->prepare($query);
            //$statement->bindvalue(':table', $table); //We don't need to bind these they aren't user input
            //$statement->bindvalue(':column', $column);
            $statement->bindvalue(':criteria', "%$criteria%"); //i think the %'s are like wildcards
            //Thye allow for us to search n and all requests with an n in firstname, last name, or email are reuturned depending on the search
            $statement->execute(); //exe our SQL statement
            $results = $statement->fetchAll(); //$results is an Assoc Array of the rows in the table
            $statement->closeCursor();
            return $results; // Array of Rows
        } catch (PDOException $e) {
            $errorMessage = $e->getMessage(); //Gets the error message
            include '../view/error_page.php'; //Takes user too error page if query doesn't work.
            die;
        }
    }

/**
 * @param $criteria
 * @param $table
 * @param $column
 * @return array|false|void This fucntion is the general search but only for uncompleted requests
 */
function get_requests_by_general_search_uncompleted($criteria, $table, $column){
    try{
        $db = get_db_connection(); //Get our connection to the database
        $query = "Select * From $table Where $column Like :criteria AND completed = 'N' Order by id"; //only returns the uncompleted requests
        //Show nocompleted requests first then all completed ones after, each set will be sorted by id so the oldest requests are first
        //We are selcting * from the specified table with the specified column for the specified criteria
        $statement = $db->prepare($query);
        //$statement->bindvalue(':table', $table); //We don't need to bind these they aren't user input
        //$statement->bindvalue(':column', $column);
        $statement->bindvalue(':criteria', "%$criteria%"); //i think the %'s are like wildcards
        //Thye allow for us to search n and all requests with an n in firstname, last name, or email are reuturned depending on the search
        $statement->execute(); //exe our SQL statement
        $results = $statement->fetchAll(); //$results is an Assoc Array of the rows in the table
        $statement->closeCursor();
        return $results; // Array of Rows
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage(); //Gets the error message
        include '../view/error_page.php'; //Takes user too error page if query doesn't work.
        die;
    }
}

/** Esentially the same as the other general search function, but it orders alphabetically by last name
 * @param $criteria
 * @param $table
 * @param $column
 * @return array|false|void
 */
function get_requests_by_general_search_alpha($criteria, $table, $column){
    try{
        $db = get_db_connection(); //Get our connection to the database
        $query = "Select * From $table Where $column Like :criteria AND completed = 'Y' Order by last_name";
        //Show requests order by last name
        //We are selcting * from the specified table with the specified column for the specified criteria
        $statement = $db->prepare($query);
        //$statement->bindvalue(':table', $table); //We don't need to bind these they aren't user input
        //$statement->bindvalue(':column', $column);
        $statement->bindvalue(':criteria', "%$criteria%"); //i think the %'s are like wildcards
        //Thye allow for us to search n and all requests with an n in firstname, last name, or email are reuturned depending on the search
        $statement->execute(); //exe our SQL statement
        $results = $statement->fetchAll(); //$results is an Assoc Array of the rows in the table
        $statement->closeCursor();
        return $results; // Array of Rows
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage(); //Gets the error message
        include '../view/error_page.php'; //Takes user too error page if query doesn't work.
        die;
    }
}

/**
 * @param $criteria
 * @param $table
 * @param $column
 * @return array|false|void THis function is the same as the other general search alpha but it is only uncomplete requests
 */
function get_requests_by_general_search_alpha_uncompleted($criteria, $table, $column){
    try{
        $db = get_db_connection(); //Get our connection to the database
        $query = "Select * From $table Where $column Like :criteria AND completed = 'N' Order by last_name";
        //Show requests order by last name
        //We are selcting * from the specified table with the specified column for the specified criteria
        $statement = $db->prepare($query);
        //$statement->bindvalue(':table', $table); //We don't need to bind these they aren't user input
        //$statement->bindvalue(':column', $column);
        $statement->bindvalue(':criteria', "%$criteria%"); //i think the %'s are like wildcards
        //Thye allow for us to search n and all requests with an n in firstname, last name, or email are reuturned depending on the search
        $statement->execute(); //exe our SQL statement
        $results = $statement->fetchAll(); //$results is an Assoc Array of the rows in the table
        $statement->closeCursor();
        return $results; // Array of Rows
    } catch (PDOException $e) {
        $errorMessage = $e->getMessage(); //Gets the error message
        include '../view/error_page.php'; //Takes user too error page if query doesn't work.
        die;
    }
}
    //Now we need the functions for displaying the detailed view of a request
    /*** This function is used when the user the clicks on a room request in the table view and wants to see the detailed view. And when editing a request
     * @param $requestID
     * @return array|false|void Returns 1 or rows from waitlist_request
     */
    function get_room_request($requestID){
        try {
            $db = get_db_connection(); //gets or connection to databse
            $query = "Select * From waitlist_request Where id = :requestID"; //hard coded as waitlist_request rn
            $statement = $db->prepare($query);
            $statement->bindValue(':requestID', $requestID);
            $statement->execute(); //exe statment
            $result = $statement->fetch(); //IT should be 0 rows or 1 row
            $statement->closeCursor();
            return $result; //Only one result
        }
        catch (PDOException $e) {
            $errorMessage = $e->getMessage(); //We want to display the error
            include '../view/error_page.php';
            die;
        }
    }

    /*** This function is used when the user the clicks on a room change request in the table view and wants to see the detailed view
     * @param $requestID
     * @return array|false|void Returns 1 or rows from waitlist_request
     */
    //Now the same thing for room_change request
    function get_room_change_request($requestID){
        try {
            $db = get_db_connection(); //gets or connection to databse
            $query = "Select * From room_change_request Where id = :requestID"; //hard coded as waitlist_request rn
            $statement = $db->prepare($query);
            $statement->bindValue(':requestID', $requestID);
            $statement->execute(); //exe statment
            $result = $statement->fetch(); //IT should be 0 rows or 1 row
            $statement->closeCursor();
            return $result; //Only one result
        }
        catch (PDOException $e) {
            $errorMessage = $e->getMessage(); //We want to display the error
            include '../view/error_page.php';
            die;
        }
    }

    //Now lets add the functions to delete a request, 1 for each request type
    //HERE
/**THis function is used to delete a room request.
 * @param $requestID
 * @return int|void
 */
    function delete_room_request($requestID){
        $db = get_db_connection(); //Get connection to our database
        $query = "Delete From waitlist_request Where id = :requestID"; //Delete the room request with the specified ID
        $statement = $db->prepare($query);
        $statement->bindValue(':requestID', $requestID);
        $success = $statement->execute(); //used for checking later
        $statement->closeCursor();
        if ($success){
            return $statement->rowCount(); //returns the # of rows for error checking in the controller
        }
        else{
            $errorMessage = $statement->errorInfo(); //Get the error message
            include '../view/error_page.php'; //Show error page
        }
    }
    //Now the same for room change requests
/**This function deletes a room change request
 * @param $requestID
 * @return int|void\
 *
 *
 */
    function delete_room_change_request($requestID){
        $db = get_db_connection(); //Get connection to our database
        $query = "Delete From room_change_request Where id = :requestID"; //Delete the room change request with the specified ID
        $statement = $db->prepare($query);
        $statement->bindValue(':requestID', $requestID);
        $success = $statement->execute(); //used for checking later
        $statement->closeCursor();
        if ($success){
            return $statement->rowCount(); //returns the # of rows for error checking in the controller
        }
        else{
            $errorMessage = $statement->errorInfo(); //Get the error message
            include '../view/error_page.php'; //Show error page
        }
    }

/**
 * @param $campusID
 * @param $buildingName
 * @param $available
 * @param $availableLLC
 * @return false|string|void This function adds a new building into the building table
 */
    function insert_building($campusID, $buildingName, $available, $availableLLC){
        $db = get_db_connection(); //get db
        $query = 'INSERT INTO building (campus_id, building_name, available, available_llc) VALUES (:CampusID, :BuildingName, :Available, :AvailableLLC)';
        $statement = $db->prepare($query);
        $statement->bindValue(':CampusID', $campusID);
        $statement->bindValue(':BuildingName', $buildingName);
        $statement->bindValue(':Available', $available);
        $statement->bindValue(':AvailableLLC', $availableLLC);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId();//return the id of the new building
        }
        else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php'; //error message and error info
        }
    }

/** This function inserts a new row in the buildings_room_types table
 * @param $buildingID
 * @param $roomTypeID
 * @param $available
 * @return false|string|void
 */
    function insert_buildings_room_types($buildingID, $roomTypeID, $available){
        $db = get_db_connection(); //get db
        $query = 'INSERT INTO buildings_room_types (building_id, room_type_id, available) VALUES (:BuildingID, :RoomTypeID, :Available)';
        $statement = $db->prepare($query);
        $statement->bindValue(':BuildingID', $buildingID);
        $statement->bindValue(':RoomTypeID', $roomTypeID);
        $statement->bindValue(':Available', $available);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId();
        }
        else{
            $errorMessage = $statement->errorInfo(); //Error page and error message
            include '../view/error_page.php';
        }
    }

/** This is the function that is used to insert a new room request into the database. These requests are stored in the waitlist_request table
 * @param $email
 * @param $firstName
 * @param $lastName
 * @param $perferredName
 * @param $campus
 * @param $building1
 * @param $roomType1
 * @param $llc1
 * @param $building2
 * @param $roomType2
 * @param $llc2
 * @param $building3
 * @param $roomType3
 * @param $llc3
 * @param $roommate1
 * @param $roommate2
 * @param $roommate3
 * @param $completed
 * @return false|string|void
 */
    function insert_room_request($email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $completed, $deleted){
        //Lots of params
        $db = get_db_connection(); //get connection to our db
        $query = 'INSERT INTO waitlist_request (email, first_name, last_name, preferred_name, campus, building1, room_type1, llc1, building2, room_type2, llc2, building3, room_type3, llc3, roommate1, roommate2, roommate3, completed, deleted)
        VALUES (:Email, :FirstName, :LastName, :preferredNameInput, :inputCampus, :inputBuilding01, :inputRoom01, :inputLLC01, :inputBuilding02, :inputRoom02, :inputLLC02, :inputBuilding03, :inputRoom03, :inputLLC03, :roommateInput01, :roommateInput02, :roommateInput03, :Completed, :Deleted)';

        //Spellings should be good
        $statement = $db->prepare($query);
        $statement->bindValue( ':Email', $email);
        $statement->bindValue(':FirstName', $firstName);
        $statement->bindValue(':LastName', $lastName);
        $statement->bindValue(':preferredNameInput', $perferredName);
        $statement->bindValue(':inputCampus', $campus);
        $statement->bindValue(':inputBuilding01', $building1);
        $statement->bindValue(':inputRoom01', $roomType1);
        $statement->bindValue(':inputLLC01', $llc1);
        $statement->bindValue(':inputBuilding02', $building2);
        $statement->bindValue(':inputRoom02', $roomType2);
        $statement->bindValue(':inputLLC02', $llc2);
        $statement->bindValue(':inputBuilding03', $building3);
        $statement->bindValue(':inputRoom03', $roomType3);
        $statement->bindValue(':inputLLC03', $llc3);
        $statement->bindValue(':roommateInput01', $roommate1);
        $statement->bindValue(':roommateInput02', $roommate2);
        $statement->bindValue(':roommateInput03', $roommate3);
        $statement->bindValue(':Completed', $completed);
        $statement->bindValue(':Deleted', $deleted);

        //Now handle the possible nulls, because not all form input is required like llc, perferred name and roommates
        if (empty($perferredName)){
            $statement->bindValue(':preferredNameInput', null, PDO::PARAM_NULL);
        }
        if (empty($llc1)){
            $statement->bindValue(':inputLLC01' , null, PDO::PARAM_NULL);
        }
        //Choice 2 is no longer required
        if (empty($building2)){
            $statement->bindValue(':inputBuilding02', null, PDO::PARAM_NULL);
        }
        if (empty($roomType2)){
            $statement->bindValue(':inputRoom02', null, PDO::PARAM_NULL);
        }
        if (empty($llc2)){
            $statement->bindValue(':inputLLC02' , null, PDO::PARAM_NULL);
        }
        //Choice 3 is no longer required
        if (empty($building3)){
            $statement->bindValue(':inputBuilding03', null, PDO::PARAM_NULL);
        }
        if (empty($roomType3)){
            $statement->bindValue(':inputRoom03', null, PDO::PARAM_NULL);
        }
        if (empty($llc3)){
            $statement->bindValue(':inputLLC03' , null, PDO::PARAM_NULL);
        }
        if (empty($roommate1)){
            $statement->bindValue(':roommateInput01', null, PDO::PARAM_NULL);
        }
        if (empty($roommate2)){
            $statement->bindValue(':roommateInput02', null, PDO::PARAM_NULL);
        }
        if (empty($roommate3)){
            $statement->bindValue(':roommateInput03', null, PDO::PARAM_NULL);
        }
        // Possible NULLS should be handled
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId(); //Returns the id of the newly inserted row to the model
        }
        else{ //Include the error page
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php';
        }
    }

    //Now we do the function that will insert new room change requests
/** This is the function that is used to insert room change requests into the room_change_request table.
 * @param $email
 * @param $firstName
 * @param $lastName
 * @param $perferredName
 * @param $campus
 * @param $building1
 * @param $roomType1
 * @param $llc1
 * @param $building2
 * @param $roomType2
 * @param $llc2
 * @param $building3
 * @param $roomType3
 * @param $llc3
 * @param $roommate1
 * @param $roommate2
 * @param $roommate3
 * @param $reason
 * @param $completed
 * @return false|string|void
 */
    function insert_room_change_request($email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $reason, $completed, $deleted){
        $db = get_db_connection(); //get connect to db
        $query = 'INSERT INTO room_change_request (email, first_name, last_name, preferred_name, campus, building1, room_type1, llc1, building2, room_type2, llc2, building3, room_type3, llc3, roommate1, roommate2, roommate3, reason, completed, deleted)
        VALUES (:Email, :FirstName, :LastName, :preferredNameInput, :inputCampus, :inputBuilding01, :inputRoom01, :inputLLC01, :inputBuilding02, :inputRoom02, :inputLLC02, :inputBuilding03, :inputRoom03, :inputLLC03, :roommateInput01, :roommateInput02, :roommateInput03, :Reason, :Completed, :Deleted)';

        $statement = $db->prepare($query);
        $statement->bindValue( ':Email', $email);
        $statement->bindValue(':FirstName', $firstName);
        $statement->bindValue(':LastName', $lastName);
        $statement->bindValue(':preferredNameInput', $perferredName);
        $statement->bindValue(':inputCampus', $campus);
        $statement->bindValue(':inputBuilding01', $building1);
        $statement->bindValue(':inputRoom01', $roomType1);
        $statement->bindValue(':inputLLC01', $llc1);
        $statement->bindValue(':inputBuilding02', $building2);
        $statement->bindValue(':inputRoom02', $roomType2);
        $statement->bindValue(':inputLLC02', $llc2);
        $statement->bindValue(':inputBuilding03', $building3);
        $statement->bindValue(':inputRoom03', $roomType3);
        $statement->bindValue(':inputLLC03', $llc3);
        $statement->bindValue(':roommateInput01', $roommate1);
        $statement->bindValue(':roommateInput02', $roommate2);
        $statement->bindValue(':roommateInput03', $roommate3);
        $statement->bindValue(':Reason', $reason); //Waitlist request doesn't have this field
        $statement->bindValue(':Completed', $completed);
        $statement->bindValue(':Deleted', $deleted);
        //Now we check the ones that are allowed to be null
        if (empty($perferredName)){
            $statement->bindValue(':preferredNameInput', null, PDO::PARAM_NULL);
        }
        if (empty($llc1)){
            $statement->bindValue(':inputLLC01' , null, PDO::PARAM_NULL);
        }
        //Choice 2 is no longer required
        if (empty($building2)){
            $statement->bindValue(':inputBuilding02', null, PDO::PARAM_NULL);
        }
        if (empty($roomType2)){
            $statement->bindValue(':inputRoom02', null, PDO::PARAM_NULL);
        }
        if (empty($llc2)){
            $statement->bindValue(':inputLLC02' , null, PDO::PARAM_NULL);
        }
        //Choice 3 is no longer required
        if (empty($building3)){
            $statement->bindValue(':inputBuilding03', null, PDO::PARAM_NULL);
        }
        if (empty($roomType3)){
            $statement->bindValue(':inputRoom03', null, PDO::PARAM_NULL);
        }
        if (empty($llc3)){
            $statement->bindValue(':inputLLC03' , null, PDO::PARAM_NULL);
        }
        if (empty($roommate1)){
            $statement->bindValue(':roommateInput01', null, PDO::PARAM_NULL);
        }
        if (empty($roommate2)){
            $statement->bindValue(':roommateInput02', null, PDO::PARAM_NULL);
        }
        if (empty($roommate3)){
            $statement->bindValue(':roommateInput03', null, PDO::PARAM_NULL);
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId(); //return the auto incremented id for the row we just added to the db
        }
        else{ //Include the error page if there was errors
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php';
        }
    }

/** This function inserts a new row in to the room_type table
 * @param $roomTypeName
 * @return false|string|void
 */
    function insert_room_type($roomTypeName){
        $db = get_db_connection(); //get db
        $query = 'INSERT INTO room_type (type) VALUES (:RoomTypeName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':RoomTypeName', $roomTypeName);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId(); //returns the id of the new row
        }
        else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php';
        }
    }
/** This function inserts a new row in to the llc table
 * @param $llcName
 * @return false|string|void
 */
    function insert_llc($llcName){
        $db = get_db_connection(); //get db
        $query = 'INSERT INTO llc (name) VALUES (:LLCName)';
        $statement = $db->prepare($query);
        $statement->bindValue(':LLCName', $llcName);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId(); //returns the id of the new row
        }
        else{
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php';
        }
    }
/** This function inserts a new row in the buildings_room_types_llcs table
 * @param $buildingID
 * @param $llcID
 * @return false|string|void
 */
    function insert_buildings_room_types_llcs($buildingID, $roomTypeID, $llcID, $available){
        $db = get_db_connection(); //get db
        $query = 'INSERT INTO buildings_room_types_llcs (building_id, room_type_id, llc_id, available) VALUES (:BuildingID, :RoomTypeID,:LLCID, :Available)';
        $statement = $db->prepare($query);
        $statement->bindValue(':BuildingID', $buildingID);
        $statement->bindValue(':RoomTypeID', $roomTypeID);
        $statement->bindValue(':LLCID', $llcID);
        $statement->bindValue(':Available', $available);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId();
        }
        else{
            $errorMessage = $statement->errorInfo(); //Error page and error message
            include '../view/error_page.php';
        }
    }
/** This function inserts a new row in the buildings_llcs table
 * @param $buildingID
 * @param $llcID
 * @return false|string|void
 */
    function insert_buildings_llcs($buildingID, $llcID){
        $db = get_db_connection(); //get db
        $query = 'INSERT INTO buildings_llcs (building_id, llc_id) VALUES (:BuildingID, :LLCID)';
        $statement = $db->prepare($query);
        $statement->bindValue(':BuildingID', $buildingID);
        $statement->bindValue(':LLCID', $llcID);
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $db->lastInsertId();
        }
        else{
            $errorMessage = $statement->errorInfo(); //Error page and error message
            include '../view/error_page.php';
        }

    }
/** This function inserts a new row in the buildings_room_types table
 * @param $roomTypeID
 * @param $llcID
 * @return false|string|void
 */
function insert_rooms_llcs($roomTypeID, $llcID){
    $db = get_db_connection(); //get db
    $query = 'INSERT INTO rooms_llcs (room_type_id, llc_id) VALUES (:RoomTypeID, :LLCID)';
    $statement = $db->prepare($query);
    $statement->bindValue(':RoomTypeID', $roomTypeID);
    $statement->bindValue(':LLCID', $llcID);
    $success = $statement->execute();
    $statement->closeCursor();
    if ($success){
        return $db->lastInsertId();
    }
    else{
        $errorMessage = $statement->errorInfo(); //Error page and error message
        include '../view/error_page.php';
    }

}
/**
 * @param $requestID
 * @param $CurrentStatus
 * @param $NewStatus
 * @return void This function changes the completion staus of a room change request based upon the passed in parameters. Current Status
 * is the value of completed in the db row, it is laways 'N' or 'Y'. New status must be the value Current status isn't. RequestID is id
 * for the requests row in the db.
 */
    function manage_room_change_request_completed($requestID, $NewStatus){
        try {
            $db = get_db_connection();// get connection to the db
            $query = 'UPDATE room_change_request SET completed = :NewStatus WHERE id = :RequestID';

            $statement = $db->prepare($query);
            $statement->bindValue(':NewStatus', $NewStatus);
            $statement->bindValue(':RequestID', $requestID);
            $statement->execute();
            $statement->closecursor();
        }
        catch (PDOException $e) { //If the operation fails display the error message
            $errorMessage = $e->getMessage();
            include '../view/error_page.php';
        }
    }

/**
 * @param $requestID
 * @param $CurrentStatus
 * @param $NewStatus
 * @return void This function changes the completion staus of a room request based upon the passed in parameters. Current Status
 * is the value of completed in the db row, it is laways 'N' or 'Y'. New status must be the value Current status isn't. RequestID is id
 * for the requests row in the db.
 */
function manage_room_request_completed($requestID, $NewStatus){
    try {
        try {
            $db = get_db_connection();// get connection to the db
            $query = 'UPDATE waitlist_request SET completed = :NewStatus WHERE id = :RequestID';

            $statement = $db->prepare($query);
            $statement->bindValue(':NewStatus', $NewStatus);
            $statement->bindValue(':RequestID', $requestID);
            $statement->execute();
            $statement->closecursor();
        }
        catch (PDOException $e) { //If the operation fails display the error message
            $errorMessage = $e->getMessage();
            include '../view/error_page.php';
        }
    }
    catch (PDOException $e) { //If the operation fails display the error message
        $errorMessage = $e->getMessage();
        include '../view/error_page.php';
    }
}

/**
 * @param $email
 * @param $firstName
 * @param $lastName
 * @param $perferredName
 * @param $campus
 * @param $building1
 * @param $roomType1
 * @param $llc1
 * @param $building2
 * @param $roomType2
 * @param $llc2
 * @param $building3
 * @param $roomType3
 * @param $llc3
 * @param $roommate1
 * @param $roommate2
 * @param $roommate3
 * @param $emailDateTime
 * @param $completed
 * @param $deleted
 * @return false|string|void This fnction isued when bumping a request to the bottom. Giving the reinertion of a request its own model fctn
 * seemed like the easiest solution.
 */
function reinsert_room_request($email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $emailDateTime, $completed, $deleted){
    //Lots of params
    $db = get_db_connection(); //get connection to our db
    $query = 'INSERT INTO waitlist_request (email, first_name, last_name, preferred_name, campus, building1, room_type1, llc1, building2, room_type2, llc2, building3, room_type3, llc3, roommate1, roommate2, roommate3, email_datetime, completed, deleted)
        VALUES (:Email, :FirstName, :LastName, :preferredNameInput, :inputCampus, :inputBuilding01, :inputRoom01, :inputLLC01, :inputBuilding02, :inputRoom02, :inputLLC02, :inputBuilding03, :inputRoom03, :inputLLC03, :roommateInput01, :roommateInput02, :roommateInput03, :EmailDateTime, :Completed, :Deleted)';

    //Spellings should be good
    $statement = $db->prepare($query);
    $statement->bindValue( ':Email', $email);
    $statement->bindValue(':FirstName', $firstName);
    $statement->bindValue(':LastName', $lastName);
    $statement->bindValue(':preferredNameInput', $perferredName);
    $statement->bindValue(':inputCampus', $campus);
    $statement->bindValue(':inputBuilding01', $building1);
    $statement->bindValue(':inputRoom01', $roomType1);
    $statement->bindValue(':inputLLC01', $llc1);
    $statement->bindValue(':inputBuilding02', $building2);
    $statement->bindValue(':inputRoom02', $roomType2);
    $statement->bindValue(':inputLLC02', $llc2);
    $statement->bindValue(':inputBuilding03', $building3);
    $statement->bindValue(':inputRoom03', $roomType3);
    $statement->bindValue(':inputLLC03', $llc3);
    $statement->bindValue(':roommateInput01', $roommate1);
    $statement->bindValue(':roommateInput02', $roommate2);
    $statement->bindValue(':roommateInput03', $roommate3);
    $statement->bindValue(':EmailDateTime', $emailDateTime);
    $statement->bindValue(':Completed', $completed);
    $statement->bindValue(':Deleted', $deleted);
    //Now handle the possible nulls, because not all form input is required like llc, perferred name and roommates
    if (empty($perferredName)){
        $statement->bindValue(':preferredNameInput', null, PDO::PARAM_NULL);
    }
    if (empty($llc1)){
        $statement->bindValue(':inputLLC01' , null, PDO::PARAM_NULL);
    }
    //Choice 2 is no longer required
    if (empty($building2)){
        $statement->bindValue(':inputBuilding02', null, PDO::PARAM_NULL);
    }
    if (empty($roomType2)){
        $statement->bindValue(':inputRoom02', null, PDO::PARAM_NULL);
    }
    if (empty($llc2)){
        $statement->bindValue(':inputLLC02' , null, PDO::PARAM_NULL);
    }
    //Choice 3 is no longer required
    if (empty($building3)){
        $statement->bindValue(':inputBuilding03', null, PDO::PARAM_NULL);
    }
    if (empty($roomType3)){
        $statement->bindValue(':inputRoom03', null, PDO::PARAM_NULL);
    }
    if (empty($llc3)){
        $statement->bindValue(':inputLLC03' , null, PDO::PARAM_NULL);
    }
    if (empty($roommate1)){
        $statement->bindValue(':roommateInput01', null, PDO::PARAM_NULL);
    }
    if (empty($roommate2)){
        $statement->bindValue(':roommateInput02', null, PDO::PARAM_NULL);
    }
    if (empty($roommate3)){
        $statement->bindValue(':roommateInput03', null, PDO::PARAM_NULL);
    }
    if (empty($emailDateTime)){
        $statement->bindValue(':EmailDateTime', null, PDO::PARAM_NULL);
    }
    // Possible NULLS should be handled
    $success = $statement->execute();
    $statement->closeCursor();
    if ($success){
        return $db->lastInsertId(); //Returns the id of the newly inserted row to the model
    }
    else{ //Include the error page
        $errorMessage = $statement->errorInfo();
        include '../view/error_page.php';
    }
}
/**
 * @param $email
 * @param $firstName
 * @param $lastName
 * @param $perferredName
 * @param $campus
 * @param $building1
 * @param $roomType1
 * @param $llc1
 * @param $building2
 * @param $roomType2
 * @param $llc2
 * @param $building3
 * @param $roomType3
 * @param $llc3
 * @param $roommate1
 * @param $roommate2
 * @param $roommate3
 * @param $emailDateTime
 * @param $completed
 * @param $deleted
 * @return false|string|void This fnction isued when bumping a request to the bottom. Giving the reinertion of a request its own model fctn
 * seemed like the easiest solution.
 */
function reinsert_room_change_request($email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $reason, $emailDateTime, $completed, $deleted){
    $db = get_db_connection(); //get connect to db
    $query = 'INSERT INTO room_change_request (email, first_name, last_name, preferred_name, campus, building1, room_type1, llc1, building2, room_type2, llc2, building3, room_type3, llc3, roommate1, roommate2, roommate3, reason, email_datetime, completed, deleted)
        VALUES (:Email, :FirstName, :LastName, :preferredNameInput, :inputCampus, :inputBuilding01, :inputRoom01, :inputLLC01, :inputBuilding02, :inputRoom02, :inputLLC02, :inputBuilding03, :inputRoom03, :inputLLC03, :roommateInput01, :roommateInput02, :roommateInput03, :Reason, :EmailDateTime, :Completed, :Deleted)';

    $statement = $db->prepare($query);
    $statement->bindValue( ':Email', $email);
    $statement->bindValue(':FirstName', $firstName);
    $statement->bindValue(':LastName', $lastName);
    $statement->bindValue(':preferredNameInput', $perferredName);
    $statement->bindValue(':inputCampus', $campus);
    $statement->bindValue(':inputBuilding01', $building1);
    $statement->bindValue(':inputRoom01', $roomType1);
    $statement->bindValue(':inputLLC01', $llc1);
    $statement->bindValue(':inputBuilding02', $building2);
    $statement->bindValue(':inputRoom02', $roomType2);
    $statement->bindValue(':inputLLC02', $llc2);
    $statement->bindValue(':inputBuilding03', $building3);
    $statement->bindValue(':inputRoom03', $roomType3);
    $statement->bindValue(':inputLLC03', $llc3);
    $statement->bindValue(':roommateInput01', $roommate1);
    $statement->bindValue(':roommateInput02', $roommate2);
    $statement->bindValue(':roommateInput03', $roommate3);
    $statement->bindValue(':Reason', $reason); //Waitlist request doesn't have this field
    $statement->bindValue(':EmailDateTime', $emailDateTime);
    $statement->bindValue(':Completed', $completed);
    $statement->bindValue(':Deleted', $deleted);
    //Now we check the ones that are allowed to be null
    if (empty($perferredName)){
        $statement->bindValue(':preferredNameInput', null, PDO::PARAM_NULL);
    }
    if (empty($llc1)){
        $statement->bindValue(':inputLLC01' , null, PDO::PARAM_NULL);
    }
    //Choice 2 is no longer required
    if (empty($building2)){
        $statement->bindValue(':inputBuilding02', null, PDO::PARAM_NULL);
    }
    if (empty($roomType2)){
        $statement->bindValue(':inputRoom02', null, PDO::PARAM_NULL);
    }
    if (empty($llc2)){
        $statement->bindValue(':inputLLC02' , null, PDO::PARAM_NULL);
    }
    //Choice 3 is no longer required
    if (empty($building3)){
        $statement->bindValue(':inputBuilding03', null, PDO::PARAM_NULL);
    }
    if (empty($roomType3)){
        $statement->bindValue(':inputRoom03', null, PDO::PARAM_NULL);
    }
    if (empty($llc3)){
        $statement->bindValue(':inputLLC03' , null, PDO::PARAM_NULL);
    }
    if (empty($roommate1)){
        $statement->bindValue(':roommateInput01', null, PDO::PARAM_NULL);
    }
    if (empty($roommate2)){
        $statement->bindValue(':roommateInput02', null, PDO::PARAM_NULL);
    }
    if (empty($roommate3)){
        $statement->bindValue(':roommateInput03', null, PDO::PARAM_NULL);
    }if (empty($emailDateTime)){
        $statement->bindValue(':EmailDateTime', null, PDO::PARAM_NULL);
    }
    $success = $statement->execute();
    $statement->closeCursor();
    if ($success){
        return $db->lastInsertId(); //return the auto incremented id for the row we just added to the db
    }
    else{ //Include the error page if there was errors
        $errorMessage = $statement->errorInfo();
        include '../view/error_page.php';
    }
}
/**This is the function that is used to edit room requests. We don' allow edits, to the email or name, as they are pulled from SSO
 * @param $perferredName
 * @param $campus
 * @param $building1
 * @param $roomType1
 * @param $llc1
 * @param $building2
 * @param $roomType2
 * @param $llc2
 * @param $building3
 * @param $roomType3
 * @param $llc3
 * @param $roommate1
 * @param $roommate2
 * @param $roommate3
 * @param $completed
 * @return int|void
 */
    function update_room_request($roomRequestID, $email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $completed, $deleted){
        $db = get_db_connection(); //get db connection
        //Speeling should be good
        $query = 'UPDATE waitlist_request SET email = :Email, first_name = :FirstName, last_name = :LastName, preferred_name = :preferredNameInput, campus = :inputCampus, building1 = :inputBuilding01, room_type1 = :inputRoom01, llc1 = :inputLLC01, building2 = :inputBuilding02, room_type2 = :inputRoom02, llc2 = :inputLLC02, building3 = :inputBuilding03, room_type3 = :inputRoom03, llc3 = :inputLLC03, roommate1 = :roommateInput01, roommate2 = :roommateInput02, roommate3 = :roommateInput03, completed = :Completed, deleted = :Deleted WHERE id = :RoomRequestID'; //Woah
        $statement = $db->prepare($query);
        $statement->bindValue(':RoomRequestID', $roomRequestID);
        $statement->bindValue( ':Email', $email);
        $statement->bindValue(':FirstName', $firstName);
        $statement->bindValue(':LastName', $lastName);
        $statement->bindValue(':preferredNameInput', $perferredName);
        $statement->bindValue(':inputCampus', $campus);
        $statement->bindValue(':inputBuilding01', $building1);
        $statement->bindValue(':inputRoom01', $roomType1);
        $statement->bindValue(':inputLLC01', $llc1);
        $statement->bindValue(':inputBuilding02', $building2);
        $statement->bindValue(':inputRoom02', $roomType2);
        $statement->bindValue(':inputLLC02', $llc2);
        $statement->bindValue(':inputBuilding03', $building3);
        $statement->bindValue(':inputRoom03', $roomType3);
        $statement->bindValue(':inputLLC03', $llc3);
        $statement->bindValue(':roommateInput01', $roommate1);
        $statement->bindValue(':roommateInput02', $roommate2);
        $statement->bindValue(':roommateInput03', $roommate3);
        $statement->bindValue(':Completed', $completed);
        $statement->bindValue(':Deleted', $deleted);
        //Check for nulls
        if (empty($perferredName)){
            $statement->bindValue(':preferredNameInput', null, PDO::PARAM_NULL);
        }
        if (empty($llc1)){
            $statement->bindValue(':inputLLC01' , null, PDO::PARAM_NULL);
        }
        if (empty($llc2)){
            $statement->bindValue(':inputLLC02' , null, PDO::PARAM_NULL);
        }
        if (empty($llc3)){
            $statement->bindValue(':inputLLC03' , null, PDO::PARAM_NULL);
        }
        if (empty($roommate1)){
            $statement->bindValue(':roommateInput01', null, PDO::PARAM_NULL);
        }
        if (empty($roommate2)){
            $statement->bindValue(':roommateInput02', null, PDO::PARAM_NULL);
        }
        if (empty($roommate3)){
            $statement->bindValue(':roommateInput03', null, PDO::PARAM_NULL);
        }
        //Dun with that, we stil check on an edit because a student may remove an optional field
        $success = $statement->execute(); //success is true if the query ran properly
        $statement->closeCursor();
        if ($success){
            return $statement->rowCount(); //Returns the number of rows effected to the controller
        }
        else{ //Include the error page
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php';
        }
    }

    //Now we do the same for room change requests
/** this is the function that is used to update room change requests
 * @param $perferredName
 * @param $campus
 * @param $building1
 * @param $roomType1
 * @param $llc1
 * @param $building2
 * @param $roomType2
 * @param $llc2
 * @param $building3
 * @param $roomType3
 * @param $llc3
 * @param $roommate1
 * @param $roommate2
 * @param $roommate3
 * @param $reason
 * @param $completed
 * @return int|void
 */
    function update_room_change_request($roomChangeRequestID, $email, $firstName, $lastName, $perferredName, $campus, $building1, $roomType1, $llc1, $building2, $roomType2, $llc2, $building3, $roomType3, $llc3, $roommate1, $roommate2, $roommate3, $reason, $completed, $deleted){
        //Spelling hshould be good
        $db = get_db_connection(); //get db connection
        $query = 'UPDATE room_change_request SET email = :Email, first_name = :FirstName, last_name = :LastName, preferred_name = :preferredNameInput, campus = :inputCampus, building1 = :inputBuilding01, room_type1 = :inputRoom01, llc1 = :inputLLC01, building2 = :inputBuilding02, room_type2 = :inputRoom02, llc2 = :inputLLC02, building3 = :inputBuilding03, room_type3 = :inputRoom03, llc3 = :inputLLC03, roommate1 = :roommateInput01, roommate2 = :roommateInput02, roommate3 = :roommateInput03, reason = :Reason, completed = :Completed, deleted = :Deleted WHERE id = :RoomChangeRequestID';
        $statement = $db->prepare($query);
        $statement->bindValue(':RoomChangeRequestID', $roomChangeRequestID);
        $statement->bindValue( ':Email', $email);
        $statement->bindValue(':FirstName', $firstName);
        $statement->bindValue(':LastName', $lastName);
        $statement->bindValue(':preferredNameInput', $perferredName);
        $statement->bindValue(':inputCampus', $campus);
        $statement->bindValue(':inputBuilding01', $building1);
        $statement->bindValue(':inputRoom01', $roomType1);
        $statement->bindValue(':inputLLC01', $llc1);
        $statement->bindValue(':inputBuilding02', $building2);
        $statement->bindValue(':inputRoom02', $roomType2);
        $statement->bindValue(':inputLLC02', $llc2);
        $statement->bindValue(':inputBuilding03', $building3);
        $statement->bindValue(':inputRoom03', $roomType3);
        $statement->bindValue(':inputLLC03', $llc3);
        $statement->bindValue(':roommateInput01', $roommate1);
        $statement->bindValue(':roommateInput02', $roommate2);
        $statement->bindValue(':roommateInput03', $roommate3);
        $statement->bindValue(':Reason', $reason);
        $statement->bindValue(':Completed', $completed);
        $statement->bindValue(':Deleted', $deleted);
        //Now we check the ones that are allowed to be null
        if (empty($perferredName)){
            $statement->bindValue(':preferredNameInput', null, PDO::PARAM_NULL);
        }
        if (empty($llc1)){
            $statement->bindValue(':inputLLC01' , null, PDO::PARAM_NULL);
        }
        //Choice 2 is no longer required
        if (empty($building2)){
            $statement->bindValue(':inputBuilding02', null, PDO::PARAM_NULL);
        }
        if (empty($roomType2)){
            $statement->bindValue(':inputRoom02', null, PDO::PARAM_NULL);
        }
        if (empty($llc2)){
            $statement->bindValue(':inputLLC02' , null, PDO::PARAM_NULL);
        }
        //Choice 3 is no longer required
        if (empty($building3)){
            $statement->bindValue(':inputBuilding03', null, PDO::PARAM_NULL);
        }
        if (empty($roomType3)){
            $statement->bindValue(':inputRoom03', null, PDO::PARAM_NULL);
        }
        if (empty($llc3)){
            $statement->bindValue(':inputLLC03' , null, PDO::PARAM_NULL);
        }
        if (empty($roommate1)){
            $statement->bindValue(':roommateInput01', null, PDO::PARAM_NULL);
        }
        if (empty($roommate2)){
            $statement->bindValue(':roommateInput02', null, PDO::PARAM_NULL);
        }
        if (empty($roommate3)){
            $statement->bindValue(':roommateInput03', null, PDO::PARAM_NULL);
        }
        $success = $statement->execute();
        $statement->closeCursor();
        if ($success){
            return $statement->rowCount(); //returns the number of rows effected to the controller
        }
        else{ //Include the error page
            $errorMessage = $statement->errorInfo();
            include '../view/error_page.php';
        }
    }
/**This function is used to get a room request by email. It will return the row associated with that email or false if there is no row associated with that email.
 * @param $email
 * @return mixed|void
 */
    function get_room_request_by_email($email){
        try {
            $db = get_db_connection(); //get connection to db
            $query = "SELECT * FROM waitlist_request WHERE email = :email AND completed = 'N' AND deleted = 'N'";
            //We only want the noncomleted ones as the student could have a multiple in the table depending on if admin deletes them
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(); //The row associated with that email or false
            $statement->closeCursor();
            return $result; //will return false if the there is no row
            }
            catch (PDOException $e) { //include error page if there is an error
            $errorMessage = $e->getMessage();
            include '../view/error_page.php';
            die();
            }
    }

    //Now the fctn to get a room chnage request by email
/** This function is used to get a room change request by email. It returns the row associated with that email or flase if there is no row associated with that email
 * @param $email
 * @return mixed|void
 */
    function get_room_change_request_by_email($email){
        try {
            $db = get_db_connection();
            $query = "SELECT * FROM room_change_request WHERE email = :email AND completed = 'N' AND deleted = 'N'"; //N because this function is used when student wants to view a request, and could have old ones
            //Again we only want non completed and not deleted requests.
            $statement = $db->prepare($query);
            $statement->bindValue(':email', $email);
            $statement->execute();
            $result = $statement->fetch(); //The row associated with that email or false
            $statement->closeCursor();
            return $result; //FALSE if there is no row
            }
            catch (PDOException $e) { //include the error page if needed
            $errorMessage = $e->getMessage();
            include '../view/error_page.php';
            die();
            }
    }

    function get_previous_campus($request_id){
        $db = get_db_connection(); //get connection to db
        $query = "SELECT * FROM campus INNER JOIN room_change_request  ON campus.id = room_change_request.campus
         ";
        $statement = $db->prepare($query);
        //$statement->bindValue(':request_id', $request_id);
        $statement->execute();
        $result = $statement->fetch();
        return $result;


    }

    function set_timestamp($request_id, $form){
        // First, update the timestamp for email being sent
        if ($form == 'RoomChange'){
            $tableName = 'room_change_request';
        }
        else{
            $tableName = 'waitlist_request';
        }

        $db = get_db_connection();
        $query = "UPDATE $tableName SET email_datetime = NOW() WHERE id = :request_id";
        $statement = $db->prepare($query);
        $statement->bindValue(':request_id', $request_id, PDO::PARAM_INT);

        $statement->execute();
        $statement -> closeCursor();

    }



/*
 * This series of if statements are communicated with by main.js for the dependent dropdowns.
 * Based on the post variable value, it will grab the data of the appropriate row of a table to send back
 * to main.js to populate the dropdowns with the data.
 */

/* This fetches buildings given a campus name */
if (isset($_POST['fetchBuildings'])) {
    try {
        $db = get_db_connection(); // Get database connection
        // Select the buildings given the campus name and that it is available.
        //  - Hides unavailable buildings in the dropdown
        $query = "SELECT building.*
                  FROM building
                  INNER JOIN campus ON building.campus_id = campus.id
                  WHERE campus.name = :cname AND building.available = 'Y'
                  GROUP BY building.building_name";
        $statement = $db->prepare($query);

        // Bind the campus_id as an integer
        //$statement->bindValue(':cid', intval($_POST['cid']), PDO::PARAM_INT);
        $statement->bindValue(':cname', $_POST['cname'], PDO::PARAM_STR);

        // Execute and fetch the results
        $statement->execute();
        $buildings = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        // Encode the results to JSON
        echo json_encode($buildings);
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php';
        die();
    }
}
/* This fetches room types given a building name */
else if (isset($_POST['fetchRooms'])) {
    try {
        $db = get_db_connection(); // Get database connection
        $query = "SELECT room_type.id, room_type.type
                  FROM room_type
                  INNER JOIN buildings_room_types ON room_type.id = buildings_room_types.room_type_id
                  INNER JOIN building ON buildings_room_types.building_id = building.id
                  WHERE building.building_name = :bname AND buildings_room_types.available = 'Y'
                  GROUP BY room_type.type";
        $statement = $db->prepare($query);
        // Bind the building id as an integer
        //$statement->bindValue(':bid', intval($_POST['bid']), PDO::PARAM_INT);
        $statement->bindValue(':bname', $_POST['bname'], PDO::PARAM_STR);

        // Execute and fetch the results
        $statement->execute();
        $rooms = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        // Encode the results to JSON
        echo json_encode($rooms);
    }
    catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php';
        die();
    }
}
/* This fetches all the LLCs given a building name and room type. */
else if (isset($_POST['fetchLLCs'])) {
    try {
        $db = get_db_connection(); // Get database connection
//        $query = "SELECT llc.id, llc.name -- old query using the two binary relationships
//                       FROM llc
//                       INNER JOIN rooms_llcs ON llc.id = rooms_llcs.llc_id
//                       INNER JOIN room_type ON rooms_llcs.room_type_id = room_type.id
//                       INNER JOIN buildings_room_types ON room_type.id = buildings_room_types.room_type_id
//                       INNER JOIN building ON buildings_room_types.building_id = building.id
//                       INNER JOIN buildings_llcs ON llc.id = buildings_llcs.llc_id
//                        AND buildings_llcs.building_id = building.id
//                       WHERE building.building_name = :bname AND room_type.type = :rtype
//                       GROUP BY llc.name";
        $query = "SELECT llc.id, llc.name -- new query using ternary relationship
                    FROM llc
                    INNER JOIN buildings_room_types_llcs brtl ON llc.id = brtl.llc_id
                        AND brtl.available = TRUE  -- Ensure the LLC is active for the specific building-room type
                    INNER JOIN building ON brtl.building_id = building.id
                    INNER JOIN room_type ON brtl.room_type_id = room_type.id
                    WHERE building.building_name = :bname
                        AND room_type.type = :rtype
                    GROUP BY llc.name";

        $statement = $db->prepare($query);
        //$statement->bindValue(':bid', intval($_POST['bid']), PDO::PARAM_INT);
        //$statement->bindValue(':rid', intval($_POST['rid']), PDO::PARAM_INT);

        $statement->bindValue(':bname', $_POST['bname'], PDO::PARAM_STR);
        $statement->bindValue(':rtype', $_POST['rtype'], PDO::PARAM_STR);

        $statement->execute();
        $llcs = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        // Log the result to debug
        if (empty($llcs)) {
            error_log("No LLCs found for bname=" . $_POST['bname'] . " and rtype=" . $_POST['rtype']);
        }
        // Encode the results to JSON
        echo json_encode($llcs);

    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php';
        die();
    }
}
/* This was used when each successive choice was dependent on the last.
     - ie, entire second choice dependent on entire first choice.
    Currently unused. */
else if (isset($_POST['fetchLLCsBuildings'])) {
    try {
        $db = get_db_connection(); // Get database connection
        $query = "SELECT llc.id, llc.name
                       FROM llc
                       INNER JOIN rooms_llcs ON llc.id = rooms_llcs.llc_id
                       INNER JOIN room_type ON rooms_llcs.room_type_id = room_type.id
                       INNER JOIN buildings_room_types ON room_type.id = buildings_room_types.room_type_id
                       INNER JOIN building ON buildings_room_types.building_id = building.id
                       INNER JOIN buildings_llcs ON llc.id = buildings_llcs.llc_id
                        AND buildings_llcs.building_id = building.id
                       WHERE building.id = :bid AND room_type.id = :rid";

        $statement = $db->prepare($query);
        $statement->bindValue(':bid', intval($_POST['bid']), PDO::PARAM_INT);
        $statement->bindValue(':rid', intval($_POST['rid']), PDO::PARAM_INT);

        $statement->execute();
        $llcs = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        // Log the result to debug
        if (empty($llcs)) {
            error_log("No LLCs found for bid=" . $_POST['bid'] . " and rid=" . $_POST['rid']);
        }

        $query = "SELECT * FROM building WHERE campus_id = :cid";
        $statement = $db->prepare($query);
        // Bind the campus_id as an integer
        $statement->bindValue(':cid', intval($_POST['cid']), PDO::PARAM_INT);
        // Execute and fetch the results
        $statement->execute();
        $buildings = $statement->fetchAll(PDO::FETCH_ASSOC);
        $statement->closeCursor();

        $response = [
            'llcs' => $llcs,
            'buildings' => $buildings,
        ];

        // Encode the results to JSON
        echo json_encode($response);

    } catch (PDOException $e) {
        $errorMessage = $e->getMessage();
        include '../view/error_page.php';
        die();
    }
}



/* This function loads each campus from the database and returns it.
 * @return
 * */
    function load_campuses() {
        try {
            $db = get_db_connection(); //get db
            $query = "SELECT * FROM campus"; //All rows
            $statement = $db->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $result;
        }
        catch (PDOException $e) {
            $errorMessage = $e->getMessage();
            include '../view/error_page.php';
            die();
        }
    }
    ?>
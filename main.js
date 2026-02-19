//Main JS file
//Since JS did not like passing in a parameter to a fctn you call during an onclik we will have a separate fctn for each search case
//The following functions for name search all use tableMode == 1 because it is the deafult
/**
 * THis function is for if a user wants to search room requests by name
 */
function name_search1(){
    document.location = "../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=1&table=waitlist_request&column=first_name&criteria=" + encodeURIComponent($('#Criteria').val());
}

/**
 * This function is for if a user wants to search room request by last name
 */
function name_search2(){
    document.location = "../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=1&table=waitlist_request&column=last_name&criteria=" + encodeURIComponent($('#Criteria').val());
}

/**
 * This function is for if a user wants to search room requests by email
 */
function name_search3(){
    document.location = "../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=1&table=waitlist_request&column=email&criteria=" + encodeURIComponent($('#Criteria').val());
}
/**
 * This function is for if a user wants to search room change requests by first name
 */
function name_search4(){
    document.location = "../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=1&table=room_change_request&column=first_name&criteria=" + encodeURIComponent($('#Criteria').val());
}

/**
 * This function is for is a user wants to seach room change requests by last name
 */
function name_search5(){
    document.location = "../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=1&table=room_change_request&column=last_name&criteria=" + encodeURIComponent($('#Criteria').val());
}

/**
 * This function is for if a user wants to search room change requests by email
 */
function name_search6(){
    document.location = "../controller/controller.php?action=ListStudents&ListType=GeneralSearchUncomplete&TableMode=1&table=room_change_request&column=email&criteria=" + encodeURIComponent($('#Criteria').val());
}



// Dependent drop down function. Listens for changes in each dropdown and loads in the
// appropriate information for the next one.
$(document).ready(function(){
    // If campus dropdown receives input, populate the first choice building dropdown
    $("#inputCampus").change(function(){
        var cname = $("#inputCampus").val();
        console.log(cname);
        $.ajax({
            url: '../model/model.php',
            method: 'post',
            data: {cname: cname, fetchBuildings: 'true'}
        }).done(function(buildings){
            console.log(buildings);
            buildings = JSON.parse(buildings);
            // Clear all the dropdowns out
            $('#inputBuilding01').empty();
            $('#inputBuilding02').empty();
            $('#inputBuilding03').empty();
            $('#inputRoom01').empty();
            $('#inputRoom02').empty();
            $('#inputRoom03').empty();
            $('#inputLLC01').empty();
            $('#inputLLC02').empty();
            $('#inputLLC03').empty();
            $('#inputBuilding01').append('<option selected disabled></option>')
            $('#inputBuilding02').append('<option selected disabled></option>')
            $('#inputBuilding03').append('<option selected disabled></option>')
            // Populate each building dropdown
            buildings.forEach(function(building){
                $('#inputBuilding01').append('<option value="' + building.building_name + '">' + building.building_name + '</option>')
                $('#inputBuilding02').append('<option value="' + building.building_name + '">' + building.building_name + '</option>')
                $('#inputBuilding03').append('<option value="' + building.building_name + '">' + building.building_name + '</option>')
            })
        })
    })
    // If first choice building dropdown receives input, populate the first choice room type dropdown
    $("#inputBuilding01").change(function (){
        var bname = $("#inputBuilding01").val();
        console.log(bname);
        $.ajax({
            url: '../model/model.php',
            method: 'post',
            data: {bname: bname, fetchRooms: 'true'}
        }).done(function(rooms){
            console.log("Response from PHP:", rooms);
            try {
                rooms = JSON.parse(rooms);
                console.log("Parsed rooms:", rooms);  // Check if JSON parsing is successful
                // Clear out room1 and llc1
                $('#inputRoom01').empty();
                $('#inputLLC01').empty();
                $('#inputRoom01').append('<option selected disabled></option>')
                rooms.forEach(function(room) {
                    $('#inputRoom01').append('<option value="' + room.type + '">' + room.type + '</option>');
                });
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        })
    })
    // If first choice room dropdown receives input, populate the first choice LLC dropdown and second choice building dropdown
    $("#inputRoom01").change(function () {
        var bname = $("#inputBuilding01").val();
        var rtype = $("#inputRoom01").val();
        console.log("Selected Room Type (rtype):", rtype);
        console.log("Selected Building Name (bname):", bname);

        $.ajax({
            url: '../model/model.php',
            method: 'post',
            data: { bname: bname, rtype: rtype, fetchLLCs: 'true', }  // Using object notation
        }).done(function(llcs){
            console.log("Response from PHP:", llcs);
            try {
                // var parsedResponse = JSON.parse(response);
                // var llcs = parsedResponse.llcs || [];
                // var buildings = parsedResponse.buildings || [];

                llcs = JSON.parse(llcs);  // Check if JSON parsing is successful
                console.log("Parsed llcs:", llcs);
                $('#inputLLC01').empty();
                $('#inputLLC01').append('<option selected></option>');
                if (llcs.length > 0) {
                    llcs.forEach(function(llc) {
                        $('#inputLLC01').append('<option value="' + llc.name + '">' + llc.name + '</option>');
                    });
                } else {
                    $('#inputLLC01').append('<option disabled>No LLCs available</option>');
                }
                // Since building2 is dependent
                // $('#inputBuilding02').empty();
                // $('#inputBuilding02').append('<option selected disabled></option>');
                // buildings.forEach(function(building){
                //     $('#inputBuilding02').append('<option value="' + building.id + '">' + building.building_name + '</option>')
                // })

            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        });
    });
    // If second choice building dropdown receives input, populate the second choice room type dropdown
    $("#inputBuilding02").change(function (){
        var bname = $("#inputBuilding02").val();
        console.log(bname);
        $.ajax({
            url: '../model/model.php',
            method: 'post',
            data: {bname: bname, fetchRooms: 'true'}
        }).done(function(rooms){
            console.log("Response from PHP:", rooms);
            try {
                rooms = JSON.parse(rooms);
                console.log("Parsed rooms:", rooms);  // Check if JSON parsing is successful
                $('#inputRoom02').empty();
                $('#inputLLC02').empty();
                $('#inputRoom02').append('<option selected disabled></option>')
                rooms.forEach(function(room) {
                    $('#inputRoom02').append('<option value="' + room.type + '">' + room.type + '</option>');
                });
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        })
    })
    // If second choice room dropdown receives input, populate the second choice LLC dropdown and third choice building dropdown
    $("#inputRoom02").change(function () {
        var bname = $("#inputBuilding02").val();
        var rtype = $("#inputRoom02").val();
        console.log("Selected Room Type (rtype):", rtype);
        console.log("Selected Building Name (bname):", bname);

        $.ajax({
            url: '../model/model.php',
            method: 'post',
            data: { bname: bname, rtype: rtype, fetchLLCs: 'true', }  // Using object notation
        }).done(function(llcs){
            console.log("Response from PHP:", llcs);
            try {
                // var parsedResponse = JSON.parse(response);
                // var llcs = parsedResponse.llcs || [];
                // var buildings = parsedResponse.buildings || [];
                llcs = JSON.parse(llcs);  // Check if JSON parsing is successful
                console.log("Parsed llcs:", llcs);
                $('#inputLLC02').empty();
                $('#inputLLC02').append('<option selected></option>');
                if (llcs.length > 0) {
                    llcs.forEach(function(llc) {
                        $('#inputLLC02').append('<option value="' + llc.name + '">' + llc.name + '</option>');
                    });
                } else {
                    $('#inputLLC02').append('<option disabled>No LLCs available</option>');
                }
                // $('#inputBuilding03').append('<option selected disabled></option>');
                // buildings.forEach(function(building){
                //     $('#inputBuilding03').append('<option value="' + building.id + '">' + building.building_name + '</option>')
                // })

            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        });
    });
    // If third choice building dropdown receives input, populate the third choice room type dropdown
    $("#inputBuilding03").change(function (){
        var bname = $("#inputBuilding03").val();
        console.log(bname);
        $.ajax({
            url: '../model/model.php',
            method: 'post',
            data: {bname: bname, fetchRooms: 'true'}
        }).done(function(rooms){
            console.log("Response from PHP:", rooms);
            try {
                rooms = JSON.parse(rooms);
                console.log("Parsed rooms:", rooms);  // Check if JSON parsing is successful
                $('#inputRoom03').empty();
                $('#inputLLC03').empty();
                $('#inputRoom03').append('<option selected disabled></option>')
                rooms.forEach(function(room) {
                    $('#inputRoom03').append('<option value="' + room.type + '">' + room.type + '</option>');
                });
            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        })
    })
    // If the third choice room dropdown receives input, populate the third choice LLC dropdown
    $("#inputRoom03").change(function () {
        var bname = $("#inputBuilding03").val(); //changed from 02
        var rtype = $("#inputRoom03").val(); //changed from 02
        console.log("Selected Room Type (rtype):", rtype);
        console.log("Selected Building Name (bname):", bname);

        $.ajax({
            url: '../model/model.php',
            method: 'post',
            data: { bname: bname, rtype: rtype, fetchLLCs: 'true', }  // Using object notation
        }).done(function(llcs){
            console.log("Response from PHP:", llcs);
            try {
                llcs = JSON.parse(llcs)
                //llcs = JSON.parse(llcs);  // Check if JSON parsing is successful
                console.log("Parsed llcs:", llcs);
                $('#inputLLC03').empty();
                $('#inputLLC03').append('<option selected></option>');
                if (llcs.length > 0) {
                    llcs.forEach(function(llc) {
                        $('#inputLLC03').append('<option value="' + llc.name + '">' + llc.name + '</option>');
                    });
                } else {
                    $('#inputLLC03').append('<option disabled>No LLCs available</option>');
                }

            } catch (error) {
                console.error("Error parsing JSON:", error);
            }
        });
    });
})
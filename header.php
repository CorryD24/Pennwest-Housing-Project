<?php

//session_start();
/*
 * Here are some dummy values to use on the localhost.
 * You can set FirstName to null to test out the isset conditions for whether a user is logged in or not.
 *      -There are checks for this on the login button in the navbar, index.php, and restricted pages.
 * $roles can either be AG-ROLE-STAFF or AG-ROLE-STUDENT. We don't deal with AG-ROLE-FACULTY.
 *      -You will see checks on several pages to see if a user has the staff role. I didn't put
 *       a student check on the request and view my request pages, as it may be nice to allow
 *       the staff to view those easily (perhaps on the input manager page). I do believe they also have a student test account.
 *      -NOTE: We may have to account for -STUDENT and -STAFF at the same time in the future. Melanie mentioned
 *             GA's, and they may have both roles when they log in.
 */
//$roles = array('AG-ROLE-STUDENT');
$roles = array('AG-ROLE-STAFF'); // In the real SSO variables, Role is an array since a user may have more than one role
$_SESSION['Role'] = $roles;
$_SESSION['FirstName'] = "Nate";
//$_SESSION['FirstName'] = null;  // Use this to test out if you are not logged in
$_SESSION['LastName'] = "Kaltenbach";
$_SESSION['Email'] = 's_npkaltenba@pennwest.edu';
// These are the session variables for the SSO. These won't work unless on VCISPROD
// if (isset($_SESSION['samlUserdata'])) {
//     $attributes = $_SESSION['samlUserdata'];
//     $_SESSION['Role'] = $attributes["http://schemas.microsoft.com/ws/2008/06/identity/claims/role"] ?? [];
//     $_SESSION['FirstName'] = $attributes["http://schemas.xmlsoap.org/ws/2005/05/identity/claims/givenname"][0] ?? null;
//     $_SESSION['LastName'] = $attributes["http://schemas.xmlsoap.org/ws/2005/05/identity/claims/surname"][0] ?? null;
//     $_SESSION['Email'] = $attributes["http://schemas.xmlsoap.org/ws/2005/05/identity/claims/emailaddress"][0] ?? null;
//     $_SESSION['FullName'] = $attributes["http://schemas.microsoft.com/identity/claims/displayname"][0] ?? null;
// }
?>


<!DOCTYPE html>
<!--This is the header which will appear on each page-->
<html lang="en">



<head>
    <title>
        <?php echo $title; ?>
    </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/style.css?v=22">
    <script src="../js/main.js"></script>

    <link rel="shortcut icon" href="https://www.pennwest.edu/_resources/images/favicons/favicon.ico">
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-lg">
            <img class="navbar-brand" src="https://www.pennwest.edu/_resources/images/about/brand/stacked-pw.jpg" />
            <button class="navbar-toggler" style="background-color: white;" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!--First we have the link both admins and students can see-->
                    <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                            class="nav-link activeNav font14" style="color: white;"
                            href="../controller/controller.php?action=Home">Home</a></li>
                    <!--Now we have the ones for just students-->
                    <?php if (isset($_SESSION['Role']) && in_array('AG-ROLE-STUDENT', $_SESSION['Role'])) { //only shown to users with Student role ?>
                        <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                                class="nav-link font14" style="color: white;"
                                href="../controller/controller.php?action=About">About</a></li>
                        <!--Now we have the ones for just students-->
                        <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                                class="nav-link font14" style="color: white;"
                                href="../controller/controller.php?action=RoomChangeRequest">Room
                                Change Request Form</a></li>
                        <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                                class="nav-link font14" style="color: white;"
                                href="../controller/controller.php?action=RoomRequest">Room Request
                                Form</a></li>
                        <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                                class="nav-link font14" style="color: white;"
                                href="../controller/controller.php?action=ViewMyRequest">View My
                                Request</a>
                        </li>
                    </ul>
                <?php } ?>

                <!--Now we want to do the links only admins can see-->
                <?php if (isset($_SESSION['Role']) && in_array('AG-ROLE-STAFF', $_SESSION['Role'])) { //Only shown to users with a role of STAFF ?>
                    <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                            class="nav-link font14" style="color: white;"
                            href="../controller/controller.php?action=ManageRoomChangeRequests">Room Change Request
                            Manager</a>
                    </li>
                    <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                            class="nav-link font14" style="color: white;"
                            href="../controller/controller.php?action=ManageRoomRequests">Room
                            Request Manager</a>
                    </li>
                    <li class="nav-item navItemStyle border-end border-secondary-subtle navHeaderPad"><a
                            class="nav-link font14" style="color: white;"
                            href="../controller/controller.php?action=EmailManager">Email / Guide
                            Manager</a>
                    </li>
                    <li class="nav-item dropdown navItemStyle border-end border-secondary-subtle navHeaderPad">
                        <a class="nav-link dropdown-toggle font14" style="color: white;" href="#"
                            data-bs-toggle="dropdown">Form Input Manager</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item navItemStyle border-bottom border-secondary-subtle navPadL"><a
                                    class="nav-link font14" href="../controller/controller.php?action=InputManager">Manage
                                    Buildings/Room Types</a>
                            </li>
                            <li class="nav-item navItemStyle border-bottom border-secondary-subtle navPadL"><a
                                    class="nav-link font14"
                                    href="../controller/controller.php?action=LLCInputManager">Manage Housing
                                    Communities</a></li>
                            <li class="nav-item navItemStyle border-bottom border-secondary-subtle navPadL"><a
                                    class="nav-link font14" href="../controller/controller.php?action=AddBuilding">Add
                                    Buildings</a></li>
                            <li class="nav-item navItemStyle border-bottom border-secondary-subtle navPadL"><a
                                    class="nav-link font14" href="../controller/controller.php?action=AddRoomType">Add Room
                                    Types</a></li>
                            <li class="nav-item navItemStyle navPadL"><a class="nav-link font14"
                                    href="../controller/controller.php?action=AddLLC">Add Housing Communities</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown navItemStyle navHeaderPad">
                        <a class="nav-link dropdown-toggle font14" style="color: white;" href="#"
                            data-bs-toggle="dropdown">Student Links</a>
                        <ul class="dropdown-menu">
                            <li class="nav-item navItemStyle border-bottom border-secondary-subtle navPadL"><a
                                    class="nav-link font14" href="../controller/controller.php?action=About">About</a></li>
                            <li class="nav-item navItemStyle border-bottom border-secondary-subtle navPadL"><a
                                    class="nav-link navPadL font14"
                                    href="../controller/controller.php?action=RoomChangeRequest">Room Change Request
                                    Form</a></li>
                            <li class="nav-item navItemStyle border-bottom border-secondary-subtle navPadL"><a
                                    class="nav-link font14" href="../controller/controller.php?action=RoomRequest">Room
                                    Request Form</a></li>
                            <li class="nav-item navItemStyle navPadL"><a class="nav-link font14"
                                    href="../controller/controller.php?action=ViewMyRequest">View
                                    My Request</a></li>
                        </ul>
                    </li>
                    </ul>
                <?php } ?>
                <!--Login Button-->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item navItemStyle" <?php if (isset($_SESSION['FirstName'])) {
                        echo "hidden";
                    } ?>>
                        <a class="nav-link font14" style="color: white;"
                            href="../security/php-saml-master/demo1/index.php?sso">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
<!--This displays the notification_email.txt file using php rather than plaintext-->
<?php
$contents = file_get_contents('../datafiles/notification_email.txt');
echo nl2br(htmlspecialchars($contents));
?>

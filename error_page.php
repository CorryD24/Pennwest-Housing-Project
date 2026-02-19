<?php
//This is the error page it display errors if one occurs
$title = "Error Page";
require_once '../view/header.php'; //THis requires the header

?>

<!--Error Message-->
<div class="container-lg" style="padding-top: 2%">
    <div class="row">
        <div class="col-lg-12">
            <h4><?php echo $errorMessage; ?></h4>
        </div>
    </div>
</div>
<!--Class could be whatever style is used for other similar content on the site or its own-->

<?php
require_once '../view/footer.php'; //This requires the footer
?>
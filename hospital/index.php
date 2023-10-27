<?php 
include_once('../templates/header.php');
include_once('../includes/main.functions.inc.php');

isLogged("hospital");

?>
<section>
    <div class="container">
        <button type="button" class="btn btn-primary">Add Sample</button>
        <button type="button" class="btn btn-danger">Logout</button>
    </div>
</section>
<?php include_once('../templates/footer.php') ?>
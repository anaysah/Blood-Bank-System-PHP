<?php include_once('../templates/header.php') ?>
<link rel="stylesheet" href="../styles/auth.css">
<section>
    <div class="container col-md-4">
        <h2 class="mt-5"><center>Login</center></h2>
        <form action="../../includes/login.inc.php" method="POST">
            <div id="emailHelp" class="form-text mt-4"><center><strong>How you want to login</strong></center></div>
            <div class="row mb-2">
                
                <div class="col-md-6 d-flex justify-content-center">
                    <input class="form-check-input" type="radio" name="userType" id="flexRadioDefault1" value="receiver" checked>
                    <label class="mx-2" for="flexRadioDefault1">
                        Receiver
                    </label>
                </div>
                <div class="col-md-6 d-flex justify-content-center">
                    <input class="form-check-input" type="radio" name="userType" id="flexRadioDefault2" value="hospital">
                    <label class="mx-2" for="flexRadioDefault2">
                        Hospital
                    </label>
                </div>
            </div>
            <div class="mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" >
            </div>
            <div class="mb-2">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Submit</button>
        </form>
    </div>
</section>
<?php include_once('../templates/footer.php') ?>
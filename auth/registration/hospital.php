<?php include_once('../../templates/header.php') ?>
<section>
    <div class="container">
        <h2 class="mt-5">Hospital Registration</h2>
        <form action="../../includes/registration.inc.php" method="POST">
            <input type="hidden" name="userType" value="hospital">
            <div class="mb-2">
                <label for="hospitalName">Hospital Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-2">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="row">
                <div class="mb-2 col-md-6">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="mb-2 col-md-6">
                    <label for="password">Re Password</label>
                    <input type="password" class="form-control" id="repassword" name="repassword" required>
                </div>
            </div>
            <div class="mb-2">
                <label for="address">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="row">
                <div class="mb-2 col-md-4">
                    <label for="city">City</label>
                    <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="mb-2 col-md-4">
                    <label for="state">State</label>
                    <input type="text" class="form-control" id="state" name="state" required>
                </div>
                <div class="mb-2 col-md-4">
                    <label for="postalCode">Postal Code</label>
                    <input type="number" class="form-control" id="postalCode" name="postalCode" required>
                </div>
            </div>
            <div class="mb-2">
                <label for="phoneNumber">Phone Number</label>
                <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </form>
    </div>
</section>
<?php include_once('../../templates/footer.php') ?>
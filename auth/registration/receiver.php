<?php include_once('../../templates/header.php') ?>
<section>
    <div class="container">
        <h2 class="mt-5">Receiver Registration</h2>
        <form action="../../includes/registration.inc.php" method="POST">
            <input type="hidden" name="userType" value="receiver">
            <div class="mb-2">
                <label for="name">Receiver Name</label>
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
            <div class="row">
                <div class="mb-2 col-md-4">
                    <label for="phoneNumber">Phone Number</label>
                    <input type="tel" class="form-control" id="phoneNumber" name="phoneNumber" required>
                </div>
                <div class="mb-2 col-md-2">
                    <label for="inputState" >Blood Group</label>
                    <select id="inputState" class="form-select" name="blood_group">
                        <?php
                        // Define an array of blood groups
                        $bloodGroups = array('A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-');

                        // Loop through the array and generate options
                        foreach ($bloodGroups as $group) {
                            echo "<option value='$group'>$group</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Register</button>
        </form>
    </div>
</section>
<?php include_once('../../templates/footer.php') ?>
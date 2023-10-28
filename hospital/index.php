<?php
include_once('../templates/header.php');
include_once('../includes/main.functions.inc.php');

isLogged("hospital");
require_once('../includes/dbh.inc.php');

// Get all the sample from the hospital which is currently loged in
$sql = "SELECT id, blood_group, quantity_in_ml, collected_on, expiration_date FROM blood_samples WHERE hospital_id = ?";
$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
}
$notExpiredSamples = array();
$expiredSamples = array();

while ($row = mysqli_fetch_assoc($result)) {
    $currentDate = new DateTime();
    $expirationDate = new DateTime($row['expiration_date']);

    if ($expirationDate >= $currentDate) {
        $notExpiredSamples[] = $row;
    } else {
        $expiredSamples[] = $row;
    }
}

?>
<section class="container">
    <div class="row">
        <div class="col-md-4">
            <form action="../includes/addBloodSample.inc.php" method="post"
                class="border border-primary-subtle rounded p-3">
                <div class="row mb-2">
                    <div class="col-md-12">
                        <label for="inputState">Blood Group</label>
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
                <div class="row mb-2 gx-2">
                    <div class="col-md-7">
                        <label for="collectedOn">Collection Date:</label>
                        <input type="date" class="form-control" id="collectedOn" name="collectedOn"
                            onchange="disableExpirationDays()" required>
                    </div>
                    <div class="col-md-5">
                        <label for="quantity">Quantity(ml)</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" required>
                    </div>

                </div>
                <div class="row mb-2 gx-2">
                    <div class="col-md-8">
                        <label for="expirationDate">Expiration Date</label>
                        <input type="date" class="form-control" id="expirationDate" name="expirationDate"
                            onchange="disableExpirationDays()">
                    </div>
                    <div class="col-md-4">
                        <label for="expirationDays">or Days:</label>
                        <input type="number" class="form-control" id="expirationDays" name="expirationDays"
                            onchange="disableExpirationDate()">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-sm" name="submit">Add Sample</button>
            </form>
        </div>
        <div class="all-samples-box col">
            <h2>
                <center>Availble Blood Samples</center>
            </h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Blood Group</th>
                        <th scope="col">Quantity(ml)</th>
                        <th scope="col">Collected On</th>
                        <th scope="col">Expiration date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $count = 1;
                        foreach ($notExpiredSamples as $row) {
                            ?>
                            <tr>
                                <th scope="row"><?= $count++ ?></th>
                                <td><?= $row['blood_group'] ?></td>
                                <td><?= $row['quantity_in_ml'] ?></td>
                                <td><?= date("F j, Y", strtotime($row['collected_on'])) ?></td>
                                <td><?= date("F j, Y", strtotime($row['expiration_date'])) ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        
            <h2>
                <center>Expired Blood Samples</center>
            </h2>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Blood Group</th>
                        <th scope="col">Quantity(ml)</th>
                        <th scope="col">Collected On</th>
                        <th scope="col">Expiration date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $count = 1;
                        foreach ($expiredSamples as $row) {
                            ?>
                            <tr>
                                <th scope="row"><?= $count++ ?></th>
                                <td><?= $row['blood_group'] ?></td>
                                <td><?= $row['quantity_in_ml'] ?></td>
                                <td><?= date("F j, Y", strtotime($row['collected_on'])) ?></td>
                                <td><?= date("F j, Y", strtotime($row['expiration_date'])) ?></td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
            </div>
    </div>
</section>
<script>
    const expirationDateInput = document.getElementById("expirationDate");
    const collectedOnInput = document.getElementById("collectedOn");
    const expirationDaysInput = document.getElementById("expirationDays");

    function disableExpirationDays() {
        if (expirationDateInput.value && collectedOnInput.value) {
            const expirationDate = new Date(expirationDateInput.value);
            const collectedOnDate = new Date(collectedOnInput.value);

            const timeDifference = expirationDate - collectedOnDate;
            const daysDifference = Math.ceil(timeDifference / (1000 * 3600 * 24));

            expirationDaysInput.value = daysDifference;
        } else {
            expirationDaysInput.value = "";
        }
    }

    function disableExpirationDate() {
        if (expirationDaysInput.value && collectedOnInput.value) {
            const collectedOnDate = new Date(collectedOnInput.value);
            const expirationDays = parseInt(expirationDaysInput.value);

            const expirationDate = new Date(collectedOnDate);
            expirationDate.setDate(collectedOnDate.getDate() + expirationDays);

            const year = expirationDate.getFullYear();
            const month = (expirationDate.getMonth() + 1).toString().padStart(2, '0');
            const day = expirationDate.getDate().toString().padStart(2, '0');

            expirationDateInput.value = `${year}-${month}-${day}`;
        } else {
            expirationDateInput.value = "";
        }
    }
</script>
<?php include_once('../templates/footer.php') ?>
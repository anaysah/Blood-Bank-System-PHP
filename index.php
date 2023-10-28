<?php
include_once('templates/header.php');
include_once('includes/main.functions.inc.php');
require_once('includes/dbh.inc.php');

// Get all the sample from the hospital which is currently loged in
$sql = "SELECT bs.id, bs.blood_group, bs.quantity_in_ml, bs.collected_on, bs.expiration_date, h.name AS hospital_name
        FROM blood_samples AS bs
        INNER JOIN hospital AS h ON bs.hospital_id = h.id";

$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    // mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
}

$notExpiredSamples = array();
while ($row = mysqli_fetch_assoc($result)) {
    $currentDate = new DateTime();
    $expirationDate = new DateTime($row['expiration_date']);

    if ($expirationDate >= $currentDate) {
        $notExpiredSamples[] = $row;
    }
}

//
function getBloodGroup($conn, $id)
{
    $sql = "SELECT blood_group FROM receiver WHERE id = ?";
    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        // Check if a row is returned
        if ($row = mysqli_fetch_assoc($result)) {
            return $row['blood_group'];
        }
    }
}

if (isset($_SESSION['userType']) && $_SESSION['userType'] === 'receiver') {
    $userBloodGroup = getBloodGroup($conn, $_SESSION['id']);
}

// Close the database connection
mysqli_close($conn);
?>
<link rel="stylesheet" href="styles/index.css">
<section class="container">
    <h2>
        <center>Available Blood Samples</center>
    </h2>
    <div class="row gx-3 gy-2 mt-3">
        <?php foreach ($notExpiredSamples as $row): ?>
            <div class="col-md-3 col-sm-4">
                <div class="card">
                    <?php
                    if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'receiver'): ?>
                        <h6 class="card-header">
                            <?php if ($userBloodGroup === $row['blood_group']): ?>
                                <small>Eligible</small>
                            <?php else: ?>
                                <small>Not Eligible</small>
                            <?php endif; ?>
                        </h6>
                    <?php endif; ?>
                    <div class="card-body">
                        <h4 class="card-title">
                            <?= $row['blood_group'] ?>
                        </h4>
                        <p class="card-text">
                            <?= $row['hospital_name'] ?>
                        </p>
                        <form action="includes/requestSample.inc.php" method="post">
                            <input type="hidden" name="sample_id" value="<?= $row['id'] ?>">
                            <?php
                            if (isset($_SESSION['userType']) && $_SESSION['userType'] == 'receiver' && $userBloodGroup !== $row['blood_group']): ?>
                                <button type="submit" name="submit" class="btn btn-primary btn-sm" disabled>Request</button>
                            <?php else: ?>
                                <button type="submit" name="submit" class="btn btn-primary btn-sm">Request</button>
                            <?php endif; ?>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

</section>
<?php include_once('templates/footer.php') ?>
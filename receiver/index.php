<?php 
include_once('../templates/header.php');
include_once('../includes/main.functions.inc.php');

isLogged("receiver");

require_once('../includes/dbh.inc.php');

// Get all the sample from the hospital which is currently loged in
$sql = "SELECT b.blood_group, h.name
FROM request r
INNER JOIN blood_samples b ON r.sample_id = b.id
INNER JOIN hospital h ON b.hospital_id = h.id
WHERE r.receiver_id = ?;
";

$stmt = mysqli_stmt_init($conn);

if (mysqli_stmt_prepare($stmt, $sql)) {
    mysqli_stmt_bind_param($stmt, "i", $_SESSION['id']);
    mysqli_stmt_execute($stmt);

    $result = mysqli_stmt_get_result($stmt);
}

?>
<section>
    <div class="container">
        <h3>Your Requests</h3>
        <div class="row gx-3 gy-2 mt-3">
        <?php foreach ($result as $row): ?>
            <div class="col-md-3 col-sm-4">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">
                            <?= $row['blood_group'] ?>
                        </h4>
                        <p class="card-text">
                            <?= $row['name'] ?>
                        </p>
                        
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
    </div>
</section>
<?php include_once('../templates/footer.php') ?>
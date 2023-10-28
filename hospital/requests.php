<?php
include_once('../templates/header.php');
include_once('../includes/main.functions.inc.php');

isLogged("hospital");
require_once('../includes/dbh.inc.php');


function getRequestsForHospital($conn, $hospitalId)
{
    // Prepare a SQL query to retrieve requests for a specific hospital
    $sql = "SELECT r.name,r.email, r.blood_group, r.address, r.city, r.state, r.postal_code, r.phone_number
    FROM receiver r
    INNER JOIN request req ON r.id = req.receiver_id
    INNER JOIN blood_samples bs ON req.sample_id = bs.id
    WHERE bs.hospital_id = ?;
    ";

    $stmt = mysqli_stmt_init($conn);

    if (mysqli_stmt_prepare($stmt, $sql)) {
        mysqli_stmt_bind_param($stmt, "i", $hospitalId);
        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);

        $requests = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $requests[] = $row;
        }

        return $requests;
    } else {
        return false;
    }
}

$requestsData = getRequestsForHospital($conn, $_SESSION['id']);
?>

<section class="container">
    <div class="row g-2">
        <?php
        foreach ($requestsData as $row): ?>
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <?=$row['blood_group']?>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title"><?=$row['name']?></h5>
                        <p class="card-text">Address: <?=$row['address']?>, <?=$row['city']?>, <?=$row['state']?>, <?=$row['postal_code']?></p>
                    </div>
                    <div class="card-footer">
                        <div class="d-flex justify-content-between">
                            <div><?=$row['email']?></div>
                            <div><?=$row['phone_number']?></div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>
<?php include_once('../templates/footer.php') ?>
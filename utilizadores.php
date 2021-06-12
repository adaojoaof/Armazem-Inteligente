<?php
$pageTitle = "Utilizadores";
$activePage = "utilizadores";

include("database-config.php");

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT name,username,rule,rfid_card_id FROM `users` ORDER BY `users`.`name` ASC";
$resultUsers = $conn->query($sql);
$conn->close();
?>

<?php include "header.php"; ?>

<div class="row">
    <div class="col-12">
        <div class="card-stats card">
            <form action="definicoes.php" method="post">
                <div class="card-header">
                    <h4 class="card-title">Utilizadores</h4>
                    <p class="card-category">Gestão de utilizadores e seus privilégios</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                    <th>Privilégio</th>
                                    <th>Card ID</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    if ($resultUsers->num_rows > 0) {
                                        // output data of each row
                                        while($row = $resultUsers->fetch_assoc()) {?>
                                            <tr>
                                                <td><?= $row["name"]; ?></td>
                                                <td><?= $row["username"]; ?></td>
                                                <td>**********</td>
                                                <td><?= $row["rule"]; ?></td>
                                                <td><?= $row["rfid_card_id"]!=''?$row["rfid_card_id"]:"-"; ?></td>
                                                <td><button type="button" class="btn btn-primary">Editar</button></td>
                                            </tr>
                                        <?php
                                        }
                                    } else {
                                        echo "0 results";
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
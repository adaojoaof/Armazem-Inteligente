<?php

$pageTitle = "Utilizadores";
$activePage = "utilizadores";
$rules=['admin'];

//carrega as confiurações da base de dados
include("database-config.php");

// conecta
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

//vai buscar todos os users e seus dados
$sql = "SELECT name,username,rule,rfid_card_id FROM `users` ORDER BY `users`.`name` ASC";
$resultUsers = $conn->query($sql);
$conn->close();
?>

<?php include "header.php"; ?>

<div class="row">
    <div class="col-12">
        <div class="card-stats card">
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if ($resultUsers->num_rows > 0) {
                                    // só mostra os users se houverem na BD
                                    while($row = $resultUsers->fetch_assoc()) {?>
                                        <tr>
                                            <td><?= $row["name"]; ?></td>
                                            <td><?= $row["username"]; ?></td>
                                            <td>**********</td>
                                            <td><?= $row["rule"]; ?></td>
                                            <td><?= $row["rfid_card_id"]!=''?$row["rfid_card_id"]:"-"; ?></td>
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
        </div>
    </div>
</div>

<?php include "footer.php"; ?>
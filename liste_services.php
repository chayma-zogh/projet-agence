<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agence_voyage";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$services = $conn->query("SELECT * FROM services");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Services</title>
    <link rel="stylesheet" href="espace_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="mainbox">
        <input type="checkbox" id="check">
        <label for="check" class="btn_1"><i class="fas fa-bars"></i></label>

        <div class="sidebarmenu">
            <div class="logo"><a href="#">Admin Panel</a></div>
            <label for="check" class="btn_2"><i class="fas fa-times"></i></label>
            <ul class="lista">
                <li><a href="index.php"><i class="fas fa-home"></i>Accueil</a></li>
                <li><a href="liste_services.php" class="active"><i class="fas fa-concierge-bell"></i>Voir Services</a></li>
                <li><a href="html.html"><i class="fas fa-tags"></i>Offres</a></li>
                <li><a href="espace_admin.php"><i class="fas fa-cogs"></i>Retour Admin</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h1>Liste des Services</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Description</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($services->num_rows > 0): ?>
                    <?php while($row = $services->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]) ?></td>
                            <td><?= htmlspecialchars($row["nom"]) ?></td>
                            <td><?= htmlspecialchars($row["description"]) ?></td>
                            <td><img src="<?= $row["image"] ?>" alt="image" width="100"></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">Aucun service trouvé.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php $conn->close(); ?>
</body>
</html>


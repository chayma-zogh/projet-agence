<?php
// Connexion à la base de données
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agence_voyage";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$sql = "SELECT id, nom, email, mot_de_passe FROM utilisateurs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Utilisateurs</title>
    <link rel="stylesheet" href="slidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>

    <!-- Menubar -->
    <input type="checkbox" id="check">

    <label for="check" class="btn_1">
        <i class="fas fa-bars"></i>
    </label>

    <div class="sidebarmenu">
        <label for="check" class="btn_2">
            <i class="fas fa-times"></i>
        </label>
        <div class="logo">
            <a href="#">AdminPanel</a>
        </div>
        <ul class="lista">
            <li><a href="espace_admin.php"><i class="fas fa-home"></i> Accueil Admin</a></li>
            <li><a href="liste_utilisateurs.php"><i class="fas fa-users"></i> Utilisateurs</a></li>
            <li><a href="liste_services.php"><i class="fas fa-concierge-bell"></i> Services</a></li>
            <li><a href="liste_offres.php"><i class="fas fa-tags"></i> Offres</a></li>
        </ul>
        <ul class="socialmedia">
            <li><i class="fab fa-facebook"></i></li>
            <li><i class="fab fa-twitter"></i></li>
        </ul>
    </div>

    <!-- Contenu -->
    <div class="content">
        <h1>Liste des utilisateurs</h1>
        <table border="1" cellpadding="10" cellspacing="0">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Mot de passe</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]) ?></td>
                            <td><?= htmlspecialchars($row["nom"]) ?></td>
                            <td><?= htmlspecialchars($row["email"]) ?></td>
                            <td><?= htmlspecialchars($row["mot_de_passe"]) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">Aucun utilisateur trouvé.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php $conn->close(); ?>
</body>
</html>





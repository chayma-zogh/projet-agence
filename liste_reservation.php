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

// Assurez-vous que l'utilisateur est connecté et récupérez son ID
$user_id = 1;  // Remplacez par l'ID de l'utilisateur connecté

$sql = "SELECT * FROM reservations WHERE user_id = '$user_id'";  // Récupère toutes les réservations de l'utilisateur
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mes Réservations</title>
    <link rel="stylesheet" href="slidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
            <a href="#">Espace Client</a>
        </div>
        <ul class="lista">
            <li><a href="espace_utilisateur.php"><i class="fas fa-home"></i> Accueil</a></li>
            <li><a href="offres.php"><i class="fas fa-tags"></i> Offres</a></li>
            <li><a href="serv.php"><i class="fas fa-sliders-h"></i> Services</a></li>
            <li><a href="reservation.php"><i class="fas fa-calendar-check"></i> Mes Réservations</a></li>
            <li><a href="contact.html"><i class="fas fa-phone"></i> Contact</a></li>
        </ul>
        <ul class="socialmedia">
            <li><i class="fab fa-facebook"></i></li>
            <li><i class="fab fa-twitter"></i></li>
        </ul>
    </div>

    <!-- Contenu -->
    <div class="content">
        <h1>Mes Réservations</h1>

        <?php if ($result->num_rows > 0): ?>
            <table border="1" cellpadding="10" cellspacing="0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Destination</th>
                        <th>Date de départ</th>
                        <th>Nombre de personnes</th>
                        <th>Date de réservation</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]) ?></td>
                            <td><?= htmlspecialchars($row["destination"]) ?></td>
                            <td><?= htmlspecialchars($row["date_depart"]) ?></td>
                            <td><?= htmlspecialchars($row["nb_personnes"]) ?></td>
                            <td><?= htmlspecialchars($row["date_reservation"]) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucune réservation trouvée.</p>
        <?php endif; ?>

    </div>

    <?php $conn->close(); ?>

</body>
</html>

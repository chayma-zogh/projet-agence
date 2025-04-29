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

// Traitement de la réservation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'reserver') {
    // Récupérer les informations de réservation
    $destination = $conn->real_escape_string($_POST['destination']);
    $date = $conn->real_escape_string($_POST['date']);
    $nb_personnes = (int) $_POST['nb_personnes'];
    $user_id = 1;  // Exemple d'ID utilisateur, à remplacer par l'ID de l'utilisateur connecté

    // Insérer la réservation dans la base de données
    $sql = "INSERT INTO reservations (user_id, destination, date_depart, nb_personnes) VALUES ('$user_id', '$destination', '$date', '$nb_personnes')";

    if ($conn->query($sql) === TRUE) {
        $reservation_message = "Réservation effectuée avec succès.";
    } else {
        $reservation_message = "Erreur lors de la réservation : " . $conn->error;
    }
}

// Traitement de l'annulation
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action']) && $_POST['action'] == 'annuler') {
    // Récupérer l'ID de la réservation
    $id_reservation = $conn->real_escape_string($_POST['id_reservation']);

    // Préparer la requête de suppression
    $sql = "DELETE FROM reservations WHERE id = '$id_reservation'";

    if ($conn->query($sql) === TRUE) {
        $annulation_message = "Réservation annulée avec succès.";
    } else {
        $annulation_message = "Erreur lors de l'annulation : " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Utilisateur</title>
    <link rel="stylesheet" href="espace_utilisateur.css"> <!-- ta menubar CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="mainbox">
        <input type="checkbox" id="check">
        
        <!-- Menu hamburger -->
        <label for="check" class="btn_1">
            <i class="fas fa-bars"></i>
        </label>

        <!-- Sidebar -->
        <div class="sidebarmenu">
            <div class="logo">
                <a href="#">Espace Client</a>
            </div>

            <!-- Fermeture -->
            <label for="check" class="btn_2">
                <i class="fas fa-times"></i>
            </label>

            <ul class="lista">
                <li><a href="index.html"><i class="fas fa-home"></i>Accueil</a></li>
                <li><a href="offres.php"><i class="fas fa-tags"></i>Offres</a></li>
                <li><a href="serv.php"><i class="fas fa-sliders-h"></i>Services</a></li>
                <li><a href="liste_reservation.php"><i class="fas fa-calendar-plus"></i>Mes Réservations</a></li>
                <li><a href="contact.html"><i class="fas fa-phone"></i>Contact</a></li>
            </ul>

            <div class="socialmedia">
                <ul>
                    <li><i class="fab fa-facebook"></i></li>
                    <li><i class="fab fa-twitter"></i></li>
                    <li><i class="fab fa-instagram"></i></li>
                    <li><i class="fab fa-youtube"></i></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="content">
        <h1>Bienvenue sur votre espace</h1>
        <p>Réservez ou annulez vos voyages ici.</p>

        <!-- Message après action -->
        <?php if (isset($reservation_message)) { echo "<p>$reservation_message</p>"; } ?>
        <?php if (isset($annulation_message)) { echo "<p>$annulation_message</p>"; } ?>

        <!-- Formulaire de réservation -->
        <section>
            <h2>Faire une réservation</h2>
            <form action="espace_utilisateur.php" method="POST">
                <input type="hidden" name="action" value="reserver">

                <label for="destination">Destination</label>
                <input type="text" id="destination" name="destination" required>

                <label for="date">Date de départ</label>
                <input type="date" id="date" name="date" required>

                <label for="nb_personnes">Nombre de personnes</label>
                <input type="number" id="nb_personnes" name="nb_personnes" min="1" required>

                <button type="submit">Réserver</button>
            </form>
        </section>

        <!-- Annulation -->
        <section>
            <h2>Annuler une réservation</h2>
            <form action="espace_utilisateur.php" method="POST">
                <input type="hidden" name="action" value="annuler">

                <label for="id_reservation">ID de la réservation</label>
                <input type="text" id="id_reservation" name="id_reservation" required>

                <button type="submit" onclick="return confirm('Confirmer l\'annulation ?')">Annuler</button>
            </form>
        </section>
    </div>
</body>
</html>

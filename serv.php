<?php
// Connexion à la base de données
$servername = "localhost";  // Modifiez en fonction de votre configuration
$username = "root";         // Votre nom d'utilisateur
$password = "";             // Votre mot de passe
$dbname = "agence_voyage";  // Le nom de votre base de données

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $etoile = isset($_POST["nbr"]) ? $_POST["nbr"] : "Non précisé";
    $package = isset($_POST["res"]) ? $_POST["res"] : "Non précisé";
    $nom = isset($_POST["nom"]) ? htmlspecialchars($_POST["nom"]) : "Anonyme";
    $avis = isset($_POST["avis"]) ? htmlspecialchars($_POST["avis"]) : "Aucun avis";
    $suggestions = isset($_POST["suggestions"]) ? htmlspecialchars($_POST["suggestions"]) : "Aucune suggestion";

    echo "<div class='message-thank-you'>";
    echo "<h2>Merci pour votre retour, $nom !</h2>";
    echo "<p><strong>Hôtel choisi :</strong> $etoile étoiles</p>";
    echo "<p><strong>Type de voyage :</strong> $package</p>";
    echo "<p><strong>Votre avis :</strong><br>$avis</p>";
    echo "<p><strong>Suggestions :</strong><br>$suggestions</p>";
    echo "</div>";
}

// Récupérer les services de la base de données
$sql = "SELECT * FROM services";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Services</title>
    <link rel="stylesheet" href="projet dev.css">
    <link rel="stylesheet" href="projet dev 1.css">
    <style>
        .message-thank-you {
            background-color: #f0f0f0;
            border: 2px solid #ccc;
            padding: 20px;
            margin: 20px;
            border-radius: 8px;
        }

        .message-thank-you h2 {
            color: #f54764;
            font-size: 1.5em;
            text-align: center;
        }

        .message-thank-you p {
            font-size: 1.1em;
            margin: 10px 0;
        }

        form p {
            margin-bottom: 10px;
        }

        form input[type="text"], form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        form input[type="radio"] {
            margin-right: 10px;
        }

        .img-container img {
            max-width: 100%;
            height: auto;
            margin-bottom: 10px;
            
        }
        
    </style>
</head>
<body>
    <p style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; color: rgb(245, 71, 100);"><strong>Services :</strong></p>
    
    <form method="POST">
        <p style="font-family: Georgia, 'Times New Roman', Times, serif;"><strong>Hôtellerie : </strong></p>
        <input type="radio" name="nbr" value="5"> 5 étoiles <br>
        <div class="img-container">
            <img src="Capture d'écran 2025-02-17 223133.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223209.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223524.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223242.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223421.png" width="400" height="300">
        </div><br>

        <input type="radio" name="nbr" value="4" checked> 4 étoiles <br>
        <div class="img-container">
            <img src="Capture d'écran 2025-02-17 224118.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223440.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223553.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223831.png" width="400" height="300">
        </div><br>

        <input type="radio" name="nbr" value="3"> 3 étoiles <br>
        <div class="img-container">
            <img src="Capture d'écran 2025-02-17 223915.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223321.png" width="400" height="300">
            <img src="Capture d'écran 2025-02-17 223524.png" width="400" height="300">
        </div><br>
        <h3>Autres activités:</h3>
        <div class="img-container">
    <?php
    // Affichage des services sous forme d'images, récupérés de la base de données
    $result->data_seek(0); // Réinitialiser le pointeur
    while ($row = $result->fetch_assoc()) {
        echo "<div>";
        echo "<h4>" . $row['nom'] . "</h4>";
        echo "<p>" . $row['description'] . "</p>";  // Affichage de la description
        echo "<img src='" . $row['image'] . "' width='400' height='300'></div><br>";
    }
    ?>
</div>

        <p style="font-family:Impact, Haettenschweiler, 'Arial Narrow Bold', sans-serif;"><strong>Package : </strong></p>
        <input type="radio" name="res" value="Leisure Travel"> Leisure Travel <br>
        <input type="radio" name="res" value="Adventure Travel"> Adventure Travel <br>
        <input type="radio" name="res" value="Cultural Travel"> Cultural Travel <br>
        <input type="radio" name="res" value="Eco-tourism"> Eco-tourism <br>
        <input type="radio" name="res" value="Business Travel"> Business Travel <br>
        <input type="radio" name="res" value="Backpacking"> Backpacking <br>
        <input type="radio" name="res" value="Solo Travel"> Solo Travel <br>
        <input type="radio" name="res" value="Road Trips"> Road Trips <br>
        <input type="radio" name="res" value="Cruise Travel"> Cruise Travel <br>
        <input type="radio" name="res" value="Volunteer Travel"> Volunteer Travel <br>
        <input type="radio" name="res" value="Family Travel"> Family Travel <br>
        <input type="radio" name="res" value="Luxury Travel"> Luxury Travel <br>
        <input type="radio" name="res" value="Health and Wellness"> Health and Wellness Travel <br>
        <input type="radio" name="res" value="Digital Nomad"> Digital Nomad travel <br><br>
    </form>
</body>
</html>

<?php
// Fermeture de la connexion à la base de données
$conn->close();
?>



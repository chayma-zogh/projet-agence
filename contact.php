<?php
// Configuration de la base de données
$host = 'localhost';
$dbname = 'agence_voyage'; // Remplacez par le nom de votre base de données
$username = 'root';
$password = ''; // Par défaut sous XAMPP, le mot de passe est vide

// Variable pour afficher le message de succès
$successMessage = '';

try {
    // Connexion à la base de données avec PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Vérification si le formulaire a été soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $message = htmlspecialchars($_POST['message']);

        // Préparer la requête d'insertion
        $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, message) VALUES (:name, :email, :message)");

        // Exécuter la requête avec les données
        $stmt->execute([':name' => $name, ':email' => $email, ':message' => $message]);

        // Message de succès
        $successMessage = 'Votre message a été envoyé avec succès !';
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact - GOMondo</title>
    <link rel="stylesheet" href="contact.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>

    <style>
        /* Style de la notification */
        .notification {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: #4CAF50;
            color: white;
            padding: 20px 40px;
            border-radius: 5px;
            font-size: 18px;
            display: none;
            z-index: 1000;
            text-align: center;
        }
        /* Styles pour le Slidebar */
input[type="checkbox"] {
    display: none;
}

.btn_1 {
    font-size: 30px;
    cursor: pointer;
    position: absolute;
    top: 20px;
    left: 20px;
    z-index: 1000;
}

.sidebarmenu {
    position: fixed;
    top: 0;
    left: -250px;
    height: 100%;
    width: 250px;
    background-color:#FF914D;
    transition: 0.3s;
    z-index: 999;
    padding-top: 60px;
}

.sidebarmenu .logo {
    color: white;
    font-size: 24px;
    text-align: center;
    margin-bottom: 20px;
}

.sidebarmenu .btn_2 {
    font-size: 30px;
    color: white;
    position: absolute;
    top: 20px;
    right: 20px;
    cursor: pointer;
}

.sidebarmenu .lista {
    list-style: none;
    padding: 0;
}

.sidebarmenu .lista li {
    padding: 15px;
    text-align: center;
}

.sidebarmenu .lista li a {
    color: white;
    text-decoration: none;
    font-size: 18px;
    display: block;
}

.sidebarmenu .lista li a:hover {
    background-color: #575757;
}

#check:checked ~ .sidebarmenu {
    left: 0;
}

#check:checked ~ .sidebarmenu .btn_1 {
    display: none;
}

    </style>
</head>
<body>

<header class="contact-header">
    <h1>Contactez-nous</h1>
</header>

<main class="contact-container">
    <section class="contact-info">
        <h2>Nos coordonnées</h2>
        <p><strong>📍 Adresse :</strong> Tunis - Centre Urbain</p>
        <p><strong>📞 Téléphone :</strong> 77 98 65 98</p>
        <p><strong>📧 Email :</strong> GOMondo-agence@gmail.com</p>
    </section>

    <section class="contact-form">
        <h2>Envoyez-nous un message</h2>
        <form action="contact.php" method="post">
            <label for="name">Nom :</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email :</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Message :</label>
            <textarea id="message" name="message" required></textarea>

            <button type="submit">Envoyer</button>
        </form>
    </section>
    <input type="checkbox" id="check">
<label for="check" class="btn_1"><i class="fas fa-bars"></i></label>

<div class="sidebarmenu">
    <div class="logo"><a href="#"> Panel</a></div>
    <label for="check" class="btn_2"><i class="fas fa-times"></i></label>
    <ul class="lista">
        <li><a href="index.php">HOME</a></li>
        <li><a href="proj.html">À propos de nous</a></li>
        <li><a href="locaux.html">Nos locaux</a></li>
        <li><a href="offre.php">Nos offres</a></li>
        <li><a href="serv.php">Services</a></li>
        <li><a href="contact.php">Contact</a></li>
    </ul>
</div>



    <!-- Affichage du message de succès -->
    <?php if (!empty($successMessage)): ?>
        <div id="notification" class="notification"><?php echo $successMessage; ?></div>
    <?php endif; ?>
    <a href="feedback.html" class="btn-feedback">Donner un avis</a>
</main>

<footer>
    <p>Suivez-nous sur:</p>
    <div class="social-icons">
        <a href="#"><img src="insta.jpg" alt="Instagram"></a>
        <a href="#"><img src="fb.jpg" alt="Facebook"></a>
        <a href="#"><img src="tiktok.png" alt="TikTok"></a>
    </div>
    <p>&copy; 2025 GOMondo. Tous droits réservés.</p>
</footer>

<script>
    // Afficher la notification si le message de succès existe
    window.onload = function() {
        const successMessage = "<?php echo $successMessage; ?>";
        if (successMessage) {
            const notification = document.getElementById("notification");
            notification.style.display = "block"; // Afficher la notification
            setTimeout(function() {
                notification.style.display = "none"; // Cacher la notification après 5 secondes
            }, 5000);
        }
    }
</script>

</body>
</html>



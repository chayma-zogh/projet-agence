<?php
// Traitement du formulaire
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=localhost;dbname=agence_voyage", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode d'erreur pour mieux gérer les exceptions

        $nom = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Requête préparée pour vérifier si l'utilisateur existe
        $sql = "SELECT * FROM utilisateurs WHERE email = :email AND mot_de_passe = :mot_de_passe";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $password);

        // Exécution de la requête
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // L'utilisateur est trouvé, rediriger vers l'espace utilisateur
            header("Location: espace_utilisateur.php");
            exit();  // Terminer l'exécution du script après la redirection
        } else {
            // Si l'utilisateur n'est pas trouvé
            $message = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs de connexion
        die("Erreur de connexion à la base de données : " . $e->getMessage());
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>agence de voyage</title>
    <link rel="stylesheet" href="index.css">
    <link rel="icon" href="logo.png.png">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@400" />
</head>
<body>
    <header class="h">
        <nav class="navi">
            <div class="logo"><img src="logo.png.png"></div>
            <ul class="lista">
                <li><a href="#">HOME</a></li>
                <li><a href="proj.html">À propos de nous</a></li>
                <li><a href="locaux.html">Nos locaux</a></li>
                <li><a href="offre.php">Nos offres</a></li>
                <li><a href="serv.php">Services</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="input">
                <span class="material-symbols-outlined">search</span>
                <input type="text" placeholder="ville, hôtel">
            </div>
        </nav>
    </header>

    <section class="s1">
        <h1>découvrons le monde ensemble &#128522;</h1>
        <div class="confiance"><img src="Capture d'écran 2025-02-13 004944.png"></div>
    </section>

    <section class="container">
        <article class="mySlides"><img src="omra.png" alt="Offre 1"></article>
        <article class="mySlides"><img src="istanbul.png" alt="Offre 2"></article>
        <article class="mySlides"><img src="circuit_nord.png" alt="Offre 3"></article>
        <article class="mySlides"><img src="sud_tunisien.png" alt="Offre 4"></article>
    </section>

    <section class="LR">
        <div class="left">
            <!-- Formulaire de connexion -->
            <fieldset>
                <legend>Connexion</legend>
                <form action="index.php" method="POST">
                    <table>
                        <tr>
                            <td><label for="name"></label></td>
                            <td><input type="text" id="name" name="name" placeholder="Entrez votre nom" required></td>
                        </tr>
                        <tr>
                            <td><label for="email"></label></td>
                            <td><input type="email" id="email" name="email" placeholder="Entrez votre email" required></td>
                        </tr>
                        <tr>
                            <td><label for="password"></label></td>
                            <td><input type="password" id="password" name="password" placeholder="Entrez votre mot de passe" required></td>
                        </tr>
                        <tr>
    <td colspan="2">
        <button id="btnConnecter" class="bttn1" type="submit">Se connecter</button>
        <button id="btnInscrire" type="button" onclick="window.location.href='register.php'">S'inscrire</button>
    </td>
</tr>


                    </table>
                </form>
                <?php if (!empty($message)) echo "<p style='color: red; font-weight: bold;'>$message</p>"; ?>
            </fieldset>
            <br>
        </div>
    </section>

    <!-- Section des témoignages -->
    <section class="tests">
        <h2>Over 1000 satisfied customers</h2>
        <div class="test-container">
            <div class="test">
                <img src="https://img.a.transfermarkt.technology/portrait/big/69110-1725823974.png?lm=1" alt="User">
                <h3>youssef msekni</h3>
                <p>2 years ago</p>
                <p>"Amazing service"</p>
            </div>
            <div class="test">
                <img src="https://realites.com.tn/fr/wp-content/uploads/2023/11/400133234_751022813707884_5948976763040358012_n.jpg" alt="User">
                <h3>zied jaziri</h3>
                <p>11 months ago</p>
                <p>"Very professional team!"</p>
            </div>
            <div class="test">
                <img src="https://pictures.artify.tn/media/nydwlxje77msmb8aonhf.jpg" alt="User">
                <h3>baya zardi</h3>
                <p>5 months ago</p>
                <p>"Would definitely recommend!"</p>
            </div>
        </div>
    </section>
    <script>
    const scroll = document.querySelector(".navi");
    window.addEventListener("scroll", () => {
        if (window.scrollY > 150) {
            scroll.classList.add("scrolled");
        } else {
            scroll.classList.remove("scrolled");
        }
    });
    document.getElementById("btnConnecter").addEventListener("click", function() {
    this.classList.add('clicked');
    setTimeout(() => {
        this.classList.remove('clicked');
        document.querySelector('form').submit();
    }, 200);
});

document.getElementById("btnInscrire").addEventListener("click", function() {
    this.classList.add('clicked');
    setTimeout(() => {
        this.classList.remove('clicked');
        window.location.href = 'register.php';
    }, 200);
});
// Sélectionner tous les liens du menu
document.querySelectorAll('.lista a').forEach(link => {
    link.classList.add('boutonNav');
});


</script>

</body>
</html>


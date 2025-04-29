<?php
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Connexion à la base de données avec PDO
        $conn = new PDO("mysql:host=localhost;dbname=agence_voyage", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Mode d'erreur pour gérer les exceptions

        // Récupération des données du formulaire
        $nom = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Requête préparée pour insérer les données dans la table
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (:nom, :email, :mot_de_passe)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':mot_de_passe', $password);

        // Exécution de la requête
        if ($stmt->execute()) {
            $message = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        } else {
            $message = "Erreur lors de l'inscription.";
        }
    } catch (PDOException $e) {
        // Gestion des erreurs de connexion
        $message = "Erreur : " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="register.css">
</head>
<body>
    <section class="LR">
        <div class="left">
            <fieldset>
                <legend>Inscription</legend>
                <form action="register.php" method="POST">
                    <table>
                        <tr>
                            <td><input type="text" name="name" placeholder="Nom complet" required></td>
                        </tr>
                        <tr>
                            <td><input type="email" name="email" placeholder="Email" required></td>
                        </tr>
                        <tr>
                            <td><input type="password" name="password" placeholder="Mot de passe" required></td>
                        </tr>
                        <tr>
                            <td>
                                <button type="submit" class="bttn1">S'inscrire</button>
                                <button type="button" onclick="window.location.href='index.php'">Retour</button>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php if (!empty($message)) echo "<p style='color: green; font-weight: bold;'>$message</p>"; ?>
            </fieldset>
        </div>
    </section>
</body>
</html>

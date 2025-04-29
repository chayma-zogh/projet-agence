<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agence_voyage";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$sql = "SELECT id, titre, description, image FROM offres";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Liste des Offres</title>
    <link rel="stylesheet" href="slidebar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f8;
            margin: 0;
            padding: 0;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #e6e6e6; /* lignes plus claires */
        }

        th {
            background-color: #007BFF; /* bleu */
            color: white;
        }

        tr:nth-child(even) {
            background-color: #fdfdfd;
        }

        tr:hover {
            background-color: #eaf4ff;
        }

        th:first-child {
            border-top-left-radius: 12px;
        }

        th:last-child {
            border-top-right-radius: 12px;
        }

        tr:last-child td:first-child {
            border-bottom-left-radius: 12px;
        }

        tr:last-child td:last-child {
            border-bottom-right-radius: 12px;
        }

        img {
            border-radius: 8px;
            max-width: 100px;
            height: auto;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    </style>
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
        <h1>Liste des Offres</h1>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Image</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row["id"]) ?></td>
                            <td><?= htmlspecialchars($row["titre"]) ?></td>
                            <td><?= htmlspecialchars($row["description"]) ?></td>
                            <td>
                                <?php if (!empty($row["image"])): ?>
                                    <img src="<?= htmlspecialchars($row["image"]) ?>" alt="Offre">
                                <?php else: ?>
                                    <em>Pas d'image</em>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr><td colspan="4">Aucune offre trouvée.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

<?php $conn->close(); ?>
</body>
</html>





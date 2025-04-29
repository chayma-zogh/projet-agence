<?php
$host = "localhost";
$user = "root";
$password = "";
$dbname = "agence_voyage";
$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Connexion échouée : " . $conn->connect_error);
}

$messages = $conn->query("SELECT * FROM contact_messages ORDER BY created_at DESC");
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Messages reçus</title>
    <link rel="stylesheet" href="espace_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .content {
            padding: 20px;
        }

        input[type="text"] {
            width: 300px;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
        }

        th, td {
            padding: 12px 15px;
            border: 1px solid #ddd;
        }

        th {
            background-color: #3e8e41;
            color: white;
            cursor: pointer;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #e2f0e2;
        }
        <style>
    .content {
        padding: 20px;
    }

    input[type="text"] {
        width: 300px;
        padding: 8px;
        margin-bottom: 15px;
        border: 1px solid #ccc;
        border-radius: 6px;
    }

    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        font-family: Arial, sans-serif;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    th, td {
        padding: 12px 15px;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #3e8e41;
        color: white;
        cursor: pointer;
    }

    tr:last-child td {
        border-bottom: none;
    }

    tr:nth-child(even) {
        background-color: #f9f9f9;
    }

    tr:hover {
        background-color: #e2f0e2;
    }

    th:first-child {
        border-top-left-radius: 12px;
    }

    th:last-child {
        border-top-right-radius: 12px;
    }

    td:first-child {
        border-left: 1px solid #ddd;
    }

    td:last-child {
        border-right: 1px solid #ddd;
    }
</style>

    </style>
</head>
<body>
    <div class="mainbox">
        <input type="checkbox" id="check">
        <label for="check" class="btn_1"><i class="fas fa-bars"></i></label>
        <div class="sidebarmenu">
            <div class="logo"><a href="#">Admin Panel</a></div>
            <label for="check" class="btn_2"><i class="fas fa-times"></i></label>
            <ul class="lista">
                <li><a href="espace_admin.php"><i class="fas fa-home"></i>Tableau de bord</a></li>
                <li><a href="messages.php"><i class="fas fa-envelope"></i>Messages</a></li>
            </ul>
        </div>
    </div>

    <div class="content">
        <h1>Messages reçus</h1>

        <input type="text" id="searchInput" placeholder="Rechercher un nom ou un email..." onkeyup="filterTable()">

        <?php if ($messages->num_rows > 0): ?>
            <table id="messagesTable">
                <thead>
                    <tr>
                        <th onclick="sortTable(0)">ID</th>
                        <th onclick="sortTable(1)">Nom</th>
                        <th onclick="sortTable(2)">Email</th>
                        <th>Message</th>
                        <th onclick="sortTable(4)">Date d'envoi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = $messages->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['id']) ?></td>
                            <td><?= htmlspecialchars($row['name']) ?></td>
                            <td><?= htmlspecialchars($row['email']) ?></td>
                            <td><?= nl2br(htmlspecialchars($row['message'])) ?></td>
                            <td><?= htmlspecialchars($row['created_at']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <p>Aucun message reçu.</p>
        <?php endif; ?>
    </div>

    <script>
        function filterTable() {
            let input = document.getElementById("searchInput").value.toLowerCase();
            let rows = document.querySelectorAll("#messagesTable tbody tr");

            rows.forEach(row => {
                let name = row.cells[1].textContent.toLowerCase();
                let email = row.cells[2].textContent.toLowerCase();
                row.style.display = (name.includes(input) || email.includes(input)) ? "" : "none";
            });
        }

        function sortTable(colIndex) {
            const table = document.getElementById("messagesTable");
            let switching = true;
            let dir = "asc";

            while (switching) {
                switching = false;
                let rows = table.rows;
                for (let i = 1; i < rows.length - 1; i++) {
                    let a = rows[i].getElementsByTagName("TD")[colIndex];
                    let b = rows[i + 1].getElementsByTagName("TD")[colIndex];
                    let shouldSwitch = false;

                    if (dir === "asc" && a.innerHTML.toLowerCase() > b.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    } else if (dir === "desc" && a.innerHTML.toLowerCase() < b.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }

                if (shouldSwitch) {
                    table.rows[i].parentNode.insertBefore(table.rows[i + 1], table.rows[i]);
                    switching = true;
                } else if (dir === "asc") {
                    dir = "desc";
                    switching = true;
                }
            }
        }
    </script>
</body>
</html>

<?php $conn->close(); ?>


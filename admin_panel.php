<?php
include 'db_connect.php';
$query = "SELECT * FROM Kursanci";
$stmt = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Panel Administratora</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
                <h1>Panel Administratora</h1>
            </div>
            <nav>
                <a href="index.php" class="btn">Powrót</a>
            </nav>
        </header>

        <main>
            <section class="participants">
                <h2>Lista Kursantów</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Kursanta</th>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>Akcja</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $row['ID_Kursanta'] ?></td>
                                <td><?= $row['Imie'] ?></td>
                                <td><?= $row['Nazwisko'] ?></td>
                                <td>
                                    <a href="edit_participant.php?id=<?= $row['ID_Kursanta'] ?>" class="btn edit">Edytuj</a>
                                    <a href="delete_participant.php?id=<?= $row['ID_Kursanta'] ?>" class="btn delete">Usuń</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>

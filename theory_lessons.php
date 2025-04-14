<?php
include 'db_connect.php'; // Połączenie z bazą danych

// Pobieranie danych z tabeli Lekcje_Teoretyczne
$query = "SELECT * FROM Lekcje_Teoretyczne ORDER BY Data";
$stmt = $pdo->query($query);

// Sprawdzanie czy zapytanie zwróciło jakiekolwiek dane
$lekcje = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Zajęcia Teoretyczne - Szkoła Jazdy</title>
    <link rel="stylesheet" href="style.css"> <!-- Link do pliku CSS -->
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
                <h1>Szkoła Jazdy - Zajęcia Teoretyczne</h1>
            </div>
            <nav>
                <a href="index.php" class="btn">Strona Główna</a>
            </nav>
        </header>

        <main>
            <section class="lekcje">
                <h2>Zajęcia Teoretyczne</h2>
                <?php if (count($lekcje) > 0): ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Data</th>
                                <th>Godzina</th>
                                <th>Sala</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($lekcje as $lekcja): ?>
                                <tr>
                                    <td><?php echo $lekcja['Data']; ?></td>
                                    <td><?php echo $lekcja['Godzina']; ?></td>
                                    <td><?php echo $lekcja['Sala']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Brak zajęć teoretycznych w bazie.</p>
                <?php endif; ?>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>

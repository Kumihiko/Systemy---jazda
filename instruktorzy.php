<?php
include 'db_connect.php'; // Połączenie z bazą

// Pobieranie danych z tabeli Instruktorzy
$query = "SELECT * FROM Instruktorzy";
$stmt = $pdo->query($query);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Instruktorzy - Szkoła Jazdy</title>
    <link rel="stylesheet" href="style.css"> <!-- Link do pliku CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Open+Sans:wght@300;400&display=swap" rel="stylesheet"> <!-- Google Fonts -->
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img"> <!-- Logo szkoły jazdy -->
                <h1>Szkoła Jazdy - Bezpieczna Przyszłość</h1>
            </div>
            <nav>
                <a href="index.php" class="btn">Strona Główna</a>
                <a href="add_participant.php" class="btn">Dodaj Kursanta</a>
            </nav>
        </header>
        
        <main>
            <section class="instruktorzy-container">
                <h2>Instruktorzy</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Instruktora</th>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        // Wyświetlanie danych instruktorów
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<tr>";
                            echo "<td>" . $row['ID_Instruktora'] . "</td>";
                            echo "<td>" . $row['Imie'] . "</td>";
                            echo "<td>" . $row['Nazwisko'] . "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
                <a href="index.php" class="btn-instruktorzy">Powrót do Strony Głównej</a>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>

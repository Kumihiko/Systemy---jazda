<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];

    $query = "INSERT INTO Kursanci (Imie, Nazwisko) VALUES (?, ?)";
    $stmt = $pdo->prepare($query);
    $stmt->execute([$imie, $nazwisko]);

    $success = "Kursant $imie $nazwisko został dodany!";
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Szkoła Jazdy</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <header>
            <div class="logo">
                <img src="car_logo.png" alt="Logo Szkoły Jazdy" class="logo-img">
                <h1>Szkoła Jazdy - Bezpieczna Przyszłość</h1>
            </div>
            <nav>
                <a href="admin_panel.php" class="btn">Panel Administratora</a>
                <a href="theory_lessons.php" class="btn">Zajęcia Teoretyczne</a>
                <a href="Instruktorzy.php" class="btn">Instruktorzy</a>
            </nav>
        </header>

        <main>
            <section class="form-section">
                <h2>Dodaj Kursanta</h2>
                <form method="POST" action="">
                    <label for="imie">Imię:</label>
                    <input type="text" id="imie" name="imie" required>

                    <label for="nazwisko">Nazwisko:</label>
                    <input type="text" id="nazwisko" name="nazwisko" required>

                    <button type="submit">Dodaj Kursanta</button>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>

</html>

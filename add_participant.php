<?php
include 'db_connect.php'; // Połączenie z bazą

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];

    // Dodanie kursanta do bazy
    $query = "INSERT INTO Kursanci (Imie, Nazwisko) VALUES (:imie, :nazwisko)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':imie', $imie);
    $stmt->bindParam(':nazwisko', $nazwisko);
    $stmt->execute();

    echo "Kursant dodany pomyślnie!";
    header('Location: index.php'); // Przekierowanie na stronę główną
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Dodaj Kursanta</title>
    <link rel="stylesheet" href="style.css"> <!-- Link do pliku CSS -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Dodaj Kursanta</h1>
        </header>
        
        <main>
            <form method="POST" class="form">
                <label for="imie">Imię: </label>
                <input type="text" id="imie" name="imie" required><br><br>

                <label for="nazwisko">Nazwisko: </label>
                <input type="text" id="nazwisko" name="nazwisko" required><br><br>

                <input type="submit" value="Dodaj Kursanta" class="btn">
            </form>
        </main>
    </div>
</body>
</html>

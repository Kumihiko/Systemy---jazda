<?php
include 'db_connect.php'; // Połączenie z bazą

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $imie = $_POST['imie'];
    $nazwisko = $_POST['nazwisko'];

    // Aktualizacja danych kursanta
    $query = "UPDATE Kursanci SET Imie = :imie, Nazwisko = :nazwisko WHERE ID_Kursanta = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':imie', $imie);
    $stmt->bindParam(':nazwisko', $nazwisko);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "Dane kursanta zaktualizowane pomyślnie!";
    header('Location: index.php'); // Przekierowanie na stronę główną
}

// Pobieranie danych kursanta do edycji
$id = $_GET['id'];
$query = "SELECT * FROM Kursanci WHERE ID_Kursanta = :id";
$stmt = $pdo->prepare($query);
$stmt->bindParam(':id', $id);
$stmt->execute();
$kursant = $stmt->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Edytuj Kursanta</title>
    <link rel="stylesheet" href="style.css"> <!-- Link do pliku CSS -->
</head>
<body>
    <div class="container">
        <header>
            <h1>Edytuj Kursanta</h1>
        </header>
        
        <main>
            <form method="POST" class="form">
                <input type="hidden" name="id" value="<?php echo $kursant['ID_Kursanta']; ?>">
                
                <label for="imie">Imię: </label>
                <input type="text" id="imie" name="imie" value="<?php echo $kursant['Imie']; ?>" required><br><br>

                <label for="nazwisko">Nazwisko: </label>
                <input type="text" id="nazwisko" name="nazwisko" value="<?php echo $kursant['Nazwisko']; ?>" required><br><br>

                <input type="submit" value="Zaktualizuj Kursanta" class="btn">
            </form>
        </main>
    </div>
</body>
</html>

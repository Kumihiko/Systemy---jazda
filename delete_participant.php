<?php
include 'db_connect.php'; // Połączenie z bazą

// Sprawdzanie, czy został przekazany identyfikator
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Usunięcie kursanta z bazy
    $query = "DELETE FROM Kursanci WHERE ID_Kursanta = :id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    echo "Kursant usunięty pomyślnie!";
    header('Location: index.php'); // Przekierowanie na stronę główną
} else {
    echo "Nie znaleziono kursanta do usunięcia.";
}
?>

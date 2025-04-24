<?php
include 'db_connect.php'; // Połączenie z bazą

// Pobieranie danych z tabeli Lekcje Teoretyczne
$query = "SELECT * FROM lekcje_teoretyczne";
$stmt = $pdo->query($query);

// Pobieranie danych kursantów
$kursanciQuery = "SELECT * FROM Kursanci";
$kursanciStmt = $pdo->query($kursanciQuery);

// Pobieranie danych z tabeli Instruktorzy
$instruktorzyQuery = "SELECT * FROM Instruktorzy";
$instruktorzyStmt = $pdo->query($instruktorzyQuery);

// Edytowanie kursanta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_id']) && isset($_POST['edit_imie']) && isset($_POST['edit_nazwisko']) && isset($_POST['edit_kategoria'])) {
    $edit_id = $_POST['edit_id'];
    $edit_imie = $_POST['edit_imie'];
    $edit_nazwisko = $_POST['edit_nazwisko'];
    $edit_kategoria = $_POST['edit_kategoria'];

    // Edytowanie kursanta w bazie danych
    $updateQuery = "UPDATE Kursanci SET Imie = ?, Nazwisko = ?, Kategoria = ? WHERE ID_Kursanta = ?";
    $stmtUpdate = $pdo->prepare($updateQuery);
    $stmtUpdate->execute([$edit_imie, $edit_nazwisko, $edit_kategoria, $edit_id]);
}

// Usuwanie kursanta
if (isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];

    // Usuwanie kursanta z bazy danych
    $deleteQuery = "DELETE FROM Kursanci WHERE ID_Kursanta = ?";
    $stmtDelete = $pdo->prepare($deleteQuery);
    $stmtDelete->execute([$delete_id]);
}

// Przypisanie instruktora do lekcji
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['lekcja_id']) && isset($_POST['instruktor_id'])) {
    $lekcja_id = $_POST['lekcja_id'];
    $instruktor_id = $_POST['instruktor_id'];

    // Przypisanie instruktora do lekcji
    $updateQuery = "UPDATE lekcje_teoretyczne SET ID_Instruktora = ? WHERE ID_Lekcji = ?";
    $stmtUpdate = $pdo->prepare($updateQuery);
    $stmtUpdate->execute([$instruktor_id, $lekcja_id]);
}

// Przypisanie instruktora do kursanta
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kursant_id']) && isset($_POST['instruktor_id_kursant'])) {
    $kursant_id = $_POST['kursant_id'];
    $instruktor_id_kursant = $_POST['instruktor_id_kursant'];

    // Przypisanie instruktora do kursanta
    $updateQuery = "UPDATE Kursanci SET ID_Instruktora = ? WHERE ID_Kursanta = ?";
    $stmtUpdate = $pdo->prepare($updateQuery);
    $stmtUpdate->execute([$instruktor_id_kursant, $kursant_id]);
}
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
                <a href="index.php" class="btn">Strona Główna</a>
            </nav>
        </header>

        <main>
            <!-- Lista kursantów -->
            <section class="kursanci-list">
                <h2>Lista Kursantów</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID Kursanta</th>
                            <th>Imię</th>
                            <th>Nazwisko</th>
                            <th>Kategoria Prawa Jazdy</th>
                            <th>Instruktor</th>
                            <th>Akcje</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($kursant = $kursanciStmt->fetch(PDO::FETCH_ASSOC)): ?>
                            <tr>
                                <td><?= $kursant['ID_Kursanta'] ?></td>
                                <td><?= $kursant['Imie'] ?></td>
                                <td><?= $kursant['Nazwisko'] ?></td>
                                <td>
                                    <!-- Edycja kategorii prawa jazdy -->
                                    <form method="POST" class="inline-form">
                                        <input type="hidden" name="edit_id" value="<?= $kursant['ID_Kursanta'] ?>">
                                        <select name="edit_kategoria" required>
                                            <option value="A" <?= $kursant['Kategoria'] == 'A' ? 'selected' : '' ?>>A</option>
                                            <option value="B" <?= $kursant['Kategoria'] == 'B' ? 'selected' : '' ?>>B</option>
                                            <option value="C" <?= $kursant['Kategoria'] == 'C' ? 'selected' : '' ?>>C</option>
                                            <option value="D" <?= $kursant['Kategoria'] == 'D' ? 'selected' : '' ?>>D</option>
                                        </select>
                                        <button type="submit" class="btn">Edytuj</button>
                                    </form>
                                </td>
                                <td>
                                    <!-- Przypisanie instruktora -->
                                    <form method="POST" class="inline-form">
                                        <input type="hidden" name="kursant_id" value="<?= $kursant['ID_Kursanta'] ?>">
                                        <select name="instruktor_id_kursant" required>
                                            <?php 
                                                // Wykonaj zapytanie po raz kolejny, aby uzyskać dane instruktorów
                                                $instruktorzyStmt = $pdo->query("SELECT * FROM Instruktorzy");
                                                while ($instr = $instruktorzyStmt->fetch(PDO::FETCH_ASSOC)): 
                                            ?>
                                                <option value="<?= $instr['ID_Instruktora'] ?>" <?= $kursant['ID_Instruktora'] == $instr['ID_Instruktora'] ? 'selected' : '' ?>>
                                                    <?= $instr['Imie'] ?> <?= $instr['Nazwisko'] ?>
                                                </option>
                                            <?php endwhile; ?>
                                        </select>
                                        <button type="submit" class="btn">Przypisz</button>
                                    </form>
                                </td>
                                <td>
                                    <!-- Link usuwania kursanta -->
                                    <a href="?delete_id=<?= $kursant['ID_Kursanta'] ?>" class="btn delete-btn">Usuń</a>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </section>

            <!-- Przypisywanie instruktorów do lekcji -->
            <section class="assign-instructor">
                <h2>Przypisz Instruktora do Lekcji</h2>
                <form method="POST" class="form-box">
                    <div class="form-group">
                        <label for="lekcja_id">Wybierz Lekcję:</label>
                        <select name="lekcja_id" id="lekcja_id" required>
                            <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                                <option value="<?= $row['ID_Lekcji'] ?>">
                                    Lekcja <?= $row['ID_Lekcji'] ?> - <?= $row['Sala'] ?> (<?= $row['Data'] ?>, <?= $row['Godzina'] ?>)
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="instruktor_id">Wybierz Instruktora:</label>
                        <select name="instruktor_id" id="instruktor_id" required>
                            <?php 
                                // Ponownie wykonaj zapytanie o instruktorów
                                $instruktorzyStmt = $pdo->query("SELECT * FROM Instruktorzy");
                                while ($instr = $instruktorzyStmt->fetch(PDO::FETCH_ASSOC)): 
                            ?>
                                <option value="<?= $instr['ID_Instruktora'] ?>">
                                    <?= $instr['Imie'] ?> <?= $instr['Nazwisko'] ?>
                                </option>
                            <?php endwhile; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn">Przypisz Instruktora</button>
                </form>
            </section>
        </main>

        <footer>
            <p>&copy; 2025 Szkoła Jazdy - Wszystkie prawa zastrzeżone</p>
        </footer>
    </div>
</body>
</html>

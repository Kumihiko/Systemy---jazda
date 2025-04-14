<?php
include 'db_connect.php';

// Obsługa formularza przypisania instruktora
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kursant_id']) && isset($_POST['instruktor_id'])) {
    $kursant_id = $_POST['kursant_id'];
    $instruktor_id = $_POST['instruktor_id'];

    $stmt = $pdo->prepare("UPDATE Kursanci SET ID_Instruktora = ? WHERE ID_Kursanta = ?");
    $stmt->execute([$instruktor_id, $kursant_id]);
}

// Pobieranie kursantów
$kursanci = $pdo->query("SELECT * FROM Kursanci")->fetchAll(PDO::FETCH_ASSOC);

// Pobieranie instruktorów
$instruktorzy = $pdo->query("SELECT * FROM Instruktorzy")->fetchAll(PDO::FETCH_ASSOC);
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
        <section>
            <table class="table">
                <thead>
                <tr>
                    <th>Imię Kursanta</th>
                    <th>Nazwisko Kursanta</th>
                    <th>Instruktor</th>
                    <th>Akcja</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($kursanci as $kursant): ?>
                    <tr>
                        <td><?= htmlspecialchars($kursant['Imie']) ?></td>
                        <td><?= htmlspecialchars($kursant['Nazwisko']) ?></td>
                        <td>
                            <form method="POST" style="display: flex; gap: 8px; align-items: center;">
                                <input type="hidden" name="kursant_id" value="<?= $kursant['ID_Kursanta'] ?>">
                                <select name="instruktor_id">
                                    <option value="">-- Wybierz --</option>
                                    <?php foreach ($instruktorzy as $instruktor): ?>
                                        <option value="<?= $instruktor['ID_Instruktora'] ?>"
                                            <?= $kursant['ID_Instruktora'] == $instruktor['ID_Instruktora'] ? 'selected' : '' ?>>
                                            <?= $instruktor['Imie'] . ' ' . $instruktor['Nazwisko'] ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                <button type="submit" class="btn">Zapisz</button>
                            </form>
                        </td>
                        <td>
                            <a href="edit_participant.php?id=<?= $kursant['ID_Kursanta'] ?>" class="btn edit">Edytuj</a> |
                            <a href="delete_participant.php?id=<?= $kursant['ID_Kursanta'] ?>" class="btn delete">Usuń</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
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

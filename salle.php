<?php
$host = 'localhost';
$dbname = 'planning';
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

$nom_salle = isset($_GET['nom_salle']) ? $_GET['nom_salle'] : null;
$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

$message = ""; // Pour stocker le message de confirmation

if (!$nom_salle) {
    die("Nom de salle manquant !");
}

$querySalle = $pdo->prepare("SELECT id, nom_salle FROM Salles WHERE nom_salle = ?");
$querySalle->execute([$nom_salle]);
$salle = $querySalle->fetch(PDO::FETCH_ASSOC);

if (!$salle) {
    die("Salle introuvable !");
}

$queryPlanning = $pdo->prepare("
    SELECT P.heure_debut, P.heure_fin, C.nom_classe 
    FROM Planning P
    JOIN Classes C ON P.id_classe = C.id
    WHERE P.id_salle = ? AND P.date = ?
");
$queryPlanning->execute([$salle['id'], $date]);
$plannings = $queryPlanning->fetchAll(PDO::FETCH_ASSOC);

$heureDebut = 9;
$heureFin = 17;
$occupation = array_fill($heureDebut, $heureFin - $heureDebut, 'Libre');

foreach ($plannings as $planning) {
    $heureDebutCours = (int)substr($planning['heure_debut'], 0, 2);
    $heureFinCours = (int)substr($planning['heure_fin'], 0, 2);
    
    for ($heure = $heureDebutCours; $heure < $heureFinCours; $heure++) {
        if (isset($occupation[$heure])) {
            $occupation[$heure] = 'Occupé (' . $planning['nom_classe'] . ')';
        }
    }
}

// Vérifiez si une réservation a été demandée
if (isset($_POST['reserve'])) {
    $message = "Demande de réservation envoyée à la pédagogie.";
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning de la salle <?php echo htmlspecialchars($salle['nom_salle']); ?></title>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center">Planning de la salle <?php echo htmlspecialchars($salle['nom_salle']); ?> pour le <?php echo htmlspecialchars(date('d/m/Y', strtotime($date))); ?></h1>

        <?php if ($message): ?>
            <div class="alert alert-success text-center" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Heure</th>
                                <th>Statut</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php for ($heure = $heureDebut; $heure < $heureFin; $heure++): ?>
                                <tr>
                                    <td><?php echo $heure . ':00'; ?></td>
                                    <td><?php echo htmlspecialchars($occupation[$heure]); ?></td>
                                    <td>
                                        <?php if ($occupation[$heure] === 'Libre'): ?>
                                            <form method="post" style="display: inline;">
                                                <input type="hidden" name="reserve" value="1">
                                                <button type="submit" class="btn btn-success">Réserver</button>
                                            </form>
                                        <?php else: ?>
                                            <button class="btn btn-secondary" disabled>Réservé</button>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endfor; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="mt-4 text-center">
            <a href="index.php" class="btn btn-secondary">Retour à l'accueil</a>
        </div>
    </div>

    <!-- Intégration de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

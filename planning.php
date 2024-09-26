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


$date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');


$querySalles = $pdo->prepare("SELECT id, nom_salle FROM Salles");
$querySalles->execute();
$salles = $querySalles->fetchAll(PDO::FETCH_ASSOC);


$queryPlanning = $pdo->prepare("
    SELECT P.id_salle, P.heure_debut, P.heure_fin, C.nom_classe 
    FROM Planning P
    JOIN Classes C ON P.id_classe = C.id
    WHERE P.date = ?
");
$queryPlanning->execute([$date]);
$plannings = $queryPlanning->fetchAll(PDO::FETCH_ASSOC);

$heureDebut = 9;
$heureFin = 17;  
$interval = 1;

$occupations = [];


foreach ($salles as $salle) {
    $occupations[$salle['id']] = array_fill($heureDebut, $heureFin - $heureDebut, 'Libre');
    
    foreach ($plannings as $planning) {
        if ($planning['id_salle'] == $salle['id']) {
        
            $heureDebutCours = (int)substr($planning['heure_debut'], 0, 2);
            $heureFinCours = (int)substr($planning['heure_fin'], 0, 2);
            
     
            for ($heure = $heureDebutCours; $heure < $heureFinCours; $heure++) {
                if (isset($occupations[$salle['id']][$heure])) {
                    $occupations[$salle['id']][$heure] = 'Occupé (' . $planning['nom_classe'] . ')';
                }
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Emploi du temps des salles</title>
</head>
<body>
    <h1>Emploi du temps des salles pour le <?php echo date('d/m/Y', strtotime($date)); ?></h1>


    <form action="planning.php" method="get">
        <label for="date">Choisir une date :</label>
        <input type="date" id="date" name="date" value="<?php echo $date; ?>">
        <button type="submit">Voir le planning</button>
    </form>

    <p>
        <a href="planning.php?date=<?php echo date('Y-m-d', strtotime($date . ' -1 day')); ?>">Jour précédent</a> |
        <a href="planning.php?date=<?php echo date('Y-m-d', strtotime($date . ' +1 day')); ?>">Jour suivant</a>
    </p>

    <table border="1" cellpadding="10">
        <thead>
            <tr>
                <th>Salle</th>
                <?php for ($heure = $heureDebut; $heure < $heureFin; $heure++): ?>
                    <th><?php echo $heure . ':00'; ?></th>
                <?php endfor; ?>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($salles as $salle): ?>
                <tr>
                    <td><?php echo htmlspecialchars($salle['nom_salle']); ?></td>
                    <?php for ($heure = $heureDebut; $heure < $heureFin; $heure++): ?>
                        <td><?php echo htmlspecialchars($occupations[$salle['id']][$heure]); ?></td>
                    <?php endfor; ?>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Planning des salles</title>
 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    <div class="container mt-5">
        <h1 class="text-center mb-4">Consultez l'occupation des salles</h1>
        
        <div class="card p-4 shadow-sm">
            <h2>Sélectionnez une salle et une date</h2>
            <form action="salle.php" method="get" class="row g-3">
                <div class="col-md-6 col-sm-12">
                    <label for="nom_salle" class="form-label">Nom de la salle</label>
                    <input type="text" class="form-control" id="nom_salle" name="nom_salle" placeholder="Ex: Salle 101" required>
                </div>
                <div class="col-md-6 col-sm-12">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="<?php echo date('Y-m-d'); ?>" required>
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary w-100">Voir le planning</button>
                </div>
            </form>
        </div>

        <div class="mt-5">
            <h2>Ou sélectionnez une salle directement :</h2>
            <ul class="list-group">
                <li class="list-group-item"><a href="salle.php?nom_salle=Salle 101&date=<?php echo date('Y-m-d'); ?>" class="text-decoration-none">Salle 101</a></li>
                <li class="list-group-item"><a href="salle.php?nom_salle=Salle 102&date=<?php echo date('Y-m-d'); ?>" class="text-decoration-none">Salle 102</a></li>
                <li class="list-group-item"><a href="salle.php?nom_salle=Salle 103&date=<?php echo date('Y-m-d'); ?>" class="text-decoration-none">Salle 103</a></li>
            </ul>
        </div>
    </div>

    <!-- Intégration de Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

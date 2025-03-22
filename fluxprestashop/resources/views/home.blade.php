<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord - PrestaView</title>
    <!-- Lien vers Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">PrestaView</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item"><a class="nav-link" href="{{ route('home') }}">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('products.list') }}">Liste des produits</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liste des clients</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Liste des commandes</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <div class="container mt-4">
        <h1 class="text-center">Tableau de bord</h1>
        <div class="row mt-4">
            <!-- Carte Produits -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Liste des produits</h5>
                        <p class="card-text">Gérez la liste complète de vos produits.</p>
                        <a href="#" class="btn btn-primary">Voir les produits</a>
                    </div>
                </div>
            </div>

            <!-- Carte Clients -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Liste des clients</h5>
                        <p class="card-text">Consultez et gérez les informations clients.</p>
                        <a href="#" class="btn btn-primary">Voir les clients</a>
                    </div>
                </div>
            </div>

            <!-- Carte Commandes -->
            <div class="col-md-4">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">Liste des commandes</h5>
                        <p class="card-text">Suivez les commandes de vos clients.</p>
                        <a href="#" class="btn btn-primary">Voir les commandes</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="bg-light text-center mt-4 py-3">
        <p>
            <a href="#">Politique de confidentialité</a> |
            <a href="#">Conditions d'utilisation</a> |
            <a href="#">Contactez-nous</a>
        </p>
    </footer>

    <!-- Lien vers Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

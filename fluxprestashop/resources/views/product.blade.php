<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Détails du Produit</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Détails du Produit</h1>
        @if (isset($product['product']))
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Champ</th>
                        <th>Valeur</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($product['product'] as $key => $value)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $value }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>Produit non trouvé.</p>
        @endif
        <h2>Modifier le Prix</h2>
        @if (isset($product['product']['price']))
            <form action="{{ route('updateProductPrice', $product['product']['id']) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="price" class="form-label">Prix</label>
                    <input type="text" class="form-control" id="price" name="price" value="{{ $product['product']['price'] }}">
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
            </form>
        @else
            <p>Impossible de modifier le prix.</p>
        @endif
    </div>
</body>
</html>

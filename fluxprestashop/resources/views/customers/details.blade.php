<!DOCTYPE html>
<html>
<head>
    <title>Détails du client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <h1 class="mt-5">Détails du client</h1>

    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        <table class="table table-bordered mt-3">
            <tr>
                <th>ID</th>
                <td>{{ $customer['id'] }}</td>
            </tr>
            <tr>
                <th>Prénom</th>
                <td>{{ $customer['firstname'] }}</td>
            </tr>
            <tr>
                <th>Nom</th>
                <td>{{ $customer['lastname'] }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $customer['email'] }}</td>
            </tr>
            <tr>
                <th>Date d'ajout</th>
                <td>{{ $customer['date_add'] }}</td>
            </tr>
            <tr>
                <th>Date de mise à jour</th>
                <td>{{ $customer['date_upd'] }}</td>
            </tr>
        </table>
    @endif
</div>
</body>
</html>

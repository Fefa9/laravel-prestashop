@extends('layouts.app')

@section('title', 'Liste des produits')

@section('content')
<div class="container">
    <h1 class="mt-5">Liste des produits</h1>

    @if(isset($error))
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @else
        <table class="table table-bordered mt-3">
            <thead class="thead-dark">
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prix</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                    <tr>
                        <td>{{ $product['id'] }}</td>
                        <td>{{ $product['name'] }}</td>
                        <td>{{ $product['price'] }} €</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection

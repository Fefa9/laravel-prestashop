@extends('layouts.app')

@section('title', 'Product Details')

@section('content')
    <h1>{{ $productName }}</h1>
    <p>{!! $productDescription !!}</p>
    <p>Prix : {{ $productPrice }}</p>
@endsection

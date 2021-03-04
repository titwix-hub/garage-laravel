@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Mon devis :</h1>
        </div>
    </div>
    <div class="row">
        <table class="table">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    <th>Date debut</th>
                    <th>Date fin</th>
                    <th>Prix HT</th>
                    <th>Prix TTC</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td> {{$nom}} </td>
                    <td> {{$starting_at}} </td>
                    <td> {{$ending_at}} </td>
                    <td> {{$prix_ht}}€ </td>
                    <td> {{$prix_ttc}}€ </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection
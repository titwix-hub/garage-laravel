@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div style="margin-bottom: 15px" class="col-lg-12">
            <h1>{{ $annonce->title }}</h1>
        </div>
        <div class="col-lg-12">
            <ul>
                <li>prix : {{ $annonce->price }}€</li>
                <li>Contenue : {{ $annonce->content }}</li>
            </ul>
        </div>
        @include('annonces.commentaire', ['commentaires' => $commentaires, 'id' => $annonce->id, 'user_id' => $user_id])
    </div>
</div>
@endsection
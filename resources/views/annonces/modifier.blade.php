@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div style="margin-bottom: 15px" class="col-lg-12">
            <h1>Modifier l'annonce :</h1>
        </div>
        <form method="POST" action="{{ route('annonces.change', $annonce->id) }}">
            <div class="form-group">
                <label for="">Titre</label>
                <input class="form-control" type="text" name="title" value="{{$annonce->title}}">
            </div>
            <div class="form-group">
                <label for="">Prix</label>
                <input class="form-control" type="number" name="price" value="{{$annonce->price}}">
            </div>
            <div class="form-group">
                <label for="">Texte</label>
                <input class="form-control" type="text" name="texte" value="{{$annonce->content}}">
            </div>
            @csrf
            @method('PUT')
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>
@endsection
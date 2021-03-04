@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div style="margin-bottom: 15px" class="col-lg-12">
            <h1>Ajouter une annonce</h1>
        </div>
        <form method="POST" action="{{ route('annonces.new') }}">
            <div class="form-group">
                <label for="">Titre</label>
                <input  class="form-control" type="text" name="title">
            </div>
            <div class="form-group">
                <label for="">Prix</label>
                <input class="form-control" type="number" name="price">
            </div>
            <div class="form-group">
                <label for="">Texte</label>
                <textarea class="form-control" name="texte" id="" cols="30" rows="10"></textarea>
            </div>
            @csrf
            <button type="submit" class="btn btn-primary">Ajouter</button>
        </form>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div style="margin-bottom: 15px" class="col-lg-12">
            <h1>Modifier mon commentaire :</h1>
        </div>
        <form action="{{ route('annonces.newcomment', [$id, $commentaire]) }}" method="POST">
        @csrf
            <div>
                <label for="">commentaire :</label>
                <input class="form-control" type="text" name="commentaire" value="{{ $commentaire->content }}">
            </div>
            <button type="submit" class="btn btn-primary">modifier</button>
        </form>
    </div>
</div>
@endsection
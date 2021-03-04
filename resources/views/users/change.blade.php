@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Nouvelle date</h1>
        </div>
    </div>
    <form method="POST" action="{{route('user.show.new'), $id}}">
    @csrf
    @method('PUT')
        <div class="form-group">
            <label for="">Nouvelle date de fin de la réservation</label>
            <input  class="form-control" min="{{now()}}" type="date" name="ending_at">
        </div>
        <input class="btn btn-sm btn-primary" type="submit" value="Changer">
    </form>
</div>

@endsection
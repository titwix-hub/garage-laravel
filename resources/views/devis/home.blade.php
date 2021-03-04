@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Demander un devis</h1>
        </div>
    </div>
    <div class="row">
        <form method="POST" action="{{ route('devis.resume') }}">
                @csrf
                <select class="form-control" name="vehicle" id="">
                    @foreach($vehicles as $vehicle)
                    <option value="{{ $vehicle->id }}">{{$vehicle->name}} : {{$vehicle->price}}€/jour</option>
                    @endforeach
                </select>
                <div class="form-group">
                    <label for="">Date de début de la réservation</label>
                    <input  class="form-control" type="date" name="starting_at">
                </div>
                <div class="form-group">
                    <label for="">Date de fin de la réservation</label>
                    <input  class="form-control" type="date" name="ending_at">
                </div>
                <button type="submit" class="btn btn-primary">Calculer un devis</button>
            </form>
    </div>
</div>
@endsection
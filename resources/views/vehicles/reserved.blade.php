@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <form method="POST" action="{{ route('vehicules.reserved.store', $vehicle) }}">
                @csrf
                <div class="form-group">
                    <label for="">Date de début de la réservation</label>
                    <input  class="form-control" type="date" name="starting_at">
                </div>
                <div class="form-group">
                    <label for="">Date de fin de la réservation</label>
                    <input  class="form-control" type="date" name="ending_at">
                </div>
                <button type="submit" class="btn btn-primary">Réserver</button>
            </form>
        </div>

        @include('layouts.includes.form-errors')
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1>Mes réservations</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Vehicle</th>
                            <th>Date debut</th>
                            <th>Date fin</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($reservations as $reservation)
                        <tr>
                            <td> {{ $reservation->name }} </td>
                            <td> {{ $reservation->pivot->started_at }} </td>
                            <td> {{ $reservation->pivot->ended_at }} </td>
                            <td>
                                @if ($reservation->pivot->ended_at > now())
                                    <button class="btn btn-sm btn-primary">Prolonger</button>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

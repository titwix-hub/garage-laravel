@extends('layouts.app')

@section('content')

    <div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#id</th>
                <th scope="col">Name</th>
                <th scope="col">Brand</th>
                <th scope="col">Type</th>
                <th scope="col">Status</th>
                <th scope="col">Price</th>
                <th scope="col">Odometer</th>
            </tr>
            </thead>
            <tbody>
            @foreach($vehicles as $vehicle)
            <tr>
                <th scope="row">{{ $vehicle->id }}</th>
                <td>{{ $vehicle->name }}</td>
                <td>{{ $vehicle->brand->name }}</td>
                <td>{{ $vehicle->type }}</td>
                <td>{{ $vehicle->status }}</td>
                <td>{{ $vehicle->price }}</td>
                <td>{{ $vehicle->odometer }}</td>
                <td><a href="{{ route('admin.vehicle.show', ['id'=>$vehicle->id]) }}" class="btn btn-info">Changer le status</a> </td>

            </tr>
            @endforeach

            </tbody>
        </table>
        {{ $vehicles->links() }}

    </div>

@endsection

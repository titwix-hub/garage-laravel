@extends('layouts.app')

@section('content')
    @include('layouts.includes.form-errors')

    <div>
        <p>#{{$vehicle->id}} {{$vehicle->name}} {{$vehicle->brand->name}}</p>
        <form method="post" action=" {{route('admin.vehicle.update', ['id'=>$vehicle->id])}}">
            @csrf
            @method('PUT')
            <label for="Status">Status</label>
            <select name="status" value="{{$vehicle->status}}" id="Status">
                @foreach($statues as $statue)
                    <option value="{{$statue}}" {{ $vehicle->status === $statue ? "selected='selected'" : '' }} >{{$statue}}</option>
                @endforeach
            </select>
            <input type="submit" class="btn btn-success">
        </form>
    </div>

@endsection

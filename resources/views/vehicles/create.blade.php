@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <h1>Ajouter un Véhicule</h1>
        </div>
    </div>

    @include('layouts.includes.form-errors')

    <div class="row">
        <div class="col-lg-6">
            <form method="POST" action="{{ route('vehicles.store') }}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Marque</label>
                    <select  class="form-control" name="brand_id" id="">
                        <option value="">Séléctionner une marque</option>
                        @foreach($brands as $brand)
                            <option value="{{$brand->id}}">{{ $brand->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Name</label>
                    <input  class="form-control" type="text" name="name">
                </div>
                <div class="form-group">
                    <label for="">price</label>
                    <input class="form-control" type="text" name="price">
                </div>

                <div class="form-group">
                    <label for="">status</label>
                    <input class="form-control" type="text" name="status">
                </div>

                <div class="form-group">
                    <label for="">odometer</label>
                    <input class="form-control" type="text" name="odometer">
                </div>

                <div class="form-group">
                    <label for="">type</label>
                    <input class="form-control" type="text" name="type">
                </div>
                @csrf

                <button type="submit" class="btn btn-primary">Creer</button>
            </form>
        </div>
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div style="margin-bottom: 15px" class="col-lg-12">
            <h1>Nos annonces :</h1>
        </div>
    </div>
    <div class="row">
        <div class="list-group">
            @foreach($annonces as $annonce)
                @if($annonce->enabled)
                <a style="width:300px" href="{{ route('annonces.show', $annonce->id) }}" class="list-group-item list-group-item-action">
                    {{ $annonce->title }}
                    <span style="float:right" class="badge badge-primary badge-pill">{{ $annonce->price }}€</span>
                </a>
                    @if($annonce->user_id)
                        @if($annonce->user_id == $user)
                        <div style="display:flex">
                            <form action="{{ route('annonces.delete', $annonce->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger btn-sm" title="Delete">Supprimer</button>
                            </form>
                            <a class="btn btn-warning btn-sm" href="{{ route('annonces.modifier', $annonce->id) }}">Modifier</a>
                        </div>
                        @endif
                    @endif
                @endif
            @endforeach
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
   <div class="container-fluid">
       <div class="row">
           <div class="col-lg-12">
               Mon porte monnaie : {{ $user->wallet }} €
           </div>
       </div>
       <div class="row">
           <div class="col-lg-6">
               <form method="POST" action="{{ route('user.add.money') }}">
                   @csrf
                   @method('PUT')
                   <div class="form-group">
                       <label for="">Montant</label>
                       <input  class="form-control" type="number" name="amount">
                   </div>
                   <button type="submit" class="btn btn-primary">Ajouter de la money</button>
               </form>
           </div>
       </div>
       @include('layouts.includes.form-errors')
   </div>
@endsection

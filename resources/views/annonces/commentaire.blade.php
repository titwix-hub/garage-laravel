<div style="margin-bottom: 15px" class="col-lg-12">
    <h2>Commentaire</h2>
</div>
<div class="col-lg-12">
    <form action="{{ route('annonces.addcomment', $id) }}" method='POST'>
        @csrf
        <div class="form-group">
            <label for="commentaire">Votre message :</label>
            <input type="text" class="form-control" id="commentaire" name="commentaire">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>
    @if(count($commentaires) == 0)
    <p>Aucun commentaire.</p>
    @else
    <ul class="list-group">
        @foreach($commentaires as $commentaire)
            @if($commentaire->enabled)
            <li style="width:600px" class="list-group-item">
                <p>{{ $commentaire->content }}</p>
                <div>
                    @if($commentaire->user_id == $user_id)
                    <div style="display:flex">
                        <form action="{{ route('annonces.deletecomment', [$id, $commentaire->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" title="Delete">Supprimer</button>
                        </form>
                        <a class="btn btn-warning btn-sm" href="{{ route('annonces.modifcomment', [$id, $commentaire->id]) }}">Modifier</a>
                    </div>
                    @endif
                </div>
            </li>
            @endif
        @endforeach
    </ul>
    @endif
</div>
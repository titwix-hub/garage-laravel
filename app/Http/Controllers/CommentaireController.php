<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Commentaire;

class CommentaireController extends Controller
{
    public function addcomment(Request $request, $id)
    {
        $user = Auth::user();
        $new = new Commentaire;
        $new->content = $request->commentaire;
        $new->user_id = $user->id;
        $new->annonce_id = $id;
        $new->save();

        return redirect()->route('annonces.show', $id);
    }

    public function deletecomment($id, $commentaire)
    {
        $commentaire = Commentaire::find($commentaire);
        $commentaire->delete();

        return redirect()->route('annonces.show', $id);
    }

    public function modifcomment($id, $commentaire)
    {   
        $commentaire = Commentaire::find($commentaire);
        return view('annonces.modifcomment', ['commentaire' => $commentaire, 'id' => $id]);
    }

    public function newcomment(Request $request, $id, $commentaire)
    {   
        Commentaire::where('id',$id)
            ->update([
                'content'=>$request->commentaire
                ]);

        return view('annonces.show', ['commentaire' => $commentaire, 'id' => $id]);
    }
}

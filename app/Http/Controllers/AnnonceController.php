<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Annonce;
use App\Models\Commentaire;
use App\Http\Requests\AddAnnonceRequest;

class AnnonceController extends Controller
{
    public function home()
    {
        $annonces = Annonce::all();
        $user = Auth::user();

        if($user == null)
        {
            return view('annonces.home', ['annonces' => $annonces, 'user' => null]);
        }
        return view('annonces.home', ['annonces' => $annonces, 'user' => $user->id]);
    }

    public function show($id)
    {
        $annonce = Annonce::findOrFail($id);
        $commentaire = Commentaire::where('annonce_id', '=', $id)->get();
        $user = Auth::user();

        return view('annonces.show', ['annonce' => $annonce, 'commentaires' => $commentaire, 'user_id' => $user->id]);
    }

    public function commentaire()
    {
        return view('annonces.commentaire');
    }

    public function ajouter()
    {
        return view('annonces.ajouter');
    }

    public function new(Request $request)
    {
        $user = Auth::user();
        $new = new Annonce;
        $new->title = $request->title;
        $new->content = $request->texte;
        $new->price = $request->price;
        $new->user_id = $user->id;
        $new->save();

        return redirect()->route('annonces.home');
    }

    public function delete($id)
    {
        $annonce = Annonce::find($id);
        $annonce->delete();

        return redirect()->route('annonces.home');
    }

    public function modifier($id)
    {
        $annonce = Annonce::find($id);
        return view('annonces.modifier', ['annonce' => $annonce]);
    }

    public function change(Request $request, $id)
    {
        Annonce::where('id',$id)
            ->update([
                'title'=>$request->title,
                'content'=>$request->texte,
                'price'=>$request->price,
                ]);

        return redirect()->route('annonces.home');
    }
}
<?php

namespace App\Http\Controllers;

use App\Niveau;
use App\Matiere;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class NiveauController extends Controller
{
    //
    public function index(){

        return view('niveaus.index');
    }

    public function show($id){
        $niveau = Niveau::with('matieres')->where('id',$id)->get()->first();
        return view('niveaus.show', compact('niveau'));
    }

    public function ajouterMatiere(Request $request){
        $niveau = Niveau::find($request->niveau_id);
        $matiere = new Matiere();
        $matiere->niveau_id = $niveau->id;
        $matiere->nom = $request->nom;
        $matiere->detail = $request->detail;
        $matiere->save();
        return Redirect::back()->with('succes','La nouvelle matière est ajoutée aux listes des matières avec succès!');
    }
}

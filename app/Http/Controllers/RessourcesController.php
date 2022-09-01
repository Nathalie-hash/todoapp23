<?php

namespace App\Http\Controllers;

use App\User;
use App\Niveau;
use App\Matiere;
use App\Ressource;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

class RessourcesController extends Controller
{
    // supprimer un ressource
    public function delete($id){
        $user = Auth::user();
        if (!$user->hasRole('enseignant') && !$user->hasRole('administrateur')){
            abort(404);
        }

        $resource = Ressource::find($id);
        $resource->delete();
        return Redirect::back()->with('succes','Fichier supprimé avec succès');
    }

    // pour pouvoir télécharger une ressource
    public function getRessource($id){ 
        // TODO: seul les personnes connectés ayant un rôle
        // étudiant ou enseignant ou administrateur peuventa accéder au ressource
        // TODO: si le rôle est étudiant et qu'il n'est pas dans
        // le niveau où se trouve cette ressource, refuser l'accès
        // Pour rappel on a
        // user => niveau => matiere => ressource
        $matiere = Ressource::where('id',$id)->get()->first()["matiere_id"];
        $niveau_matiere = Matiere::where('id',$matiere)->get()->first()["niveau_id"];
        $id_user=auth()->user()->id;
        $niveau_user= auth()->user()->niveaux()->where('user_id',$id_user)->get()->first()["pivot"]["niveau_id"];
        if (auth()->check() && auth()->user()->hasRole('enseignant')){
            $resource = Ressource::find($id);
            $pathname= $resource->chemin;
            return Storage::disk("java")->download($pathname);
        }else if (auth()->check() && auth()->user()->hasRole('administrateur')) {
            $resource = Ressource::find($id);
            $pathname= $resource->chemin;
            return Storage::disk()->download($pathname);
        }else if(auth()->check() && auth()->user()->hasRole('etudiant') && $niveau_matiere == $niveau_user)  {
            $resource = Ressource::find($id); 
            $pathname= $resource->chemin;            
            return Storage::disk("java")->download($pathname);
        }else{
            abort(401, 'You are not allowed to access this page');
        }

    

}
        
    
   

    // pour ajouter une ressource
    public function add(Request $request){
        $user = Auth::user();
        if (!$user->hasRole('enseignant') && !$user->hasRole('administrateur')){
            abort(404);
        }

        $matiere = Matiere::find($request->matiere);

        // stocker le fichier dans le disk correspondant
        // on va faire un disque par matière
        $path = $request->file('ressource')->store(Str::snake($matiere->nom));
       
        $resource = new Ressource();
        $resource->chemin = $path;
        $resource->matiere_id = $request->matiere;
        $resource->nom = $request->file('ressource')->getClientOriginalName();
        $resource->save();

        // TODO: lister les étudiants de cette matière et leur notifier
        // qu'une ressource vient d'être mise en ligne

        // TODO: on redirige vers la page de détail de la matière
        return redirect("/matiere/$matiere->id")->with('succes','Fichier ajouté avec succès!');

    }
}
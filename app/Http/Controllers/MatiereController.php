<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Matiere;
use Illuminate\Support\Facades\Auth;

class MatiereController extends Controller
{
    //
    public function index(){
        return view('matieres.index');
    }
    
    public function show($id){
        $matiere = Matiere::find($id);
        $user = Auth::user();

       // dump($id);
        // dd(Matiere::find($id));
        return view('matieres.show', compact('matiere','user'));
    }

}

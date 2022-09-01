
 {{-- TODO: ce fichier est à supprimer si pas utilisé --}}
<h1>Liste des niveaux tenu par un professeur</h1>
<div>
    <strong>Liste des étudiants à faire pour l'utilisateur courant de role enseignant ou administrateur</strong>
    @foreach 
        ($matieres as $matiere)
        {{$matiere->libelle}}
    @endforeach
    if (auth()->check() && auth()->user()->hasRole('enseignant')||auth()->check() && auth()->user()->hasRole('administrateur'))
{
    Niveau::where('nom', '$nom')->first()->users()->get()
    
}
</div>

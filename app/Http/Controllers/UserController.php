<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Validator;

class UserController extends Controller
{
    //
    public function getValidation() {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'id_role' => 'required|numeric',
            'photo' => 'string|max:255',
            'dateNaissance' => 'date',
            'addresse' => 'string|max:255',
            'telephone' => 'numeric',
            'codeEmploye' => 'numeric',
            'email' => 'string|max:255',
            'password' => 'required|string|max:255'
        ], [
            'name.required' => 'Veuillez entrez un nom.',
            'prenom.required' => 'Veuillez entrez un prénom.',
            'id_role.required' => 'Veuillez attribuez un role.',
            'password.required' => 'Veuillez entrez le mot de passe.'
        ]);

        if ($validation->fails())
            return back()->withErrors($validation->errors())->withInput();

        return $validation->validated();
    }

    public function index(int $id_role) {
        return view('usersView', [
            'users' => User::where('id_role', '=', $id_role)->get()
        ]);
    }

    public function store(Request $request) {
        $validated = getValidation();

        $user = new User();
        $user->name = $validated['name'];
        $user->prenom = $validated['prenom'];
        $user->id_role = $validated['id_role'];
        $user->photo = $validated['photo'];
        $user->dateNaissance = $validated['dateNaissance'];
        $user->addresse = $validated['addresse'];
        $user->telephone = $validated['telephone'];
        $user->codeEmploye = $validated['codeEmploye'];
        $user->email = $validated['email'];
        $user->password = password_hash($validated['password'], PASSWORD_DEFAULT);


        if($user->save())
            session()->flash('succes', $user->name . ' a été ajouté(e) avec succès ! Bienvenu parmis SmileCare !');
        else
            session()->flash('erreur', 'La création de ' . $user->name . ' n\'a pas fonctionné.');

        //RETURN TO USER CREATE PAGE
    }

    public function update(Request $request, $id) {
        $user = User::findOrFail($id);

        $validated = getValidation();

        $user->update($validated->all());
    }

    public function destroy(User $user) {
        $oldName = $user->name;
        $user->delete();
        return back()->withSuccess($oldName . " a été supprimer avec succès !");
    }
}

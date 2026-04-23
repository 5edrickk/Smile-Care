<?php

namespace App\Http\Controllers;

use App\Models\Roles;
use App\Models\User;
use App\Models\RendezVous;
use App\Models\Services;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;

class UserController extends Controller
{
    //
    public function getValidation(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'id_role' => 'required|numeric',
            'dateNaissance' => 'date',
            'addresse' => 'string|max:255',
            'telephone' => 'numeric',
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

        $validated = $validation->validated();

        $returnValues = [
            'name' => $validated['name'],
            'prenom' => $validated['prenom'],
            'id_role' => $validated['id_role'],
            'dateNaissance' => $validated['dateNaissance'],
            'addresse' => $validated['addresse'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        return $returnValues;
    }

    public function index(int $id_role) {

        if(auth()->user() != null) {
            if(auth()->user()->id_role === 1 && $id_role === 2) {

                $users = [];

                foreach(User::all() as $user) {
                    if($user->id_role === 2 || $user->id_role === 3 || $user->id_role === 4) {
                        array_push($users, $user);
                    }
                }
                $unique = collect($users)->unique()->values()->all();
                return view('usersView', [
                    'users' => $unique,
                ]);
            }
            if(auth()->user()->id_role === 4) {

                $users = [];

                foreach(User::where('id_role', '=', $id_role)->get() as $user) {
                    foreach(RendezVous::where('id_dentiste', '=', auth()->user()->id)->get() as $rdv) {
                        if($user->id === $rdv->id_user) {
                            array_push($users, $user);
                        }
                    }
                }
                $unique = collect($users)->unique()->values()->all();
                return view('usersView', [
                    'users' => $unique,
                ]);
            }
        }
        else {
            return view('auth/login');
        }

        $users = User::where('id_role', '=', $id_role)->get();
        return view('usersView', [
            'users' => $users,
        ]);
    }

    public function store(Request $request) {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'id_role' => 'required|numeric',
            'dateNaissance' => 'date',
            'addresse' => 'string|max:255',
            'telephone' => 'numeric',
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

        $validated = $validation->validated();

        $user = new User();
        $user->name = $validated['name'];
        $user->prenom = $validated['prenom'];
        $user->id_role = $validated['id_role'];
        $user->dateNaissance = $validated['dateNaissance'];
        $user->addresse = $validated['addresse'];
        $user->telephone = $validated['telephone'];
        $user->email = $validated['email'];
        $user->password = password_hash($validated['password'], PASSWORD_DEFAULT);


        if($user->save())
            session()->flash('succes', $user->name . ' a été ajouté(e) avec succès ! Bienvenu parmis SmileCare !');
        else
            session()->flash('erreur', 'La création de ' . $user->name . ' n\'a pas fonctionné.');

        return back()->with('success', 'Le profile de ' . $user->name . ' a été ajouté avec succès !');
    }

    public function show(int $id) {
        $user = User::find($id);

        if($id >= 0) {
            return view('users/userEdit', [
                'user' => $user,
                'roles' => Roles::all(),
            ]);
        } else {
            return view('users/userAdd', [
                'roles' =>Roles::all(),
            ]);
        }
        return back()->with('error', 'Utilisateur non trouvé');
    }

    public function edit(Request $request, $id) {
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'id_role' => 'required|numeric',
            'dateNaissance' => 'date',
            'addresse' => 'string|max:255',
            'telephone' => 'numeric',
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

        $validated = $validation->validated();

        $returnValues = [
            'name' => $validated['name'],
            'prenom' => $validated['prenom'],
            'id_role' => $validated['id_role'],
            'dateNaissance' => $validated['dateNaissance'],
            'addresse' => $validated['addresse'],
            'telephone' => $validated['telephone'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ];

        $user = User::findOrFail($id);
        $oldName = $user->name;

        $user->update($returnValues);

        return back()->with('success', 'Le profile de ' . $oldName . ' a été modifié avec succès !');
    }

    public function destroy(int $id) {
        $user = User::find($id);
        $rdv = RendezVous::where('id_dentiste', '=', $id)->delete();

        $oldName = $user->name;
        $user->delete();
        return back()->withSuccess($oldName . " a été supprimer avec succès !");
    }
}

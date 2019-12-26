<?php

namespace App\Http\Controllers;

use Validator;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    
    public function index()
    {
        return [
            'data' => User::all(),
        ];
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ["name" => "required|string|max:300"]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); 
        }

        // Verificando a presença de Sobrenome
        $nomes = explode(" ", $request->name);
        if (count($nomes) < 2) {
            return [
                'error' => ['not_allowed' => 'Você precisa de um nome e um sobrenome'],
            ];
        }

        $user = new User;
        $user->name = $request->name;
        $user->save();

        return back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), ["userName" => "required|string|max:300"]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput(); 
        }

        // Verificando a presença de Sobrenome
        $nomes = explode(" ", $request->userName);
        if (count($nomes) < 2) {
            return [
                'error' => ['not_allowed' => 'Você precisa de um nome e um sobrenome'],
            ];
        }

        $user = User::find($request->userId);
        $user->name = $request->userName;
        $user->save();

        return back();
    }

    public function destroy(Request $request)
    { 
        $user = User::find($request->idUser);

        $user->delete();

        return back();
    }
}

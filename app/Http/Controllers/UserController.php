<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateUser;
use App\Models\User;
use Illuminate\Http\Request;
use Nette\Schema\Context;

class UserController extends Controller
{
    public function index(Request $request)
    {

        $search = $request->search;
        $users = User::where(function($query) use ($search){
            if($search){
                $query->where('email', $search);
                $query->orWhere('name', 'LIKE', "%{$search}%");
            }
        })->get();

        return view('users.index', ['users'=>$users]);
    }
    public function show($id)
    {

       // $user = User::where('id', $id)->first(); // Busca quando o id do Banco for ingual ao Id do parametro.
        if(!$user = User::find($id))
            return redirect()->route('users.index');

        return view('users.show', ['user'=>$user]);
    }
    public function create()
    {
        return view('users.create');
    }
    public function store(StoreUpdateUser $request)
    {

        $data = $request->all();
        $data['password'] = bcrypt($request->password); // Encriptografando a senha.

        User::create($data);

        return redirect()->route('users.index');
       /* dd($request->only([
            'name',
            'email',
            'password',
        ])); */

        // $user = new User;
        // $user->name = $request->name;
        // $user->email = $request->email;
        // $user->password = $request->password;
        // $user->save();

        
        //$user = User::create($data);

       // return redirect()->route('users.show', $user->id); Retornaria para a página de detalhes do usuário, passando o id do usuário recem criado como parametro no método show()
    }
    public function edit($id)
    {
        if(!$user = User::find($id))
            return redirect()->route('users.index');

        return view('users.edit', ['user'=> $user]);
    }
    public function update(StoreUpdateUser $request, $id)
    {
        if(!$user = User::find($id))
            return redirect()->route('users.index');

        $data = $request->only('name', 'email');
        if($request->password)
            $data['password'] = bcrypt($request->password);

        $user->update($data);

        return redirect()->route('users.index');
    }
    public function delete($id)
    {

       // $user = User::where('id', $id)->first(); // Busca quando o id do Banco for ingual ao Id do parametro.
        if(!$user = User::find($id))
            return redirect()->route('users.index');

        $user->delete();
        return redirect()->route('users.index');
    }
}

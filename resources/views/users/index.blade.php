@extends('layouts.app')

@section('content')
    
<h1>
    Listagem dos Usuários
    ( <a href="{{ route('users.create') }}">+Novo Usuário</a> )
</h1>


<form action="{{ route('users.index') }}" method="get">
    <input type="text" name="search" placeholder="Pesquisar">
    <button type="submit">Pesquisar</button>
</form>


<ul>
    @foreach($users as $user)
        
        <li> {{ $user->name }} </li>
        <li> {{ $user->email }} </li>
        | <a href="{{ route('users.show', ['id' => $user->id]); }}">Exibir</a>
        | <a href="{{ route('users.edit', ['id' => $user->id]); }}">Editar</a>
        <hr>
    @endforeach
</ul>

@endsection
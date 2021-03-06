@extends('layouts.app')

@section('content')

    <h1>Listagem do Usuário {{ $user->name }}</h1>

    <ul>
        <li> {{ $user->name }} </li>
        <li> {{ $user->email }} </li>
        <li> {{ $user->created_at }}</li>
    </ul>
    
    <form action="{{ route('users.delete', $user->id) }}" method="POST">
        @method('DELETE')
        @csrf
        <button type="submit">Deletar Usuário</button>
    </form>

@endsection


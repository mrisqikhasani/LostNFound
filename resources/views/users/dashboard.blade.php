@extends('layouts.app')
@section('content')
    <h1>Selamat Datang, {{ auth()->user()->name }}</h1>
    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit">Logout</button>
    </form>
@endsection


@extends('layout.app')
@section('title', 'Beranda')
@section('content')
    <div class="container-index">
        @if (session('username'))
            <h1>Selamat Datang {{ session('username') }}</h1>
        @endif
    </div>
@endsection

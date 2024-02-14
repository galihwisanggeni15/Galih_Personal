<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{!! asset('admin/admin.css') !!}">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
</head>

<body>
    <nav>
        <div class="jd">PEMINJAMAN</div>
        <div class="list" id="listnav">
            <a href="/admin/index"><i class="bi bi-house"></i> Beranda</a>
            <a href="/admin/barang"><i class="bi bi-cart"></i> Data Barang</a>
            <a href="/admin/data"><i class="bi bi-card-list"></i> Data Peminjaman</a>
            <a href="/admin/user"><i class="bi bi-person"></i> User</a>
            <div class="btn">
                <a href="/logout">Log Out</a>
            </div>
        </div>
        <div class="hb" onclick="navbarmb()">&#9776;</div>
    </nav>

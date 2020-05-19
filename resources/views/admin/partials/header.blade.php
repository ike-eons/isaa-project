<!DOCTYPE html>
<html lang="en">
<head>
    <title>@yield('title') - {{ config('app.name') }}</title>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/ionicons.min.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/adminlte.css') }}" />
    {{-- <link href="https://unpkg.com/ionicons@4.4.6/dist/css/ionicons.min.css" rel="stylesheet"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{asset('dist/css/alt/adminlte.css') }}" /> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/bootstrap.css') }}" /> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/main.css') }}" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/css/font-awesome/4.7.0/css/font-awesome.min.css') }}"/>
    
</head>
<body class="app sidebar-mini rtl">
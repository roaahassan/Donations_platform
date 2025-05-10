@extends('layouts.platform')

@section('content')
    <style>
        html, body {
            margin: 0;
            padding: 0;
            height: 100%;
        }
    </style>
    <main style="padding: 0; margin: 0; height: 100vh; overflow: hidden; background-image: url({{ asset('storage/sawaed.jpeg') }}); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <!-- Removed section to make the image cover the entire page -->
        <h1 style="text-align: center; color: white; font-size: 50px; padding-top: 20%; font-family: 'Cairo', sans-serif; height: 100%; display: flex; align-items: center; justify-content: center;">
            بادر بالتفريج... ينالك الأجر والتيسير
        </h1>
    </main>
@endsection
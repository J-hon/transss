<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('partials._head')
</head>

<body>

    @include('partials._sidebar')

    @include('partials._messages')

    @include('partials._loader')

    @yield('content')

    @include('partials._footer')

</body>

@include('partials._javascript')

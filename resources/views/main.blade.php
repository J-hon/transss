<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    @include('partials._head')
</head>

<body>

    @include('partials._nav')

    @include('partials._sidebar')

    @include('partials._messages')

    @include('partials._loader')

    @include('partials._back-to-top')

    @yield('content')

    @include('partials._footer')

</body>

@include('partials._javascript')

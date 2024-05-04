<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">

    <link rel="icon" type="image/png" href="{{ asset('uploads/favicon.png') }}">

    <title>Admin Panel</title>

    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @include('admin.layouts.styles')

    @include('admin.layouts.scripts')

</head>

<body>
<div id="app">
    <div class="main-wrapper">
        
        @if(!Request::is('admin/login') && !Request::is('admin/forget-password') && !Request::is('admin/reset-password/*/*'))
            @include('admin.layouts.nav')
            @include('admin.layouts.sidebar')
        @endif

        @yield('main_content')

    </div>
</div>

@include('admin.layouts.scripts-footer')

</body>
</html>
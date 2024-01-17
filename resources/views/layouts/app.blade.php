<!DOCTYPE html>
<html lang="en">
<script src="https://unpkg.com/htmx.org@1.9.10"
 crossorigin="anonymous"></script> 
 <!-- <link rel="stylesheet" href="https://unpkg.com/simpledotcss/simple.min.css"> -->
 <link id='style' rel="stylesheet" href="https://unpkg.com/missing.css@1.1.1">
<script>htmx.config.useTemplateFragments = true;</script>
<head>
    <title>{{ $list_name }}</title>
</head>
<body>
    <!-- Your navigation or header content -->
 <main>   
    @yield('content')
    
    <!-- Your footer or additional content Bar -->
<div>
    <a hx-get="{{ route('style', ['style' => 'simple']) }}" hx-swap=none >Simple CSS</a>
    <a hx-get="{{ route('style', ['style' => 'missing']) }}" hx-swap=none>Missing CSS</a>
    <a hx-get="{{ route('style', ['style' => 'sakura']) }}" hx-swap=none>Sakura CSS</a>
</div>
</main>
</body>
</html>
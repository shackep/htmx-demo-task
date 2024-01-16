<!DOCTYPE html>
<html lang="en">
<script src="https://unpkg.com/htmx.org@1.9.10"
 crossorigin="anonymous"></script> 
 <!-- <link rel="stylesheet" href="https://unpkg.com/simpledotcss/simple.min.css"> -->
 <link rel="stylesheet" href="https://unpkg.com/missing.css@1.1.1">
<script>htmx.config.useTemplateFragments = true;</script>
<head>
    <title>{{ $list_name }}</title>
</head>
<body>
    <!-- Your navigation or header content -->
    
    @yield('content')
    
    <!-- Your footer or additional content Bar -->
</body>
</html>
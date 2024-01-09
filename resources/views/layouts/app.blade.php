<!DOCTYPE html>
<html lang="en">
<script src="https://unpkg.com/htmx.org@1.9.10"
 crossorigin="anonymous"></script> 
 <link rel="stylesheet" href="https://unpkg.com/simpledotcss/simple.min.css">
<script>htmx.config.useTemplateFragments = true;</script>

<body>
    <!-- Your navigation or header content -->
    
    @yield('content')
    
    <!-- Your footer or additional content Bar -->
</body>
</html>
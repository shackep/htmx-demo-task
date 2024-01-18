<!DOCTYPE html>
<html lang="en">
<head>
<script src="https://unpkg.com/htmx.org@1.9.10"
 crossorigin="anonymous"></script> 
 <script>htmx.config.useTemplateFragments = true;</script>

 <!-- <link hx-get="{{ route('style', ['style' => 'simple']) }}" hx-trigger=load hx-target=this hx-swap='outerHTML' id='style' rel="stylesheet" href="https://unpkg.com/missing.css@1.1.1"> -->


    <title>{{ $list_name }}</title>
    <link id='style' rel="stylesheet" href="https://unpkg.com/missing.css@1.1.1">
</head>
<body>
    <!-- Your navigation or header content -->
 <main>   
    @yield('content')
    
    <!-- Your footer or additional content Bar -->
<div>
<label for="styleSelect">Style</label>
    <select id="styleSelect" hx-get="" hx-on="htmx:configRequest: event.detail.path = this.value" hx-trigger='change' hx-swap='none'>
        <option value="{{ route('style', ['style' => 'simple']) }}" {{ $style == 'simple' ? 'selected' : '' }}>Simple CSS</option>
        <option value="{{ route('style', ['style' => 'missing']) }}" {{ $style == 'missing' ? 'selected' : '' }}>Missing CSS</option>
        <option value="{{ route('style', ['style' => 'sakura']) }}" {{ $style == 'sakura' ? 'selected' : '' }}>Sakura CSS</option>
    </select>
    <input type='hidden' hx-get="{{ route('style', ['style' => $style ?? 'simple']) }}" hx-trigger='load' hx-swap=none>
</div>
</main>
</body>
</html>
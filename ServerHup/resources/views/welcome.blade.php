<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('Css/home.css') }}">
    <title>Server Hup</title>
</head>
<body>
    <div class="container">
        <x-nav/>
    </div>

    <p id="welcome">
    @foreach(explode(' ', __('messages.welcome')) as $index => $word)
        <span style="animation-delay: {{ $index * 0.5 }}s">{{ $word }}</span>
    @endforeach
</p>

</body>
</html>


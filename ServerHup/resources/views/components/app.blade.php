<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="utf-8">
    <title>{{ __('messages.welcome') }}</title>

</head>
<body>
    <!-- navbar, content ... -->
     <x-navbar/>
</body>
</html>

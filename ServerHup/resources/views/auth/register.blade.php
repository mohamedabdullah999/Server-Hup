<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="{{ url('Css/home.css') }}">
</head>
<body>
    <x-nav/>
    <h1 id="reghead">{{__('messages.registration')}} </h1>
    <div class="reg">
    <form action="/register" method="POST">
    @csrf

    <label for="name">{{__('messages.name')}}</label>
    <input id="name" name="name" type="text" value="{{ old('name') }}" >
    @error('name')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="email">{{__('messages.enemail')}}</label>
    <input id="email" name="email" type="text" placeholder="xxxxx@example.com" value="{{ old('email') }}" >
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="password">{{__('messages.enpassword')}}</label>
    <input type="password" id="password" name="password" required>
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="password_confirmation">{{__('messages.conpassword')}}</label>
    <input type="password" id="password_confirmation" name="password_confirmation" >
    @error('password_confirmation')
        <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit" class="submit-btn">{{__('messages.register')}}</button>
</form>


    <img src="/security_images/20190929195317539.jpg" alt="Security image">
</div>

</body>
</html>

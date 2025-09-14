<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ url('Css/home.css') }}">
</head>
<body>
    <x-nav/>
    <h1 id="reghead">{{__('messages.login')}} </h1>
    <div class="reg">
    <form action="/login" method="POST">
    @csrf
    <label for="email">{{__('messages.enemail')}}</label>
    <input id="email" name="email" type="text" placeholder="xxxxx@example.com" value="{{ old('email') }}" >
    @error('email')
        <div class="error">{{ $message }}</div>
    @enderror

    <label for="password" id="logpass">{{__('messages.enpassword')}}</label>
    <input type="password" id="password" name="password" required>
    @error('password')
        <div class="error">{{ $message }}</div>
    @enderror

    <button type="submit" class="submit-btn" id="logbtn">{{__('messages.login')}}</button>
</form>


    <img src="/security_images/20190929195317539.jpg" alt="Security image">
</div>

</body>
</html>

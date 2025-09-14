<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Server</title>
    <link rel="stylesheet" href="{{ url('Css/home.css') }}">
</head>
<body>
      <div class="container">
        <x-nav/>
    </div>
    <div class="reg">
    <form action="{{ route('servers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h2 id="reghead">{{ __('messages.create_server') }}</h2>

        <label for="name">{{ __('messages.server_name') }}</label>
        <input type="text" name="name" id="name" placeholder="{{ __('messages.enter_server_name') }}"
               value="{{ old('name') }}" required>
        @error('name')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="description">{{ __('messages.description') }}</label>
        <textarea name="description" id="description" placeholder="{{ __('messages.enter_description') }}" required>{{ old('description') }}</textarea>
        @error('description')
            <p class="error">{{ $message }}</p>
        @enderror

        <label for="image">{{ __('messages.server_image') }}</label>
        <input type="file" name="image" id="image" accept="image/*">
        @error('image')
            <p class="error">{{ $message }}</p>
        @enderror

        <button type="submit" class="submit-btn">{{ __('messages.submit') }}</button>
    </form>
</div>

</body>
</html>

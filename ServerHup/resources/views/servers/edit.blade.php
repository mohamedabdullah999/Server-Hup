<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.edit_server') }}</title>
    <link rel="stylesheet" href="{{ url('Css/edit.css') }}">
</head>
<body>
    <div class="container">
        <x-nav/>
    </div>

    <div class="reg" id="edit-form">
        <form action="{{ route('servers.update',$server->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h2 id="reghead">{{ __('messages.edit_server') }}</h2>

            <label for="name">{{ __('messages.server_name') }}</label>
            <input type="text" name="name" id="name" value="{{ old('name', $server->name) }}" required>
            @error('name')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="description">{{ __('messages.description') }}</label>
            <textarea name="description" id="description" required>{{ old('description', $server->description) }}</textarea>
            @error('description')
                <p class="error">{{ $message }}</p>
            @enderror

            <label for="image">{{ __('messages.server_image') }}</label>
            <input type="file" name="image" id="image" accept="image/*">
            @error('image')
                <p class="error">{{ $message }}</p>
            @enderror

            @if($server->image)
                <div class="image-preview">
                    <p>{{ __('messages.current_image') }}:</p>
                    <img src="{{ $server->image }}" alt="{{ $server->name }}" class="preview-img">
                </div>
            @endif

            <div class="form-actions">
                <a href="/servers" class="cancel-btn">{{ __('messages.cancel') }}</a>
                <button type="submit" class="update-btn">{{ __('messages.update_server') }}</button>
            </div>
        </form>

        <form action="{{ route('servers.destroy', $server->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn">{{ __('messages.delete_server') }}</button>
        </form>
    </div>
</body>
</html>

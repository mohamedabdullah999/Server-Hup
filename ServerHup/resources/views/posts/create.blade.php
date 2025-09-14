<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('Css/createPost.css') }}">
    <title>{{ __('messages.create_post') }} - {{ $server->name }}</title>
</head>
<body>
    <div class="container">
        <x-nav/>
    </div>
    <div class="form-container">
        <h2>{{ __('messages.create_post') }} in "{{ $server->name }}"</h2>
        <form action="{{ route('posts.store', $server->id) }}" method="POST">
            @csrf

            <label>{{ __('messages.title') }}</label>
            <input type="text" name="title" value="{{ old('title') }}" required>
            @error('title')<p class="error">{{ $message }}</p>@enderror

            <label>{{ __('messages.content') }}</label>
            <textarea name="content" required>{{ old('content') }}</textarea>
            @error('content')<p class="error">{{ $message }}</p>@enderror

            <label>{{ __('messages.category') }}</label>
            <select name="category_id">
                <option value="">{{ __('messages.no_category') }}</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="btn btn-add-post">{{ __('messages.create_post') }}</button>
        </form>
    </div>
</body>
</html>

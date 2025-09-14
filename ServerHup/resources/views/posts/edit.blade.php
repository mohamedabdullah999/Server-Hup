<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('Css/changePost.css') }}">
    <title>{{ __('messages.edit_post') }} - {{ $post->title }}</title>
</head>
<body>
<div class="container">
    <x-nav/>
</div>

<div class="form-container">
    <h2>{{ __('messages.edit_post') }}</h2>
    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label>{{ __('messages.title') }}</label>
        <input type="text" name="title" value="{{ old('title', $post->title) }}" required>
        @error('title')<p class="error">{{ $message }}</p>@enderror

        <label>{{ __('messages.content') }}</label>
        <textarea name="content" required>{{ old('content', $post->content) }}</textarea>
        @error('content')<p class="error">{{ $message }}</p>@enderror

        <label>{{ __('messages.category') }}</label>
        <select name="category_id">
            <option value="">{{ __('messages.no_category') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $post->category_id == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-edit">{{ __('messages.update_post') }}</button>
    </form>
</div>
</body>
</html>

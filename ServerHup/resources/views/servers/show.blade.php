<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $server->name }} - {{ __('messages.server') }}</title>
    <link rel="stylesheet" href="{{ url('Css/editPost.css') }}">
</head>
<body>
<div class="container">
    <x-nav/>
</div>

<div class="server-details-container">
    <h2>{{ $server->name }}</h2>
    <p><strong>{{ __('messages.description') }}:</strong> {{ $server->description }}</p>
    <p><strong>{{ __('messages.owner') }}:</strong> {{ $server->owner->name }}</p>

    {{-- Create Post button (for admin) --}}
    @can('edit-server', $server)
        <a href="{{ route('posts.create', $server->id) }}" class="btn btn-add-post">{{ __('messages.create_post') }}</a>
    @endcan

    {{-- Filter by Category --}}
    <form action="" method="GET" class="filter-category">
        <label for="category">{{ __('messages.filter_by_category') }}:</label>
        <select name="category_id" id="category" onchange="this.form.submit()">
            <option value="">{{ __('messages.all_categories') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </form>

    @forelse($posts as $post)
        <div class="post-card">
            <h4>{{ $post->title ?? __('messages.no_title') }}</h4>
            <p>{{ $post->content }}</p>
            <p><strong>{{ __('messages.category') }}:</strong> {{ $post->category->name ?? __('messages.no_category') }}</p>
            <small>{{ __('messages.by') }}: {{ $post->user->name }}
                @if($post->user->id == $server->created_by)
                    <span class="admin-badge">{{ __('messages.admin') }}</span>
                @endif
            </small>

            <div class="post-actions">
                @can('edit-post', $post)
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-edit">{{ __('messages.edit') }}</a>
                    @endcan

                @can('delete-post', $post)
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-delete">{{ __('messages.delete') }}</button>
                    </form>
                @endcan
            </div>

            <div class="comments-section">
                <h5>{{ __('messages.comments') }}</h5>
                @forelse($post->comments as $comment)
                    <div class="comment">
                        <p>{{ $comment->content }}</p>
                        <small>{{ __('messages.by') }}: {{ $comment->user->name }}
                            @if($comment->user->id == $server->created_by)
                                <span class="admin-badge">{{ __('messages.admin') }}</span>
                            @endif
                        </small>
                    </div>
                @empty
                    <p>{{ __('messages.no_comments_yet') }}</p>
                @endforelse

                @auth
                    <form action=" {{ route('comments.store', $post->id) }}" method="POST" class="add-comment-form">
                        @csrf
                        <input type="text" name="content" placeholder="{{ __('messages.add_comment') }}" required>
                        <button type="submit" class="btn btn-add-comment">{{ __('messages.comment') }}</button>
                    </form>
                @endauth
            </div>
        </div>
    @empty
        <p>{{ __('messages.no_posts_yet') }}</p>
    @endforelse

    <div class="pagination-container">
        {{ $posts->links() }}
    </div>
</div>
</body>
</html>

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}" dir="{{ app()->getLocale() === 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ url('Css/home.css') }}">
    <title>Servers</title>
</head>
<body>
    <div class="container">
        <x-nav/>
    </div>
    @can('create-server')
        <a href="{{ route('servers.create') }}" class="btn create-server">{{ __('messages.create_server') }}</a>
    @endcan

    <div class="servers-container">
        @foreach($servers as $server)
            <div class="server-card">
                <div class="server-card-content">
                    <div class="server-image">
                        <img src="{{ $server->image }}" alt="{{ $server->name }}" class="server-img">
                    </div>
                    <div class="server-details">
                        <h3 class="server-name">{{ $server->name }}</h3>
                        <p class="server-owner"><strong>{{ __('messages.owner') }}:</strong> {{ $server->owner->name }}</p>
                        <p class="server-desc"><strong>{{ __('messages.description') }}:</strong> {{ $server->description }}</p>
                        <p class="server-posts"><strong>{{ __('messages.posts') }}:</strong> {{ $server->posts->count() }}</p>

                        <div class="server-actions">
                            @if(in_array($server->id, $relatedServersUser))
                                <button class="btn joined" disabled>{{ __('messages.joined') }}</button>
                                <a href="{{ route('servers.show',$server->id) }}" class="btn view">{{ __('messages.view_server') }}</a>

                                @if(auth()->id() === $server->owner->id)
                                    <a href="{{ route('servers.edit', $server->id) }}" class="btn edit">{{ __('messages.edit_server') }}</a>
                                @endif

                                @else
                                    <form action="{{ route('servers.join' , $server->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn join">{{ __('messages.join') }}</button>
                                    </form>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="btn paginate">
            {{ $servers->links() }}
    </div>
    </body>
</html>

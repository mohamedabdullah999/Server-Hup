<nav>
            <span>Server Hub</span>
            <div class="links">
                <x-nav-link href="/" :active="request()->is('/')">{{__('messages.home')}}</x-nav-link>
                <x-nav-link href="/servers" :active="request()->is('/servers')">{{__('messages.server')}}</x-nav-link>
            </div>
            @guest
            <div class="guest">
                <x-nav-link href="{{route('kick.google')}}">{{__('messages.googleSignIn')}}</x-nav-link>
                <x-nav-link href="{{route('login')}}">{{__('messages.login')}}</x-nav-link>
                <x-nav-link href="{{route('register.show')}}">{{__('messages.register')}}</x-nav-link>
            </div>
            @endguest
            @auth
                <form action="{{route('logout')}}" method="POST">
                    @csrf
                    <button class="logout" type="submit">{{__('messages.logout')}}</button>
                </form>
            @endauth
            <div class="lang">
                <x-nav-link href="{{route('lang.change' , ['lang' => 'ar'])}}">Arabic</x-nav-link>
                <x-nav-link href="{{route('lang.change' , ['lang' => 'en'])}}">English</x-nav-link>
            </div>
</nav>

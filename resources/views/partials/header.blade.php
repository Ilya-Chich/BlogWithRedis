<nav class="navbar navbar-expand-lg alert-info rounded">
    <a class="navbar-brand" href="http://blog.local/"></a>
    <div class="collapse navbar-collapse">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropleft">
                <a class="nav-link dropdown-toggle" id="dropdown09" data-toggle="dropdown"
                   aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name ?? "Login" }}
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdown09">
                    @guest
                        <a class="dropdown-item" href="{{ route('register') }}">Sign up</a>
                        <a class="dropdown-item" href="{{ route('login') }}">Sign in</a>
                    @else
                        <a class="dropdown-item" href="{{ route('home') }}">Create Post</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                            Logout
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </li>
        </ul>
    </div>
</nav>

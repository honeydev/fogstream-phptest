<div class="container">
    <div class="row">
        <ul class="nav">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('/') }}">News</a>
            </li>
            @auth
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('news.add') }}">Add news</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile') }}">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('logout') }}">Logout</a>
                </li>
            @endauth
            @guest
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('login') }}">Log in</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('register') }}">Register</a>
                </li>
            @endguest
        </ul>
    </div>
</div>

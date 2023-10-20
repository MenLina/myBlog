<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
    <h5 class="my-0 mr-md-auto font-weight-normal"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Blog</font></font></h5>
    <nav class="my-2 my-md-0 mr-md-3 d-flex">
        <a class="p-2 text-dark" href="{{ route('home') }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Home</font></font></a>
        <a class="p-2 text-dark" href="{{ route('about') }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">About us</font></font></a>
        <ul class="navbar-nav ms-auto d-flex flex-md-row">
            <!-- Authentication Links -->
            @guest
                @if (Route::has('login'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login/') }}</a>
                    </li>
                @endif

                @if (Route::has('register'))
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                    </li>
                @endif
            @else
                <li class="nav-item dropdown d-flex flex-md-row">
                    <a id="navbarDropdown" class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ Auth::user()->name }}
                    </a>

                    <div class="dropdown-menu dropdown-menu-end p-1" aria-labelledby="navbarDropdown" style="display: block; min-width: 4rem; margin-left: 1em">
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: block">
                            @csrf
                        </form>
                    </div>
                </li>
            @endguest
        </ul>
{{--        <a class="btn btn-success" href="{{ route('login') }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">login</font></font></a>--}}
{{--        <a class="btn btn-outline-primary" href="{{ route('register') }}"><font style="vertical-align: inherit;"><font style="vertical-align: inherit;">Register</font></font></a>--}}
    </nav>
</div>

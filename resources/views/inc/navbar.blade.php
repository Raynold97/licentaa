{{-- <nav class="navbar navbar-expand-md navbar-dark bg-dark shadow-sm fixed-top" > --}}

    <nav class="navbar navbar-expand-md navbar-dark bg-dark fixed-top" >
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">
            {{ config('app.name', 'Licenta') }}
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <!-- Left Side Of Navbar -->
            <ul class="navbar-nav mr-auto">
                 
            </ul>
            <ul class="navbar-nav mr-auto">
              {{-- <li class="nav-item active">
                <a  class="nav-link" href="/">Index</a>
              </li> --}}
              <li class="nav-item">
                <a  class="nav-link" href="/continut">Blog</a>
              </li>
              @Auth
              <li class="nav-item">
                <a class="nav-link" href="/continut/create" style="color: rgb(245, 62, 7); font-style: inherit;font-weight: bold">Creeaza o postare</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/keywords" style="color: rgb(0, 146, 134); font-style: inherit;font-weight: bold">Keywords</a>
              </li>
              @endAuth
            </ul>
             

            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                    @endif
                    
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                        </li>
                    @endif
                @else

                      {{-- @include('inc.search')   --}}
                    {{-- <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ Auth::user()->name }}
                        </a> --}}
                       
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                
                                 <img src="/images/{{Auth::user()->imagine }}" style= "height:30px; width:30px; border-radius:50px; margin-right:15px" alt=""> 
                                
                                {{ Auth::user()->UserName }}
                              </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route('profile') }}" ><i class="glyphicon glyphicon-user"></i><b>Profil</b></a>
                            <a class="dropdown-item" href="/pages/index">Dashboard</a>
                            <a class="dropdown-item" href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                             document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
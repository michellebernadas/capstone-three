  <nav class="navbar navbar-expand-lg fixed-top navbar-white bg-nav navbar-laravel">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars navbar-toggler-icon"></i>
  </button>
  <a class="navbar-brand" href="/"><img src="{{URL::asset('images/logo_white.png')}}"></a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mx-auto">
     {{--  <li class="nav-item">
        <a class="nav-link" href="#">I'm New</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Find a Church</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Who We Are</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Bible</a>
      </li> --}}
      <li class="nav-item">
        <a class="nav-link" href="/forum">Forum</a>
      </li>
      </ul>
     <ul class="nav navbar-nav">
          @guest
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
              </li>
              <li class="nav-item">
                  <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
              </li>
          @else
            {{--   <li class="nav-item">
                <a class="nav-link"><img class="message" src="{{URL::asset('images/message.png')}}">Inbox</a>
              </li>
              <li class="nav-item">
                <a class="nav-link"><img class="notif" src="{{URL::asset('images/notif.png')}}">Alerts</a>
              </li> --}}
              <li class="nav-item">
                <a class="nav-link"><img class="user_image" src="/{{Auth::user()->image }}"
                  onerror="this.onerror=null;this.src='{{URL::asset('images/placeholder.jpg')}}'"></a>
              </li>
              <li class="nav-item dropdown" id="drop">
                  {{-- <span><img src="uploads/images/{{ Auth::user()->image }}"></span> --}}
                  <a id="navbarDropdown" class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"e>
                      {{ Auth::user()->username }} <span class="caret"></span>
                  </a>

                  <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                      <a class="dropdown-item" href="{{ route('logout') }}"
                         onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                          {{ __('Logout') }}
                      </a>
                      <a href="/user" class="dropdown-item">Account Settings</a>
                      <!--<a class="dropdown-item">News Feeds</a>-->
                      <!--<a class="dropdown-item">Messages</a>-->

                      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                          @csrf
                      </form>
                  </div>
              </li>
          @endguest
      </ul>

  </div>
</nav>
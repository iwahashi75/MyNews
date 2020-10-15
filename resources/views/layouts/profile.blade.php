<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
      <!-- CSRF Token -->
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>@yield('title')</title>
      
      <script src="{{ secure_asset('js/app.js') }}" defer></script>
      
      <!-- Fonts -->
      <link rel="dns-prefetch" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">
      
      <!--Styles-->
       <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
       <link href="{{ secure_asset('css/profile.css') }}" rel="stylesheet">
    </head>
    <body>
        <div id="app">
              <nav class="navbar navbar-expand-md navbar-dark navbar-laravel">
                <div class="container">
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                          <!-- Left Side Of Navbar -->
                          <ul class="navbar-nav mr-auto">
                          </ul>
                          
                          <!-- Right Side Side Of Navbar -->
                           <ul class="navbar-nav ml-auto">
                             
                             {{-- 以下を追記 --}}
                                <!-- Authebtication Links -->
                                {{-- ログインしていなかったらログイン画面へのリンクを表示 --}}
                                @guwst
                                  <li><a class="nav-link" href="{{ route('login') }}">{{ __('login') }}</a></li>
                                  {{-- ログインしていたらユーザー名とログアウトボタンを表示--}}
                                @else  
                                  <li class="nav-item dropdowon">
                                    <a id="navbaeDropdown" class=I "nav-link doropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-per>
                                        {{ Auth::user()->name }} <span class="caret"></span>
                                    </a>
                                    
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                      <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout').submit();">
                                          {{ __('Logout') }}
                                      </a>
                                      
                                      <form id="logout-form" action=was "{{ route('logout') }}" method="POST" sryle="display: none;">
                                          @csrf
                                        </form>
                                      </div>
                                  </li>
                                  @endguest
                                  {{-- 以上までを追記 --}}
                        </ul>
                    </div>
                </div>
            </nav>
                {{-- ここまでナビゲーションバー --}}
                
                <main class="py-4">
                {{-- コンテンツをここに入れるため、@yieldで空けておきます。 --}}
                    @yield('content')
                </main>
            </div>
        </body>
</html>
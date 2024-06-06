       <header id="header" id="home">
            <div class="container">
                <div class="row header-top align-items-center">
                    <div class="col-lg-4 col-sm-4 menu-top-left">
                        <span>
                            We believe we helps people <br>
                            for happier lives
                        </span>
                    </div>
                    <div class="col-lg-4 menu-top-middle justify-content-center d-flex">
                        <a href="index.html">
                            <img class="img-fluid" src="{{ asset('front-assets') }}/img/logo.png" alt="">
                        </a>
                    </div>
                    <div class="col-lg-4 col-sm-4 menu-top-right">
                        <a class="tel" href="tel:+880 123 12 658 439">+880 123 12 658 439</a>
                        <a href="tel:+880 123 12 658 439"><span class="lnr lnr-phone-handset"></span></a>
                    </div>
                </div>
            </div>
                <hr>
            <div class="container">
                <div class="row align-items-center justify-content-center d-flex">
                  <nav id="nav-menu-container">
                    <ul class="nav-menu">
                      <li class="menu-active"><a href="{{ route('home') }}">Home</a></li>
                      {{--
                        <li><a href="#offer">we offer</a></li>
                        <li><a href="#schedule">Schedule</a></li>
                        <li><a href="#plan">Plan</a></li> --}}
                        @guest

                        <li><a href="{{ route('login') }}">login</a></li>
                        <li><a href="{{ route('register') }}">register</a></li>
                        @endguest
                        <li><a href="{{ route('subscribe.history') }}">subscription history</a></li>
                        <li><a href="{{ route('subscribe.currentPlan') }}">current plan</a></li>
                        @auth
                      <li>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit">

                            log out
                        </button>
                    </form>
                    </li>
                      @endauth

                    </ul>
                  </nav><!-- #nav-menu-container -->
                </div>
            </div>
          </header><!-- #header -->

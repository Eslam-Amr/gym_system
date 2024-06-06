<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gym System</title>
    <link rel="stylesheet" href="{{ asset('userAuth') }}/style.css">
</head>

<body>
    <div class="container">
        <header>
            <a style="text-decoration: none;color: white;margin-right: 15px;margin-left: 15px" href="{{ route('home') }}">

                {{ __('keywords.gymSystem') }}
            </a>
            <a style="text-decoration: none;color: white; margin-left: 15px;margin-right: 15px" href="{{ route('login') }}">
                {{ __('keywords.login') }} </a>
        </header>        <div class="screen">
            <form method="POST" action="{{ route('register') }}">
                @csrf
                <div class="screen__content">
                    <div class="login">
                        <h2>{{ __('keywords.register') }} </h2>
                        <div class="login__field">

                            <i class="login__icon fas fa-user"></i>
                            <input id="name" type="text" name="name" class="login__input" value="{{ old('name') }}"
                                placeholder=" {{ __('keywords.name') }}">
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>
                        <div class="login__field">

                            <i class="login__icon fas fa-user"></i>
                            <input id="email" type="text" name="email" class="login__input" value="{{ old('email') }}"
                                placeholder="{{ __('keywords.email') }}">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password" id="password" name="password" class="login__input"
                                placeholder="{{ __('keywords.password') }}">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>
                        <div class="login__field">
                            <i class="login__icon fas fa-lock"></i>
                            <input type="password_confirmation" id="password_confirmation" name="password_confirmation" class="login__input"
                                placeholder="{{ __('keywords.password_confirmation') }}">
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                        </div>
                        <button type="submit" class="login__submit">
                            <span class="button__text">{{ __("keywords.register") }}</span>
                            <i class="button__icon fas fa-chevron-right"></i>
                        </button>
                    </div>
                    {{-- <div class="social-login">
                        <h3>log in via</h3>
                        <div class="social-icons">
                            <a href="#" class="social-login__icon fab fa-instagram"></a>
                            <a href="{{ route('facebookLogin') }}" class="social-login__icon fab fa-facebook"></a>
                            <a href="#" class="social-login__icon fab fa-twitter"></a>
                        </div>
                    </div> --}}
                </div>
                <div class="screen__background">
                    <span class="screen__background__shape screen__background__shape1"></span>
                    <span class="screen__background__shape screen__background__shape2"></span>
                    <span class="screen__background__shape screen__background__shape3"></span>
                    <span class="screen__background__shape screen__background__shape4"></span>
                </div>
            </form>
        </div>
    </div>
</body>

</html>

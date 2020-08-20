@extends('layouts.auth')

@section('content')
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header justify-content-center">
                                <h3 class="font-weight-light my-4">Login</h3>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="form-group"><label class="small mb-1"
                                            for="email">{{ __('E-mail Address') }}</label><input
                                            class="form-control py-4 @error('email') is-valid @enderror" id="email"
                                            type="email" name="email" value="{{ old('email') }}"
                                            placeholder="Enter email address" required autocomplete="email" autofocus />

                                        @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group"><label class="small mb-1"
                                            for="Password">{{ __('Password') }}</label><input
                                            class="form-control py-4 @error('password') is-valide @enderror"
                                            name="password" id="Password" type="password" placeholder="Enter password"
                                            required autocomplete="current-password" />

                                        @error('password')
                                        <span class="invalide-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox"><input class="custom-control-input"
                                                id="rememberPasswordCheck" type="checkbox"
                                                {{ old('remember') ? 'checked' : '' }} /><label
                                                class="custom-control-label"
                                                for="rememberPasswordCheck">{{ __('Remember Me') }}</label></div>
                                    </div>


                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">

                                        @if (Route::has('password.request'))
                                        <a class="small"
                                            href="{{ route('password.request') }}">{{ __('Forgot Your Password') }}</a>
                                        @endif

                                        <button type="submit" class="btn btn-primary">{{ __('login') }}</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="footer mt-auto footer-dark">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6 small">Copyright &#xA9; Your Website 2020</div>
                    <div class="col-md-6 text-md-right small">
                        <a href="#!">Privacy Policy</a>
                        &#xB7;
                        <a href="#!">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
@endsection
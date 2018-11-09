@extends('news.layouts.news')
@section('content')
    {!! NoCaptcha::renderJs() !!}

    {{ var_dump($errors) }}
    <div class="container">
        <div class="row">
            <form class="mx-auto registerForm" method="POST" action="{{ route('register') }}">
                @csrf

                @if ($errors->has('email'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('email') }}
                    </div>
                @endif
                @if ($errors->has('password'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('password') }}
                    </div>
                @endif

                @if ($errors->has('g-recaptcha-response'))
                    <div class="alert alert-danger" role="alert">
                        {{ $errors->first('g-recaptcha-response') }}
                    </div>
                @endif
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }} form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }} form-control" id="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="passwordConfirm">Password repeat</label>
                    <input type="password" name="password_confirmation" class="{{ $errors->has('password') ? 'is-invalid' : '' }} form-control" id="password_confirm" placeholder="Password repeat" required>
                </div>
                {!! NoCaptcha::display() !!}
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection

@extends('news.layouts.news')
@section('content')
{!! NoCaptcha::renderJs() !!}
<div class="container">
    <div class="row">
        <form class="mx-auto loginForm" method="POST" action="{{ route('login') }}">
            @csrf
            @if ($errors->has('email'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('email')  }}
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
                <input name="email" type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}" id="password" placeholder="Password">
            </div>
            <div class="form-check">
                <input type="checkbox" class="form-check-input" id="rememberCheckbox">
                <label class="form-check-label" for="rememberCheckbox">Check me out</label>
            </div>
            {!! NoCaptcha::display() !!}
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

    </div>
</div>
@endsection

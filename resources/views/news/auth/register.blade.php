@extends('news.layouts.news')
@section('content')
    <div class="container">
        <div class="row h-50">
            <form class="mx-auto registerForm" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group">
                    <label for="email">Email address</label>
                    <input name="email" type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" class="form-control" id="password" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="passwordConfirm">Password repeat</label>
                    <input type="password" name="password-confirmation" class="form-control" id="passwordConfirm" placeholder="Password repeat">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection

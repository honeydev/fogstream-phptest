@extends('news.layouts.news')

@section('content')
<style>
    .profile {
        margin-top: 40px;
        margin-bottom: 40px;
    }

    .
</style>
<div class="container">
    <div class="row profile">
        <div class="col-2 offset-3">
            <img src="images/user.png" class="rounded float-left" alt="Avatar">
        </div>
        <div class="col-4">
            <ul>
                <li>Email: devspades@gmail.com</li>
                <li>Name: </li>
                <li>Birthday: 09.09.1991</li>
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-10 text-center">
            <a href="{{ url('/profile') }}/update" class="btn btn-primary">Update profile</a>
        </div>
    </div>
</div>
@endsection
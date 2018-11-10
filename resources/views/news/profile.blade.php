@extends('news.layouts.news')

@section('content')

<div class="container">
    <div class="row profile">
        <div class="col-8 offset-2">
            <div class="row">
                <div class="col-2 offset-1">
                    <img src="{{ $avatar->getUrl() }}" class="rounded float-left profileAvatar" alt="Avatar">
                </div>
                <div class="col-4 offset-2">
                    <ul class="list-unstyled">
                        <li>Email: {{ $user->email }}</li>
                        <li>Name: {{ $user->name }} </li>
                        <li>Birthday: {{ $user->getBirthday()->day }}.{{ $user->getBirthday()->month }}.{{ $user->getBirthday()->year }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-10 text-center">
            <a href="{{ url('/profile') }}/update" class="btn btn-primary">Update profile</a>
        </div>
    </div>
</div>
@endsection

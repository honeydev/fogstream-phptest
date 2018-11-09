@extends('news.layouts.news')
@section('content')
    {{var_dump($errors) }}
<div class="container">
    <div class="row">
        <form class="mx-auto profileForm" method="post" action="{{ route('profile.store') }}" enctype='multipart/form-data'>
            @csrf
             <div class="form-group">
                <label for="nameInput">Name</label>
                <input name="name" type="text" class="form-control" id="nameInput" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="nameInput">Birthday date</label>
                <input name="birthday" class="form-control" type="date" value="{{ $user->birthday_date }}" id="example-date-input">
            </div>
            <div class="form-group">
                <label for="nameInput">Avatar</label>
                <div class="custom-file">
                    <input name="avatar" type="file" class="custom-file-input" id="inputGroupFile01">
                    <label  class="custom-file-label" for="inputGroupFile01">Select avatar</label>
                </div>
            </div>
            <div class="row">
                <div class="col-10 text-center">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

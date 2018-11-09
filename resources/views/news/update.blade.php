@extends('news.layouts.news')
@section('content')
<style>
    .profileForm {
        margin-top: 40px;
    }
</style>
<div class="container">
    <div class="row">
        <form class="mx-auto profileForm" method="POST" action="{{ url('profile/update/new') }}">
             <div class="form-group">
                <label for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="nameInput">Birthday date</label>
                <input class="form-control" type="date" value="2011-08-19" id="example-date-input">
            </div>
            <div class="form-group">
                <label for="nameInput">Avatar</label>
                <div class="custom-file">
                    <input type="file" class="custom-file-input" id="inputGroupFile01">
                    <label class="custom-file-label" for="inputGroupFile01">Select avatar</label>
                </div>
            </div>
            <div class="row">
                <div class="col-10 text-center">
                    <a href="{{ url('/profile') }}/update" class="btn btn-primary">Update</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
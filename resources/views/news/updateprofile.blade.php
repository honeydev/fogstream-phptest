@extends('news.layouts.news')
@section('content')
<div class="container">
    <div class="row">
        <form class="mx-auto profileForm" method="post" action="{{ route('profile.store') }}" enctype="multipart/form-data">
            @csrf
            @if ($errors->has('name'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('name')  }}
                </div>
            @endif
            @if ($errors->has('birthday'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('birthday')  }}
                </div>
            @endif
            @if ($errors->has('avatar'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('avatar')  }}
                </div>
            @endif
            <div class="form-group row">
                <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" readonly class="form-control-plaintext" id="staticEmail" value="{{ $user->email }}">
                </div>
            </div>
             <div class="form-group">
                <label for="nameInput">Name</label>
                <input name="name" type="text" class="{{ $errors->has('name') ? 'is-invalid' : '' }} form-control" id="nameInput" value="{{ $user->name }}">
            </div>
            <div class="form-group">
                <label for="nameInput">Birthday date</label>
                <input name="birthday" class="{{ $errors->has('birthday') ? 'is-invalid' : '' }} form-control" type="date" value="{{ $user->birthday }}" id="example-date-input">
            </div>
            <div class="form-group">
                <label for="nameInput">Avatar</label>
                <div class="custom-file">
                    <input name="avatar" type="file" class="{{ $errors->has('avatar') ? 'is-invalid' : '' }} custom-file-input" id="inputGroupFile01">
                    <label  class="custom-file-label" for="inputGroupFile01">Max avatar size 3000 Kilobytes</label>
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

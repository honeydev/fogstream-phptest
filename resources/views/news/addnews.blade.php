@extends('news.layouts.news')
@section('content')
<div class="container">
    <div class="row">
        <form id="addNewsForm" class="mx-auto addNewsForm" method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data">
            @csrf
            @if ($errors->has('title'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('title')  }}
                </div>
            @endif
            @if ($errors->has('body'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('body')  }}
                </div>
            @endif
            @if ($errors->has('preview'))
                <div class="alert alert-danger" role="alert">
                    {{ $errors->first('preview')  }}
                </div>
            @endif
            <div class="form-group">
                <label for="titleInput">Title</label>
                <input name="title" type="text" class="{{ $errors->has('title') ? 'is-invalid' : '' }} form-control" id="titleInput" value="">
            </div>

            <div class="form-group">
                <label for="body">Body</label>
                <textarea name="body" class="{{ $errors->has('body') ? 'is-invalid' : '' }} form-control" id="body" rows="10"></textarea>
            </div>
            <div class="form-group">
                <label for="nameInput">Preview</label>
                <div class="custom-file">
                    <input name="preview" type="file" class="{{ $errors->has('preview') ? 'is-invalid' : '' }} custom-file-input" id="inputGroupFile01">
                    <label  class="custom-file-label" for="inputGroupFile01">Max preview size 3000 Kilobytes</label>
                </div>
            </div>
            <div class="row">
                <div class="col-10 text-center">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

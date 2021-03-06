@extends('news.layouts.news')
@section('content')
    <div class="container news">
        <div class="row ">
            <div class="col-8 offset-3">
                <h2>{{ $news->title }}</h2>
                @isset($preview)
                <div class="row mx-auto">
                    <img src="{{ $preview->getUrl() }}" class="rounded img-fluid preview" alt="Preview">
                </div>
                @endisset
                <p>{{ $news->body }}</p>
                <ul class="list-unstyled list-inline">
                    <li class="list-inline-item">Author: {{ $author->name }}</li>
                    <li class="list-inline-item">Publication date: {{ $news->getFormatedData() }}</li>
                </ul>
            </div>
        </div>
    </div>
@endsection

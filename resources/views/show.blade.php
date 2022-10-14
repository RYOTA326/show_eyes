<!DOCTYPE html>
@extends('layouts.app')

@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    </head>
    <body>
        <h1>Show eyes</h1>
        <p class='edit'>[<a href="/posts/{{ $post->id }}/edit">edit</a>]</p>
        <form action="/posts/{{ $post->id }}" id="form_delete" method="post">
            @csrf
            @method('delete')
            <input type="submit" style="display:none">
            <p class='delete'>[<span onclick="return deletePost(this);">delete</span>]</p>
        </form>
        <div class='post'>
            <p>投稿者:{{ $post->user->name }}</p>
            <h2 class='title'>{{ $post->title }}</h2>
            <p class='body'>{{ $post->body }}</p>
            <p class='updated_at'>{{ $post->updated_at }}</p>
        </div>
        <form class="mb-4" method="POST" action="{{ route('comment.store') }}">
    @csrf
    
    <input
        name="post_id"
        type="hidden"
        value="{{ $post->id }}"
    >
    
    <div class="form-group">
        <label for="subject">
        名前
        </label>
        
    <input
        id="name"
        name="name"
        class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}"
        value="{{ old('name') }}"
        type="text"
    >
        @if ($errors->has('name'))
        <div class="invalid-feedback">
            {{ $errors->first('name') }}
        </div>
        @endif
    </div>
    
    <div class="form-group">
        <label for="body">
        本文
        </label>
        
    <textarea
        id="comment"
        name="comment"
        class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
        rows="4"
    >{{ old('comment') }}</textarea>
        @if ($errors->has('comment'))
        <div class="invalid-feedback">
            {{ $errors->first('comment') }}
        </div>
        @endif
    </div>
    
    <div class="mt-4">
    <button type="submit" class="btn btn-primary">
    コメントする
    </button>
    </div>
</form>

@if (session('commentstatus'))
<div class="alert alert-success mt-4 mb-4">
{{ session('commentstatus') }}
</div>
@endif
        <div class='back'>[<a href='/'>back</a>]</div>
        <script>
        function deletePost(e) {
            'use strict';
            if (confirm('削除すると復元できません。\n本当に削除しますか？')) {
                document.getElementById('form_delete').submit();
            }
        }
        </script>
    </body>
</html>
@endsection
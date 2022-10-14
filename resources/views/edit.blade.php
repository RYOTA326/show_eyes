<!DOCTYPE html>
@extends('layouts.app')

@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <title>Blog</title>
    </head>
    <body>
        <h1>Show eyes</h1>
        <div class="title">
        <form action="/posts/{{ $post->id }}" method="POST">
            @csrf
            @method('PUT')
            <div class='content__title'>
                <h2>Title</h2>
                <input type="text" name="post[title]" placeholder="タイトル" value="{{ $post->title }}">
            </div>
            <div class='content__body'>
                <h2>Body</h2>
                <textarea type="text" name="post[body]" placeholder="今日も一日お疲れさまでした。">{{ $post->body }}</textarea>
            </div>
                <input type="submit" value="update">
        </form>
        <div class='back'>[<a href='/'>back</a>]</div>
    </body>
</html>
@endsection
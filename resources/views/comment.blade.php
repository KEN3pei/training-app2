@extends('layouts.app')

@section('content')
<div class="training-contents">
    <div id="comment_contents">
        <div class="container comment_container">
            <div class="section">
                <p>Content</p>
                <form class="d-inline-block ml-4" action="{{ action('CommentController@create', ['id' => $training->id]) }}" method="post" enctype="multipart/form-data">
                    <textarea type="text" row="4" name="body"></textarea>
                    <input type="submit" value="コメント">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
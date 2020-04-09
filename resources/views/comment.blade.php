@extends('layouts.app')

@section('content')
<div class="training-contents">
    <div id="comment_contents">
        <div class="container comment_container">
            <div class="section row">
                <p>Content</p>
                <!--<p>{{ $training->user->name }}</p>-->
                <!--<p>{{ $training->body }}</p>-->
                <div class="comment-area col-md-6">
                    <div class="tr-user">
                    <p>{{ $training->user->name }}</p>
                    <p>{{ $training->body }}</p>
                    </div>
                    <form action="{{ action('CommentController@create', ['id' => $training->id]) }}" method="post" enctype="multipart/form-data">
                        <textarea type="text" row="4" name="body"></textarea>
                        <input type="submit" value="コメント">
                        @csrf
                    </form>
                </div>
                <div class="col-md-6">
                    <div>
                        <!--コメントの一覧を表示-->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="training-contents">
    <div id="comment_contents">
        <div class="container comment_container">
            <div class="section">
                <p>Content</p>
                <div class="comment-area row">
                    <div class="col-md-6">
                        <div class="tr-user">
                        <p>Name :  　　　　{{ $training->user->name }}</p>
                        <p>投稿 :　　　　　{{ $training->body }}</p>
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
                            @foreach($comments as $comment)
                                <li class="mb-4">
                                    <p class="d-inline-block">{{ $comment->body }}</p>
                                    @if($comment->user_id == $auth->id)
                                    <form class="d-inline-block ml-4" action="{{ action('CommentController@delete', ['id' => $comment->id]) }}" method="post" enctype="multipart/form-data">
                                        <input type="submit" value="削除">
                                        @csrf
                                    </form>
                                    @endif
                                </li>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
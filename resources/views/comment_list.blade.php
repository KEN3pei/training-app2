@extends('layouts.app')

@section('content')
<div class="training-contents">
    <div id="comment_contents">
        <div class="container comment_container">
            <div class="section">
                <p>Content</p>
                <!--自分の投稿へのコメント一覧を表示-->
                @foreach($comments as $comment)
                    <li>{{ $comment }}</li>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection
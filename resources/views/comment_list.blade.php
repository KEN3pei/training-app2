@extends('layouts.app')

@section('content')
<div class="training-contents">
    <div id="comment_contents">
        <div class="container comment_container">
            <div class="comment-area row">
                    <div class="col-md-6">
                        <div class="tr-user">
                        <p>Name :  　　　　{{ $training->user->name }}</p>
                        <p>投稿 :　　　　　{{ $training->body }}</p>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div>
                            <!--コメントの一覧を表示-->
                            @if(!$comments == null)
                            @foreach($comments as $comment)
                                <li class="mb-4">
                                    <p class="d-inline-block">{{ $comment }}</p>
                                </li>
                            @endforeach
                            @else
                                <p>コメントはありません</p>
                            @endif
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
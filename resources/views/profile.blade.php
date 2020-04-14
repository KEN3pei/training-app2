@extends('layouts.app')

@section('content')
<div class="training-contents">
    <div id="comment_contents">
        <div class="container comment_container">
            <div class="profile-section">
                <p>Content</p>
                <div class="comment-area">
                    <div>
                        <div class="tr-user">
                        <p>Name :  　　　　{{ Auth::user()->name }}</p>
                        <p>投稿数 :　　　　{{ $count }}</p>
                         <!--//まずアラートを出したい-->
                        <form class="d-inline-block ml-4 float-right" action="{{ action('ProfileController@ondeletefrag') }}" method="post" enctype="multipart/form-data">
                            <input type="submit" value="削除">
                            @csrf
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<div class="training-contents">
    <div id="comment_contents">
        <div class="container comment_container">
            <div class="profile-section">
                <p>自分のプロフィール</p>
                <div class="comment-area row">
                    <div class="col-md-1"></div>
                    <div class="col-md-2">
                        <a href="https://en.gravatar.com/">
                            <img src="https://www.gravatar.com/avatar/{{ $image }}">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <div class="tr-user">
                        <p>Name :  　　　　{{ Auth::user()->name }}</p>
                        <p>投稿数 :　　　　{{ $count }}</p>
                         <!--//まずアラートを出したい-->
                        <!--<form class="d-inline-block ml-4 float-right" action="{{ action('ProfileController@ondeletefrag') }}" method="post" enctype="multipart/form-data">-->
                        <!--    <input type="submit" value="削除">-->
                        <!--    @csrf-->
                        <!--</form>-->
                        </div>
                        <div class="logout_delete">
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            <form class="d-inline-block ml-4 float-right" action="{{ action('ProfileController@ondeletefrag') }}" method="post" enctype="multipart/form-data">
                                <input type="submit" value="アカウント削除">
                                @csrf
                            </form>
                        </div>
                    </div>
                    <div class="col-md-1"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
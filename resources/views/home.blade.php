@extends('layouts.app')

@section('content')
<div class="training-contents">
<div class="container" id="home-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="training-section1">
                <div>
                    <div class="pb-4">
                        <!--<a href="?date={{ $month }}&method=submonth" class="calendar_arrow">&lt;</a>-->
                        <!--<b>{{ $month }}</b>-->
                        <!--@if(!($month == $now))-->
                        <!--<a href="?date={{ $month }}&method=addmonth" class="calendar_arrow">&gt;</a>-->
                        <!--@endif-->
                    </div>
                    <div class="t-contents">
                        <a href="https://en.gravatar.com/">
                            <img src="https://www.gravatar.com/avatar/{{ $image }}">
                        </a>
                        <div class="d-inline-block pl-5">
                            <p class="font-weight-bold">{{ $auth->name }}</p>
                    @if(!$auth_training == null)
                            <p>{{ $auth_training->body }}</p>
                        </div>
                        <p></p>
                        <div class="float-right">
                            <p class="updatetime">{{ $auth_training->date }}</p>
                            <a href="/training/commentlist?id={{ $auth_training->id }}" class="today-comment pl-4"><i class="far fa-comment"></i></a>
                            <!--この投稿にfavoriteがついている時-->
                            <!--$auth_training->idを引数にして判定-->
                            @if(Auth::user()->exist_favo($auth_training->id))
                                <a href="/favorite/detach?id={{$auth_training->id}}" class="link-favo favo pl-4" method="post" enctype="multipart/form-data">
                                    <i class="fas fa-heart"></i></a>
                                @if($count = count($auth_training->favorite_users))
                                <a>{{ $count }}</a>
                                @else
                                <a>0</a>
                                @endif  
                            <!--ついていない時-->
                            @else
                                <a href="/favorite/attach?id={{$auth_training->id}}" class="link-unfavo favo pl-4" method="post" enctype="multipart/form-data">
                                    <i class="fas fa-heart"></i></a>
                                @if($count = count($auth_training->favorite_users))
                                <a>{{ $count }}</a>
                                @else
                                <a>0</a>
                                @endif     
                            @endif
                            <form class="d-inline-block ml-4" action="{{ action('TrainingController@delete', ['id' => $auth_training->id]) }}" method="post" enctype="multipart/form-data">
                                <input type="submit" value="削除">
                                @csrf
                            </form>
                        </div>   
                    </div>    
                    <div class="edit-training">
                        <form action="{{ action('TrainingController@edit', ['id' => $auth_training->id]) }}" method="post" enctype="multipart/form-data">
                            <input type="text" name="body">
                            <input type="submit" value="編集">
                            @csrf
                        </form>
                    </div>    
                    @else
                            <p>投稿はありません</p>
                        </div>
                    </div>    
                    @endif
                    
                </div>
                <!--<div>-->
                <!--    <form action="{{ action('TrainingController@create') }}" method="post" enctype="multipart/form-data">-->
                <!--        <input type="text" name="new_training">-->
                <!--        <input type="submit" value="投稿">-->
                <!--        @csrf-->
                <!--    </form>-->
                <!--</div>-->
            </div>
            <div id="calendar" class="mt-2 mb-4">
                <a href="?date={{ $month }}&method=submonth" class="calendar_arrow">&lt;</a>
                <b>{{ $month }}</b>
                @if(!($month == $now))
                <a href="?date={{ $month }}&method=addmonth" class="calendar_arrow">&gt;</a>
                @endif
                <table>
                    <tr>
                        <th class="week text-center">日</th>
                        <th class="week text-center">月</th>
                        <th class="week text-center">火</th>
                        <th class="week text-center">水</th>
                        <th class="week text-center">木</th>
                        <th class="week text-center">金</th>
                        <th class="week text-center">土</th>
                    </tr>
                    @foreach($weeks as $week)
                        {!! $week !!}
                    @endforeach
                </table>
            </div>
            <div class="create-training">
                <form action="{{ action('TrainingController@create') }}" method="post" enctype="multipart/form-data">
                    <input type="text" name="new_training">
                    <input type="submit" value="投稿">
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-md-4 second-contents">
            <div class="search-training">
                <form action="{{ action('TrainingController@search') }}" method="post" enctype="multipart/form-data">
                    <input type="text" name="body">
                    <input type="submit" value="検索">
                    @csrf
                </form>
            </div>
            <div class="row height-fixed scroll">
            <div class="col-12">
                @if(isset($trainings))
                    @foreach($trainings as $training)
                        <li class="traininglist-section">
                            <p>{{ $training->user->name }}</p>
                            <p>{{ $training->body }}</p>
                            <p class="d-inline-block">{{ $training->date }}</p>
                            
                            <a href="/training/comment?id={{ $training->id }}" class="today-comment ml-4"><i class="far fa-comment"></i></a>
                            <!--この投稿にfavoriteがついている時-->
                            <!--$auth_training->idを引数にして判定-->
                                @if(Auth::user()->exist_favo($training->id))
                                    <a href="/favorite/detach?id={{$training->id}}" class="link-favo favo pl-4"><i class="fas fa-heart"></i></a>
                                    @if($count = count($training->favorite_users))
                                    <a>{{ $count }}</a>
                                    @else
                                    <a>0</a>
                                    @endif   
                                <!--ついていない時-->
                                @else
                                    <a href="/favorite/attach?id={{$training->id}}" class="link-unfavo favo pl-4"><i class="fas fa-heart"></i></a>
                                    @if($count = count($training->favorite_users))
                                    <a>{{ $count }}</a>
                                    @else
                                    <a>0</a>
                                    @endif
                                @endif
                            
                            <!--{{ $training->id }}    -->
                            <!--<form class="d-inline-block ml-4" action="{{ action('TrainingController@delete', ['id' => $training->id]) }}" method="post" enctype="multipart/form-data">-->
                            <!--    <input type="submit" value="削除">-->
                            <!--    @csrf-->
                            <!--</form>-->
                            
                        </li>
                    @endforeach
                @endif
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                    <img src="https://www.gravatar.com/avatar/{{ $image }}" >
                    <p>{{ $auth->name }}</p>
                @if(!$auth_training == null)
                    <p>{{ $auth_training->body }}</p>
                    <p>{{ $auth_training->date }}</p>
                    <form action="{{ action('TrainingController@edit', ['id' => $auth_training->id]) }}" method="post" enctype="multipart/form-data">
                        <input type="text" name="body">
                        <input type="submit" value="編集">
                        @csrf
                    </form>
                @else
                    <p>投稿はありません</p>
                @endif
            </div>
            <div>
                <form action="{{ action('TrainingController@create') }}" method="post" enctype="multipart/form-data">
                    <input type="text" name="new_training">
                    <input type="submit" value="投稿">
                    @csrf
                </form>
            </div>
            <div id="calendar">
                <a href="?date={{ $month }}&method=submonth">&lt;</a>
                <b>{{ $month }}</b>
                <a href="?date={{ $month }}&method=addmonth">&gt;</a>
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
        </div>
        <div class="col-md-4 bg-secondary second-contents">
            <div>
                <form>
                    <input type=text>
                </form>
            </div>
            <div class="row height-fixed scroll">
            <div class="col-12">
                @if(isset($trainings))
                    @foreach($trainings as $training)
                        <li>
                            <p>{{ $training->user->name }}</p>
                            <p>{{ $training->body }}</p>
                            <form action="{{ action('TrainingController@delete', ['id' => $training->id]) }}" method="post" enctype="multipart/form-data">
                                <input type="submit" value="削除">
                                @csrf
                            </form>
                        </li>
                    @endforeach
                @endif
            </div>
            </div>
        </div>
    </div>
</div>
@endsection

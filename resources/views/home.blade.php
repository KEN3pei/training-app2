@extends('layouts.app')

@section('content')
<div class="training-contents">
<div class="container" id="home-container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div id="training-section1">
                <div class="t-contents">
                    <div>
                    <a href="?date={{ $month }}&method=submonth">&lt;</a>
                    <b>{{ $month }}</b>
                    @if(!($month == $now))
                    <a href="?date={{ $month }}&method=addmonth">&gt;</a>
                    @endif
                    </div>
                        <img src="https://www.gravatar.com/avatar/{{ $image }}" >
                        <p>{{ $auth->name }}</p>
                    @if(!$auth_training == null)
                        <p>{{ $auth_training->body }}</p>
                        <p class="updatetime">{{ $auth_training->date }}</p>
                        <a href="/training/home/commentlist" class="today-comment pl-4"><i class="far fa-comment"></i></a>
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
            </div>
            <div id="calendar">
                <a href="?date={{ $month }}&method=submonth">&lt;</a>
                <b>{{ $month }}</b>
                @if(!($month == $now))
                <a href="?date={{ $month }}&method=addmonth">&gt;</a>
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
        </div>
        <div class="col-md-4 second-contents">
            <div>
                <form>
                    <input type=text>
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
                            <!--modal-->
                            <a href="" data-toggle="modal" data-target="#exampleModal" class="today-comment ml-4"><i class="far fa-comment"></i></a>
                            <!--{{ $training->id }}    -->
                                <!-- モーダルの設定 -->
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                                  <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                      <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">{{ $auth->name }}</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="閉じる">
                                          <span aria-hidden="true">&times;</span>
                                        </button>
                                      </div>
                                      
                                      <form action="{{ action('CommentController@create', ['id' => $training->id ]) }}" method="post" enctype="multipart/form-data">
                                          <div class="modal-body">
                                            <textarea type="text" rows="4" name="body"></textarea>
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                                            <button type="submit" form="create-comment" class="btn btn-primary">コメント</button>
                                          </div><!-- /.modal-footer -->
                                          @csrf
                                      </form>
                                    </div><!-- /.modal-content -->
                                  </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                                
                            <form class="d-inline-block ml-4" action="{{ action('TrainingController@delete', ['id' => $training->id]) }}" method="post" enctype="multipart/form-data">
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
</div>
@endsection

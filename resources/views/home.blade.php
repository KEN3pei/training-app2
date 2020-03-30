@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 bg-primary">
            <div>
                <img src="https://www.gravatar.com/avatar/{{ $image }}" >
                <p>{{ $auth->name }}</p>
            </div>
            <div>
                <form action="{{ action('TrainingController@create') }}" method="post" enctype="multipart/form-data">
                    <input type="text" name="new_training">
                    <input type="submit" value="投稿">
                    @csrf
                </form>
            </div>
        </div>
        <div class="col-md-4 bg-secondary">
            <div>
                <form>
                    <input type=text>
                </form>
            </div>
            <div>
                @if(isset($trainings))
                    @foreach($trainings as $training)
                        <li>
                            <p>{{ $training->user->name }}</p>
                            <p>{{ $training->body }}</p>
                        </li>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

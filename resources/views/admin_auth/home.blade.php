@extends('layouts.admin_app')

@section('content')
<div id="admin-main">
    <div class="container admin-container pb-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div id="admin-section">
                    <h5>全ユーザーの情報</h5>
                    <table>
                        <tr>
                            <th>user_id</th>
                            <th>name</th>
                            <th>e-mail</th>
                            <th>password</th>
                        </tr>
                        @if($users)
                            @foreach($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->deletefrag }}</td>
                            </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

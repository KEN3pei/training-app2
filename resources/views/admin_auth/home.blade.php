@extends('layouts.admin_app')

@section('content')
<div id="admin-main">
    <div class="container admin-container pb-5">
        <div class="row justify-content-center">
            <div class="col-md-6 admin-tables">
                <div id="admin-section">
                    <h5>全ユーザーの情報</h5>
                    <table>
                        <tr id="admin-columns">
                            <th>id</th>
                            <th>name</th>
                            <th>e-mail</th>
                            <th>password</th>
                            <th>削除</th>
                        </tr>
                        @if($users)
                        @foreach($users as $user)
                        <tr class="text-center" id="admin-users">
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->deletefrag }}</td>
                            <td><form class="d-inline-block ml-4 float-right" action="{{ action('AdminHomeController@delete', ['id' => $user]) }}" method="post" enctype="multipart/form-data">
                                    <input type="submit" value="削除">
                                    @csrf
                                </form>
                            </td>
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

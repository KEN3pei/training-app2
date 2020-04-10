@extends('layouts.app')

@section('content')
<div class="container">
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
                    <tr>
                        <td>user_id</td>
                        <td>name</td>
                        <td>e-mail</td>
                        <td>password</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

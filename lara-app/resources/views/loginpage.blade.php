@extends('layout')

@section('title')
    Login - Page
@endsection

@section('CssAndScripts')

@endsection

@section('body')
    <div class="flex-center position-ref full-height">
        <h1>Login</h1>
        <div>
            <form id="login_form" method="POST">
                {{ csrf_field() }}

                <input type="text" name="uname" id="uname"> <br>
                <input type="password" name="password" id="password"> <br>
                <div id="badLoginMessage"></div>
                <input type="submit" id="#submit" value="submit">
            </form>
        </div>
    </div>
@endsection

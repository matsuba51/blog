@extends('layouts.app')

@section('content')
<h2>ログイン成功！</h2>
<p>ようこそ、{{ Auth::user()->name }} さん</p>

<form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit">ログアウト</button>
</form>
@endsection
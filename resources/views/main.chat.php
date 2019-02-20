@extends('layouts.app')

@section('content')

<div class="col-md-12">
    @if (Auth::guest())
        Для работы с чатом необходима авторизация!
    @else
        Чат работает
    @endif
</div>



@endsection

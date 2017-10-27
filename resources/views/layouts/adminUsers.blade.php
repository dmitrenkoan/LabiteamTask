@extends('adminTemplate')


@section('content')

    <div class="row header">
        <div class="col-sm-4 title">
            <p>Имя</p>
        </div>
        <div class="col-sm-4 title">
            <p>Email</p>
        </div>
        <div class="col-sm-4 title">
            <p>Дата последнего входа</p>
        </div>
    </div>
    @if(!empty($users))
        @foreach($users as $userItem)
            <div class="row item">
                <div class="col-sm-4 title">
                    <p>{{$userItem->name}}</p>
                </div>
                <div class="col-sm-4 title">
                    <p>{{$userItem->email}}</p>
                </div>
                <div class="col-sm-4 title">
                    <p>{{$userItem->last_login}}</p>
                </div>
            </div>
        @endforeach

        <div class="row center">
            {{ $users->links() }}
        </div>
    @endif

@endsection
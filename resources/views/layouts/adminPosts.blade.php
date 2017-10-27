@extends('adminTemplate')


@section('content')
            <div class="row">
                <a href="{{route('post.create')}}" class="btn btn-sm btn-success">Создать новый пост</a>
            </div>
            <div class="row header">
                <div class="col-sm-3 title">
                    <p>Заголовок</p>
                </div>
                <div class="col-sm-3 title">
                    <p>Дата создания</p>
                </div>
                <div class="col-sm-2 buttons">

                </div>
                <div class="col-sm-2 buttons">

                </div>
            </div>
            @if(!empty($posts))
                @foreach($posts as $postItem)
                    <div class="row item">
                        <div class="col-sm-3 title">
                            <p>{{$postItem->title}}</p>
                        </div>

                        <div class="col-sm-3 title">
                            <p>{{$postItem->created_at}}</p>
                        </div>
                        <div class="col-sm-2 buttons right">
                            <a href="{{route('post.edit', ['id'=> $postItem->id])}}" class="btn btn-sm btn-primary">Изменить</a>
                        </div>
                        <div class="col-sm-2 buttons left">
                            <form action="{{route('post.destroy', ['id'=>$postItem->id])}}" method="POST">
                                {{ method_field('DELETE') }}
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="submit" class="btn btn-sm btn-danger"  value="Удалить">
                            </form>

                        </div>
                        <div class="col-sm-1">
                        </div>
                    </div>
                @endforeach

                <div class="row center">
                    {{ $posts->links() }}
                </div>
            @endif

@endsection
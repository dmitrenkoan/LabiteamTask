@extends('adminTemplate')


@section('content')
    <div class="container">
        <h2>Редактировать элемент: <b>{{$post->title}}</b></h2>
        <form action="{{route('post.update',['id' => $post->id])}}"  method="POST" enctype="multipart/form-data">
            {{ method_field('PUT') }}
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input id="title" class="form-control" type="text" name="title" value="{{$post->title ? $post->title :""}}">
            </div>
            <div class="form-group">
                <label for="code">Символьный код(для url):</label>
                <input id="code" class="form-control" type="text" name="code" value="{{$post->code ? $post->code :""}}">
            </div>
            <div class="form-group">
                <label for="picture">Картинка:</label>
                @if(!empty($post->preview_picture_id))
                    <p><img class="img-thumbnail" src="{{asset($post->previewPicture->path)}}" alt="note_picture" ></p>
                    <p>
                        <label for="removePicture">Убрать фото</label>
                        <input type="checkbox" name="remove_picture" id="removePicture" value="Y"/>
                    </p>
                    <p id="warning-picture" style="display:none">*Изменения вступят в силу после нажатия кнопки сохранить</p>
                @else
                    <p><img class="img-thumbnail" src="{{asset('images/no-photo.png')}}" alt="note_picture" style="width:200px;height:150px;"></p>
                @endif
                <input id="picture" class="form-control-file" type="file" name="picture" value="">
            </div>
            <div class="form-group">
                <label for="publication_date">Дата создания:</label>
                <p>{{$post->created_at}}</p>
            </div>
            <div class="form-group">
                <label for="detail_text">Анонсовый текст:</label>
                <textarea id="preview_text" name="preview_text" class="form-control">
                    {{$post->preview_text}}
                </textarea>
            </div>
            <div class="form-group">
                <label for="detail_text">Детальный текст:</label>
                <textarea id="detail_text" name="detail_text" class="form-control">
                    {{$post->detail_text}}
                </textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>

        </form>
    </div>

@endsection

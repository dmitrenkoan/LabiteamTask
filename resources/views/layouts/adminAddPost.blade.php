@extends('adminTemplate')


@section('content')
    <div class="container">
        <h2>Добавить новый пост</h2>
        <form action="{{route('post.store')}}"  method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="title">Заголовок:</label>
                <input id="title" class="form-control" type="text" name="title" value="">
            </div>
            <div class="form-group">
                <label for="code">Символьный код(для url):</label>
                <input id="code" class="form-control" type="text" name="code" value="">
            </div>
            <div class="form-group">
                <label for="picture">Превью картинка :</label>

                    <p><img class="img-thumbnail" src="{{asset('images/no-photo.png')}}" alt="note_picture" style="width:200px;height:150px;"></p>

                <input id="picture" class="form-control-file" type="file" name="picture" value="">
            </div>
            <div class="form-group">
                <label for="detail_text">Анонсовый текст:</label>
                <textarea id="preview_text" name="preview_text" class="form-control">
                </textarea>
            </div>
            <div class="form-group">
                <label for="detail_text">Детальный текст:</label>
                <textarea id="detail_text" name="detail_text" class="form-control">
                </textarea>
            </div>
            <button type="submit" class="btn btn-success">Сохранить</button>

        </form>
    </div>

@endsection

@extends('publicTemplate');
@section('content')
            <div class="container posts">

                <p class="date">{{$post->created_at->format('d/m/Y')}}</p>

                @if(!empty($post->previewPicture->path))
                    <a href="/blog/{{$post->code}}" class="image">
                        <img src="{{$post->previewPicture->path}}" alt="{{$post->title}}">
                    </a>
                @endif
                <p class="detal-text">
                    {{$post->detail_text}}
                </p>
                <a href="{{route('blog')}}">Назад к списку</a>
            </div>


@endsection
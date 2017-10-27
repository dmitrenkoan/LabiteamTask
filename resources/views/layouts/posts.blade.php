@extends('publicTemplate');
@section('content')
    @if(!empty($posts))
        @foreach($posts as $post)
            <div class="container posts">
                <a href="/blog/{{$post->code}}"><h3 >{{$post->title}}</h3></a>
                <p class="date">{{$post->created_at->format('d/m/Y')}}</p>

                @if(!empty($post->previewPicture->path))
                    <a href="{{route('public.show', ['code'=>$post->code])}}" class="image">
                        <img src="{{$post->previewPicture->path}}" alt="{{$post->title}}">
                    </a>
                @endif
                <p class="detal-text">
                    {{$post->preview_text}}
                </p>
            </div>
        @endforeach
        <div class="container center">
            {{$posts->links()}}
        </div>
    @endif
@endsection
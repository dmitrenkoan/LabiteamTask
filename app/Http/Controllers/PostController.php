<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function publicIndex()
    {
        $posts = Post::with('previewPicture')->paginate(15);
        return view('layouts.posts', [
           'posts' => $posts
        ]);
    }

    public function index()
    {
        $posts = Post::with('previewPicture')->paginate(15);
        return view('layouts.adminPosts', [
            'posts' => $posts
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.adminAddPost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        // Проверяяем является ли вложенный файл картинкой
        $this->validate($request, [
            'picture' => 'image',
        ]);

        $post->title = $request->title;
        // Заменяем пробелы на нижние подчеркивания и ограничиваем размер строки(для удобства)
        $post->code = mb_strtolower (str_replace(' ', '_',mb_strimwidth($request->code,0,100)));
        $post->detail_text = $request->detail_text;
        $post->preview_text = $request->preview_text;

        if(!empty($request->picture)) {
            $pictureID = PictureController::add($request);
            $post->preview_picture_id = $pictureID;

        }
        $post->save();
        return redirect(route('post.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $post = Post::where('code', $code)->first();
        return view('layouts.PostShow', [
            'post' => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::with('previewPicture')->find($id);
        return view('layouts.adminEditPost', [
            'post' => $post,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $post = Post::find($id);

        // Проверяяем является ли вложенный файл картинкой
        $this->validate($request, [
            'picture' => 'image',
        ]);

        $post->title = $request->title;
        $post->preview_text = $request->preview_text;
        $post->detail_text = $request->detail_text;

        if(!empty($request->picture)) {
            if(!empty($post->preview_picture_id)) {
                //Удаляем старую фотографию //
                $status = PictureController::remove($post->preview_picture_id);
            }
            $pictureID = PictureController::add($request);
            $post->preview_picture_id = $pictureID;

        }
        if(!empty($request->remove_picture)) {
            //Удаляем старую фотографию //
            $status = PictureController::remove($post->preview_picture_id);
            if($status) {
                $post->preview_picture_id = NULL;
            }
        }
        $post->save();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        if(!empty($post->picture_id)) {
            //Удаляем старую фотографию //
            $status = PictureController::remove($post->picture_id);
        }
        $post->delete();
        return redirect(route('post.index'));
    }
}

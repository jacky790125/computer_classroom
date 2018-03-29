<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at','DESC')
        ->paginate(10);
        $data = [
            'posts'=>$posts,
        ];
        return view('posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $att['title'] = $request->input('title');
        $att['content'] = $request->input('content');
        $att['user_id'] = auth()->user()->id;
        $att['view'] = "0";
        Post::create($att);
        return redirect()->route('index');
    }

    //ajax view值+1
    public function view(Request $request)
    {

        $post = Post::where('id', '=', $request->input('id'))->first();

        if(session('view'.$post->id) != "1"){
            $att['view'] = $post->view;
            $att['view']++;

            $post->update($att);

            $result = $att['view'];
            session(['view'.$post->id => '1']);

            echo json_encode($result);
            return;

        }else{
            $result = 'failed';
            echo json_encode($result);
            return;
        }

    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.edit',compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        $post->update($request->all());
        return redirect()->route('index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('index');
    }

    public function admin_post()
    {
        $posts = Post::orderBy('updated_at','DESC')
            ->get();
        $data = [
            'posts'=>$posts,
        ];
        return view('admin.posts.index',$data);
    }
    public function admin_destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('admin.post.index');
    }
}

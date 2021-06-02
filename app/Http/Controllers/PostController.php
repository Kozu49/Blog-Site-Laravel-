<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Post;
class PostController extends Controller
{
    public function show($id){   
        $post=Post::find($id);
        return view('blog-post',['post'=>$post]);
    }

    public function create(){
        $this->authorize('create',Post::class);
        return view('admin.posts.create');
    }

    public function store(Request $request){

        $this->authorize('create',Post::class);
        // dd(request()->all());
        $inputs=request()->validate([
            'title'=>'required|min:8|max:200',
            'post_image'=>'file',
            // 'post_image'=>'mimes:jpeg,png',
            'body'=>'required'
        ]);
        if(request('post_image')){
            $inputs['post_image']=request('post_image')->store('images');
        }

        auth()->user()->posts()->create($inputs);
        Session::flash('create_message', 'Post with title' . ' '. $inputs['title'] .' '. 'was Created' );

        return redirect()->route('post.index');
        // return redirect('/admin/posts/');


    }

    public function index(){

        $posts=auth()->user()->posts()->paginate(5);
        // $posts=Post::all();

        return view('admin.posts.index',['posts'=>$posts]);
    }

    public function destroy($id){
        // if(auth()->user()->id !== $post->user_id)
        
        $post=Post::find($id);
        $this->authorize('delete',$post);

        $post->delete();
        Session::flash('destroy_message','Post was deleted');
        return back();


    }

    public function edit($id){
        $post=Post::find($id);
        $this->authorize('view',$post);

        return view('admin.posts.edit',['post'=>$post]);


    }

    public function update($id){
        $post=Post::find($id);

        $inputs=request()->validate([

            'title'=>'required|min:8|max:200',
            'post_image'=>'file',
            // 'post_image'=>'mimes:jpeg,png',
            'body'=>'required'
            ]);
        if(request('post_image')){
            $inputs['post_image']=request('post_image')->store('images');
            $post->post_image=$inputs['post_image'];
        }
        $post->title=$inputs['title'];
        $post->body=$inputs['body'];
        // auth()->user()->posts()->save($post);

        $this->authorize('update',$post);

        $post->save();
        Session::flash('updated_message','Post was updated');

        return redirect()->route('post.index');    
    
    }
}

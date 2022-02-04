<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\ViewErrorBag;

class PostsController extends Controller
{
    public function index(){
        $posts = Post::orderBy('id','desc')->paginate(5);
        return view('admin.posts.index', compact('posts'));
    }

    public function show($id){
        $post= Post::find($id);
        if($post){
            return view('admin.posts.show',compact('post'));
        }
        abort(404);
    }


    public function create()
    {
      
        return view('admin.posts.create');
    }

    public function store(Request $request){

        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Il titolo è un campo obbligatorio',
                'title.max' => 'Il titolo deve avere max :max caratteri',
                'title.min' => 'Il titolo deve avere min :min caratteri',
                'content.required' => 'Il contenuto è un campo obbligatorio'
            ]
            );
        $data = $request->all();

        $new_post = new Post();
        $new_post->fill($data);
        $new_post->slug = Post::generateSlug($new_post->title);
        $new_post->save();;

        return redirect()->route('admin.posts.show',$new_post);
    }

    public function edit($id){
        $post = Post::find($id);

        if($post){
            return view('admin.posts.edit', compact('post'));
        }

        abort(404);

    }

    public function update(Request $request, Post $post){
        $request->validate(
            [
                'title' => 'required|max:255|min:2',
                'content' => 'required'
            ],
            [
                'title.required' => 'Il titolo è un campo obbligatorio',
                'title.max' => 'Il titolo deve avere max :max caratteri',
                'title.min' => 'Il titolo deve avere min :min caratteri',
                'content.required' => 'Il contenuto è un campo obbligatorio'
            ]
        );
        $form_data = $request->all();

        if($form_data['title'] != $post->title){
            $form_data['slug']= Post::generateSlug($form_data['title']);
        }

        $post->update($form_data);
        return redirect()->route('admin.posts.show', $post);
    }

    public function destroy(Post $post){
        $post->delete();
        return redirect()->route('admin.posts.index')->with('deleted','Post eliminato correttamente');
    }
}

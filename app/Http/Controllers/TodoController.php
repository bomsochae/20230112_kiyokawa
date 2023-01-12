<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TodoRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\Todo;
use App\Models\Tag;

class TodoController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $todos = Todo::all();
        $tags = Tag::all();
        $param = [
            'user'=>$user,
            'todos'=>$todos,
            'tags'=>$tags
        ];
        return view('index', $param);
    }

    public function create(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::create($form);
        return redirect('/');
    }

    public function update(TodoRequest $request)
    {
        $form = $request->all();
        unset($form['_token']);
        Todo::where('id', $request->id)->update($form);
        return redirect()->back();
    }

    public function delete(Request $request)
    {
        Todo::find($request->id)->delete();
        return redirect()->back();
    }

    public function find()
    {
        $user = Auth::user();
        $tags = Tag::all();
        $param = [
            'user'=>$user,
            'todos'=>[],
            'tags'=>$tags
        ];
        return view('find', $param);
    }

    public function search(Request $request)
    {
        $user = Auth::user();
        $tags = Tag::all();

        $task = $request->task;
        $tag_id = $request->tag_id;
        if ($task && $tag_id) {
            $cond = [['task', 'LIKE', '%'.$task.'%'], ['tag_id', '=', $tag_id]];
            $todos = Todo::where($cond)->get();
        } elseif ($task && !$tag_id) {
            $cond = [['task', 'LIKE', '%'.$task.'%']];
            $todos = Todo::where($cond)->get();
        } elseif (!$task && $tag_id) {
            $cond = [['tag_id', '=', $tag_id]];
            $todos = Todo::where($cond)->get();
        } else  {
            $todos = Todo::all();
        }
        $param = [
            'user'=>$user,
            'todos'=>$todos,
            'tags'=>$tags
        ];

        return view('find', $param);
    }
}

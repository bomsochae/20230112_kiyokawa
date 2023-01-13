@extends('layouts.default')
@section('title', 'Todo List')
@section('user', $user->name)
@section('content')
<a class="button btn-search" href="/todo/find">タスク検索</a>
<div class="todo">
  @if (count($errors) > 0)
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{$error}}</li>
    @endforeach
  </ul>
  @endif
  <form class="flex between mb-30" action="/todo/create" method="post">
    @csrf
    <input class="text-add" type="text" name="task">
    <select class="select-tag" name="tag_id">
      @foreach($tags as $tag)
      <option value="{{$tag->id}}">{{$tag->name}}</option>
      @endforeach
    </select>
    <input type="hidden" name="user_id" value="{{$user->id}}">
    <input class="button btn-add" type="submit" value="追加">
  </form>
  <table>
    <tr>
      <th>作成日</th>
      <th>タスク名</th>
      <th>タグ</th>
      <th>更新</th>
      <th>削除</th>
    </tr>
    @foreach($todos as $todo)
    <tr>
      <td>{{$todo->created_at}}</td>
      <form action="/todo/update?id={{$todo->id}}" method="post">
        @csrf
        <td><input class="text-update" type="text" name="task" value="{{$todo->task}}"></td>
        <td>
          <select class="select-tag" name="tag_id">
          @foreach($tags as $tag)
            @if($tag->id == $todo->tag_id)
            <option value="{{$tag->id}}" selected>{{$tag->name}}</option>
            @else
            <option value="{{$tag->id}}">{{$tag->name}}</option>
            @endif
          @endforeach
        </select>
        </td>
        <td><button class="button btn-update">更新</button></td>
      </form>
      <td>
        <form action="/todo/delete?id={{$todo->id}}" method="post">
          @csrf
          <button class="button btn-delete">削除</button>
        </form>
      </td>
    </tr>
    @endforeach
  </table>
</div>
@endsection

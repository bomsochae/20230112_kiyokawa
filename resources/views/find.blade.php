@extends('layouts.default')
@section('title', 'タスク検索')
@section('user', $user->name)
@section('content')
<div class="todo">
  <form class="flex between mb-30" action="/todo/search" method="get">
    @csrf
    <input class="text-add" type="text" name="task">
    <select class="select-tag" name="tag_id">
      <option value=""></option>
      @foreach($tags as $tag)
      <option value="{{$tag->id}}">{{$tag->name}}</option>
      @endforeach
    </select>
    <input class="button btn-add" type="submit" value="検索">
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
<a class="button btn-back" href="/">戻る</a>
@endsection

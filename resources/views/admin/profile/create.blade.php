@extends('layouts.profile')
@section('title', 'MyProfile')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2 style="margin-bottom:30px;">Myプロフィール</h2>
        <form action="{{ action('Admin\ProfileController@create') }}" method="post" enctype="multipart/form-data">

        @if (count($errors) > 0)
        <ul>
        @foreach($errors->all() as $e)
         <li>{{ $e }}</li>
         @endforeach
        </ul>
        @endif
        <div class="form-group row">
          <label class="col-md-2">氏名</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="gender">性別</label>
            <div class="col-md-10">
              <select name="gender" class="form-control">
                <option value="男性" @if(old('gender')=='男性') selected @endif >男性</option>
                <option value="女性" @if(old('gender')=='女性') selected @endif >女性</option>
              </select>
            </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2">趣味</label>
            <div class="col-md-10">
              <input type="text" class="form-control" name="hobby" value="{{ old('hobby') }}">
            </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="introduction">自己紹介</label>
          <div class="col-md-10">
            <textarea class="form-control" name="introduction" rows="20">{{ old('introduction') }}</textarea>
            </div>
        </div>
        <div class="form-group row">
          <label class="col-md-2" for="title">画像</label>
          <div class="col-md-10">
            <input type="file" class="form-control-file" name="image">
          </div>
        </div>
        {{ csrf_field() }}
        <input type="submit" class="btn btn-primary" value="更新">
        </form>
      </div>
    </div>
  </div>
@endsection

@extends('layouts.profile')
@section('title', 'MyProfile')
@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-8 mx-auto">
        <h2 style="margin-bottom:30px;">Myプロフィール</h2>
        <form action="{{ action('Users\ProfileController@update') }}" method="post" enctype="multipart/form-data">

          @if (count($errors) > 0)
            <ul>
              @foreach($errors->all() as $e)
                <li>{{ $e }}</li>
              @endforeach
            </ul>
          @endif
          <div class="form-group row">
            <label class="col-md-2">ユーザー名</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="name" value="{{old('name', $user->profile->name) }}">
              </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="gender">性別</label>
              <div class="col-md-10">

                <select name="gender" class="form-control">
                  <?php $gender_val = old('gender', $user->profile->gender); ?>
                  <option value="秘密" @if($gender_val =='秘密') selected="selected" @endif >秘密</option>
                  <option value="男性" @if($gender_val =='男性') selected="selected" @endif >男性</option>
                  <option value="女性" @if($gender_val =='女性') selected="selected" @endif >女性</option>
                </select>

                <!--
                {{ Form::select('gender', ['男性', '女性'], null, ['class' => 'form-control']) }}
                -->
              </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2">趣味</label>
              <div class="col-md-10">
                <input type="text" class="form-control" name="hobby" value="{{ old('hobby', $user->profile->hobby) }}">
              </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="introduction">自己紹介</label>
            <div class="col-md-10">
              <textarea class="form-control" name="introduction" rows="20">{{old('introduction', $user->profile->introduction) }}</textarea>
              </div>
          </div>
          <div class="form-group row">
            <label class="col-md-2" for="image">画像</label>
              <div class="col-md-10">
                <input type="file" class="form-control-file" name="image">
                <div class="form-text text-info">
                  設定中: {{ $user->profile->profile_image_path }}
                </div>
                <div class="form-check">
                  <label class="form-check-label">
                    <input type="checkbox" class="form-check-input" name="remove" value="true">画像を削除
                  </label>
                </div>
              </div>
              </div>
              <div class="form-group row">
                <div class="col-md-10">
                  <input type="hidden" name="id" value="{{ $user->profile->user_id }}">
                  <input type="hidden" name="profile_id" value="{{ $user->profile->id }}">
                  {{ csrf_field() }}
                  <input type="submit" class="btn btn-primary" value="更新">
                </div>
              </div>
        </form>
        <!-- <div class="row mt-5">
          <div class="col-md-4 mx-auto">
            <h2>編集履歴</h2>
            <ul class="list-group">
              @if(isset($profile_form->user_histories))
                @foreach ($profile_form->user_histories as $userhistory)
                  <li class="list-group-item">{{ $userhistory->edited_at }}</li>
                @endforeach
              @endif
            </ul>
          </div>
        </div> -->
      </div>
    </div>
  </div>
@endsection

@extends('layouts.front')

@section('content')
  <div class="container">
    <hr color="#c0c0c0">
    @if (!is_null($headline))
      <div class="row">
        <div class="headline col-md-10 mx-auto">
          <div class="row">
            <div class="col-md-6">
              <div class="caption mx-auto">
                <div class="image">
                  {{--　松田変更ここから --}}
                  {{--
                    @if ($headline->profile_image_path)
                    <img src="{{ asset('storage/image/' . $headline->profile_image_path) }}">
                    @else
                    <img src="{{ asset('storage/image/' . 'no-image2.svg') }}">

                    @endif
                  --}}
                  <img src="{{ Utl::getImagePath($headline->profile_image_path) }}">
                  {{--　松田変更ここまで --}}
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <p class="body mx-auto">Name<br>{{ str_limit($headline->name, 50) }}</p>
              <!-- <p class="body mx-auto">Gender<br>{{ str_limit($headline->gender,10) }}</p> -->
              <p class="body mx-auto">Hobby<br>{{ str_limit($headline->hobby, 200) }}</p>
              <p class="body mx-auto">Introduction<br>{{ str_limit($headline->introduction, 400) }}</p>
            </div>
          </div>
        </div>
      </div>
      @endif
      <hr color="#c0c0c0">
      <div class="row">
        <div class="posts col-md-8 mx-auto mt-3">
          @foreach($posts as $post)
              @if( ( $post->user_id ) == ( $user_id_for_show ) )
            <div class="post">
              <div class="row">
                <div class="text col-md-6">
                  <div class="date">
                      {{ $post->updated_at->format('Y年m月d日') }}
                  </div>
                  <div class="title">
                      {{ str_limit($post->title, 70) }}
                  </div>
                  <div class="auther">
                      {{ $post->user->name }}
                  </div>
                  <div class="body mt-3">
                      {{ str_limit($post->body, 255) }}
                      <p><a href="{{ action('NewsController@show', ['id' => $post->id]) }}">もっと見る</a></p>
                  </div>
                  </div>
                  <div class="image col-md-6 text-right mt-4">
                  {{--　松田変更ここから --}}
                  {{--
                  @if ($post->image_path)
                    <img src="{{ asset('storage/image/' . $post->image_path) }}">
                    @else
                    <img src="{{ asset('storage/image/' . 'no-image.svg') }}">

                  @endif
                  --}}
                  <img src="{{ Utl::getImagePath($post->image_path) }}">
                  {{--　松田変更ここまで --}}
                  </div>
              </div>
            </div>
          <hr color="#c0c0c0">
          @endif
        @endforeach
      </div>
    </div>
  </div>
  </div>
@endsection

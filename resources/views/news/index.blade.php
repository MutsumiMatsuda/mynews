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
                  @if ($headline->image_path)

                    <img src="{{ asset('storage/image/' . $headline->image_path) }}">
                    @else
                    <img src="{{ asset('storage/image/' . 'no-image.svg') }}">

                  @endif
                  --}}
                  <img src="{{ Utl::getImagePath($headline->image_path) }}">
                  {{--　松田変更ここまで --}}
                </div>
                <div class="title p-2">
                  <h1>{{ str_limit($headline->title, 70) }}</h1>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <p class="body mx-auto">{{ $headline->updated_at->format('Y年m月d日') }}&nbsp;&nbsp;&nbsp;<a href="{{ action('ProfileController@show', ['id' => $headline->user_id]) }}">{{ $headline->user->name }}</a></p>
              <p class="body mx-auto">{{ str_limit($headline->body, 400) }}</p>
                      <p><a href="{{ action('NewsController@show', ['id' => $headline->id]) }}">もっと見る</a></p>
            </div>
          </div>
        </div>
      </div>
      @endif
      <hr color="#c0c0c0">
      <div class="row">
        <div class="posts col-md-8 mx-auto mt-3">
          @foreach($posts as $post)
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
                     <a href="{{ action('ProfileController@show', ['id' => $post->user_id]) }}">{{ $post->user->name }}</a>
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
        @endforeach
            {{ $posts->links() }}

      </div>
    </div>
  </div>
  </div>
@endsection

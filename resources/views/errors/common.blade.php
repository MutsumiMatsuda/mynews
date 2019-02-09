@extends('layouts.users')

@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2>{{ $status }} {{ $message }}</h2><br/>
      <h2>５秒後にトップページへ移動します</h2>
    </div>
  </div>
</div>
@endsection
<script>
setTimeout(function(){
  window.location.href = '/';
}, 5*1000);
</script>

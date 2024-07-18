@extends('layouts.layout')

@section('content')

<script>
  var catsNum = {{ $catsCount }};
  var from_user_id = {{ Auth::id() }};
</script>

<div class="topPage">
  <nav class="nav">
    <ul>
      <li class="personIcon">
        <a href="/users/show/{{ Auth::id() }}"><i class="fas fa-user fa-2x"></i></a></li>
      <li class="appIcon"><a href="{{ route('user.home') }}"><img src="/storage/images/techpit-match-icon.png"></a></li>
<li class="messageIcon"><a href="{{route('user.matching')}}"><i class="fas fa-2x fa-comments"></a></i></li>      
    </ul>
  </nav>
  <div id="tinderslide">
    <ul>
        @foreach($cats as $cat)
        <li data-cat_id="{{ $cat->id }}">
          <div class="catName">{{ $cat->name }}</div>
          <img src="/storage/images/{{ $cat->img_name }}">
          <div class="like"></div>
          <div class="dislike"></div>
        </li>
        @endforeach
    </ul>
    <div class="noCat">近くにお相手がいません。</div>
  </div>
  <div class="actions" id="actionBtnArea">
      <a href="#" class="dislike"><i class="fas fa-times fa-2x"></i></a>
      <a href="#" class="like"><i class="fas fa-heart fa-2x"></i></a>
  </div>
</div>

@endsection

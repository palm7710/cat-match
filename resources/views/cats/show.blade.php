@extends('layouts.layout')

@section('content')

<div class='usershowPage'>
  <div class='container'>
    <header class="header">
      <p class='header_logo'>
      <a href="{{ route('cat.home') }}">
      <img src="/storage/images/techpit-match-icon.png">
      </a>
      </p>
    </header>
    <div class='userInfo'>
      <div class='userInfo_img'>
      <img src="/storage/images/{{ $cat->img_name }}">
      </div>
      <div class='userInfo_name'>{{ $cat->name }}</div>
      <div class='userInfo_selfIntroduction'>{{ $cat->self_introduction }}</div>
    </div>
    
      <div class='userAction'>
        <div class="userAction_edit userAction_common">
          
          <!-- この行を編集 -->
          <a href="/cats/edit/{{ $cat->id }}"><i class="fas fa-edit fa-2x"></i></a>
          
          <span>情報を編集</span>
          
        </div>
        <div class='userAction_logout userAction_common'>
        <a href="{{ route('cat.logout') }}" onclick="event.preventDefault();
          document.getElementById('logout-form').submit();"><i class="fas fa-cog fa-2x"></i></a>
          <span>ログアウト</span>
          <form id="logout-form" action="{{ route('cat.logout') }}" method="POST" style="display: none;">
              {{ csrf_field() }}
          </form>
        </div>
      </div>
    
  </div>
</div>

@endsection

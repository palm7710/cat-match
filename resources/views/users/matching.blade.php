@extends('layouts.layout')

@section('content')

<div class="matchingPage">
  <header class="header">
    <i class="fas fa-comments fa-3x"></i>
    <div class="header_logo"><a href="{{ route('user.home') }}"><img src="/storage/images/techpit-match-icon.png"></a></div>
  </header>
  <div class="container">
    <div class="mt-5">
      <div class="matchingNum">{{ $catsCount }}匹とマッチングしています</div>
      <h2 class="pageTitle">マッチングした保護猫一覧</h2>
      <div class="matchingList">
      @foreach($matching_cats as $cat)
          <div class="matchingPerson">
          <div class="matchingPerson_img"><img src="/storage/images/{{ $cat->img_name }}"></div>
            <div class="matchingPerson_name">{{ $cat->name }}</div>
          </div>
        @endforeach
      </div>
    </div>
  </div>
</div>

@endsection

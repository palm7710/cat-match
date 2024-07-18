var currentCatIndex = 0;
var postReaction = function (to_cat_id, reaction) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });
  $.ajax({
    type: "POST",
    url: "/api/like",
    data: {
      to_cat_id: to_cat_id,
      from_user_id: from_user_id,
      reaction: reaction,
    },
    success: function (j_data) {
      console.log("success")
    }
  });
}
$("#tinderslide").jTinder({
  onDislike: function (item) {
    currentCatIndex++;
    checkCatNum();
    var to_cat_id = item[0].dataset.cat_id;
    postReaction(to_cat_id, 'dislike');
  },
  onLike: function (item) {
    currentCatIndex++;
    checkCatNum();
    var to_cat_id = item[0].dataset.cat_id;
    postReaction(to_cat_id, 'like');
  },
  animationRevertSpeed: 200,
  animationSpeed: 400,
  threshold: 1,
  likeSelector: '.like',
  dislikeSelector: '.dislike'
});
$('.actions .like, .actions .dislike').click(function (e) {
  e.preventDefault();
  $("#tinderslide").jTinder($(this).attr('class'));
});

function checkCatNum() {
  // スワイプする猫の数とスワイプした回数が同じになればaddClassする
  if (currentCatIndex === catsNum) {
    $(".noCat").addClass("is-active");
    $("#actionBtnArea").addClass("is-none");
    return;
  }
}

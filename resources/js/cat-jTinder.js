var currentUserIndex = 0;
var postReaction = function (user_id, reaction) {
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
    }
  });
  $.ajax({
    type: "POST",
    url: "/api/like",
    data: {
      user_id: user_id,
      cat_id: from_cat_id,
      reaction: reaction,
    },
    success: function (j_data) {
      console.log("success")
    }
  });
}
$("#tinderslide").jTinder({
  onDislike: function (item) {
    currentUserIndex++;
    checkUserNum();
    var user_id = item[0].dataset.user_id;
    postReaction(user_id, 'dislike');
  },
  onLike: function (item) {
    currentUserIndex++;
    checkUserNum();
    var user_id = item[0].dataset.user_id;
    postReaction(user_id, 'like');
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

function checkUserNum() {
  // スワイプするユーザーの数とスワイプした回数が同じになればaddClassする
  if (currentUserIndex === usersNum) {
    $(".noUser").addClass("is-active");
    $("#actionBtnArea").addClass("is-none");
    return;
  }
}

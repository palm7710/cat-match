$(document).on("change", "#file_photo", function(e) {
    console.log("ファイルが選択されました"); // コンソールログの追加
    var reader;
    if (e.target.files.length) {
        reader = new FileReader();
        reader.onload = function(e) {
            var userThumbnail;
            userThumbnail = document.getElementById('thumbnail');
            $("#userImgPreview").addClass("is-active");
            userThumbnail.setAttribute('src', e.target.result);
            console.log("画像が更新されました"); // コンソールログの追加
        };
        return reader.readAsDataURL(e.target.files[0]);
    }
});

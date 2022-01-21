$(function() {
    $('.login_form').on("keydown", function(e) {
        var n = $(".login_form").length;
        if (e.which == 13) {
            //エンターキーが押された時にsubmitが発火する事を防ぐ
            e.preventDefault();
            // 現在の要素
            var Index = $('.login_form').index(this);
            // 次の要素
            var nextIndex = $('.login_form').index(this) + 1;
            var hogeIndex = $('.login_form').index($("#end_form")); // 特定要素
            if (Index === hogeIndex) {
                $('.login_form')[Index].blur();         // #hogeではフォーカスを外す
            } else if (nextIndex < n) {
                $('.login_form')[nextIndex].focus();    // 次の要素へフォーカスを移動
            } else {
                $('.login_form')[Index].blur();         // 最後の要素ではフォーカスを外す
            }
        }
    });
});
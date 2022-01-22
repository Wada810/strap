$(function(){
    /////////会員登録////////////
    //モーダルを表示
    $('#open_login_modal').click(function(){
        $('#login_modal_wrapper').fadeIn(300).css('display','flex');
    });
    //伝播阻止
    $('#login_modal').click(function(e){
        e.stopPropagation();
    });
    //背景部分でモーダルを閉じる
    $('#login_modal_wrapper').click(function(){
        $('#login_modal_wrapper').fadeOut(300);
    });
    //閉じるボタンでモーダルを閉じる
    $('#login_modal_close').click(function(){
        $('#login_modal_wrapper').fadeOut(300);
    });
    /////////ログイン////////////
    //モーダルを表示
    $('#open_signin_modal').click(function(){
        $('#signin_modal_wrapper').fadeIn(300).css('display','flex');
    });
    //伝播阻止
    $('#signin_modal').click(function(e){
        e.stopPropagation();
    });
    //背景部分でモーダルを閉じる
    $('#signin_modal_wrapper').click(function(){
        $('#signin_modal_wrapper').fadeOut(300);
    });
    //閉じるボタンでモーダルを閉じる
    $('#signin_modal_close').click(function(){
        $('#signin_modal_wrapper').fadeOut(300);
    });
    /////////新規スケジュール////////////
    //モーダルを表示
    $('#open_add_schedule_modal').click(function(){
        $('#add_schedule_modal_wrapper').fadeIn(300).css('display','flex');
    });
    //伝播阻止
    $('#add_schedule_modal').click(function(e){
        e.stopPropagation();
    });
    //背景部分でモーダルを閉じる
    $('#add_schedule_modal_wrapper').click(function(){
        $('#add_schedule_modal_wrapper').fadeOut(300);
    });
    //閉じるボタンでモーダルを閉じる
    $('#add_schedule_modal_close').click(function(){
        $('#add_schedule_modal_wrapper').fadeOut(300);
    });
    ////////グループ作成モーダル/////////////
    //モーダルを表示
    $('#open_create_group_modal').click(function(){
        $('#create_group_modal_wrapper').fadeIn(500).css('display','flex');
    });
    //伝播阻止
    $('#create_group_modal').click(function(e){
        e.stopPropagation();
    });
    //背景部分でモーダルを閉じる
    $('#create_group_modal_wrapper').click(function(){
        $('#create_group_modal_wrapper').fadeOut(500);
    });
    //閉じるボタンでモーダルを閉じる
    $('#create_group_modal_close').click(function(){
        $('#create_group_modal_wrapper').fadeOut(500);
    });
});
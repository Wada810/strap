/* //スケジュールのコマを生成する
let fix = $('.hour_row').height();
let board = $('.hour_bg');
let board_height = board.height() - fix;
let min_height = board_height / (24 * 60);
let frame_height = 0;
let period = 0;
let day_list = [7,1,2,3,4,5,6];
let col = $('.day_col');
for(i = 0; i < schedules.length; i ++){
    let start = new Date(schedules[i]["start"]);
    let end = new Date(schedules[i]["end"]);
    let top = new Date(schedules[i]["start"]);
    //0時0分0秒にする
    top.setHours(0);
    top.setMinutes(0);
    top.setSeconds(0);
    period = (end - start) / (1000 * 60);
    parseInt(period);//コマの分数を計算
    frame_height = min_height * period;
    let distance = (start - top) / (1000 * 60);
    distance = (min_height * distance) + (fix / 2);
    let where = start.getDay();
    where = day_list[where];

    $('.frame').eq(where).append('<div class="schedule" style="top: ' + distance + 'px; background-color: #fff; height : '
    + frame_height + 'px;"><div class="title">' + schedules[i]["title"] + '</div><div class="time">'
    + start.getHours().toString().padStart(2, "0") + ':' + start.getMinutes().toString().padStart(2, "0")
    + '~' + end.getHours().toString().padStart(2, "0") + ':' + end.getMinutes().toString().padStart(2, "0") + '</div></div>');

} */
let icon_w = $('.block_icon').width();
$('.block_icon').css({
    "font-size": icon_w + "px",
});
$(function(){
    /////////会員登録////////////
    //モーダルを表示
    $('.block_icon').click(function(){
        console.log('aaa');
        $('#block_modal_wrapper').fadeIn(300).css('display','flex');
    });
    //伝播阻止
    $('#block_modal').click(function(e){
        e.stopPropagation();
    });
    //背景部分でモーダルを閉じる
    $('#block_modal_wrapper').click(function(){
        $('#block_modal_wrapper').fadeOut(300);
    });
    //閉じるボタンでモーダルを閉じる
    $('#block_modal_close').click(function(){
        $('#block_modal_wrapper').fadeOut(300);
    });
});

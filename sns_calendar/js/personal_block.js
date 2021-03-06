//スケジュールのコマを生成する
let fix = $('.hour_row').height();
let board = $('.hour_bg');
let board_height = board.height() - fix;
let min_height = board_height / (24 * 60);
let frame_height = 0;
let period = 0;
let day_list = [7,1,2,3,4,5,6];
let span_list = ["clear","circle","change_history","question_mark"];
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

    $('.frame').eq(where).append('<div class="schedule c' + schedules[i]["state"] + '" style="top: ' + distance + 'px; height: ' + frame_height + 'px;"><span class="material-icons-outlined block_icon">' + span_list[schedules[i]["state"]] + '</span></div>');
}
let icon_w = $('.block_icon').width();
$('.block_icon').css({
    "font-size": icon_w + "px",
});

//スケジュールのコマを生成する
let board = $('.hour_bg');
let board_height = board.height();
let min_height = board_height / (24 * 60);
let frame_height = 0;
let period = 0;
let day_list = [7,1,2,3,4,5,6];
let col = $('.day_col');
console.log(board_height);
for(let i = 0; i < schedules.length; i ++){
    let start = new Date(schedules[i]["start"]);
    let top = new Date(schedules[i]["start"]);
    //0時0分0秒にする
    top.setHours(0);
    top.setMinutes(0);
    top.setSeconds(0);
    let end = new Date(schedules[i]["end"]);
    period = (end - start) / (1000 * 60);
    parseInt(period);//コマの分数を計算
    frame_height = min_height * period;
    let distance = (start - top) / (1000 * 60);
    distance = (min_height * distance) + (min_height * 58);
    let where = start.getDay();
    where = day_list[where];
    console.log(where);
    $('.day_col').eq(where).append('<div class="schedule" style="top: ' + distance + 'px; height: ' + frame_height + 'px;"><div class="title">IH12</div><div class="time">12:00~1:30</div></div>');
    //$("#month").append('<div class="schedule">a</div>');
}
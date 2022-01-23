function getRandomIntInclusive(min, max) {
    min = Math.ceil(min);
    max = Math.floor(max);
    return Math.floor(Math.random() * (max - min + 1) + min); //The maximum is inclusive and the minimum is inclusive
  }
//スケジュールのコマを生成する
let fix = $('.hour_row').height();
let board = $('.hour_bg');
let board_height = board.height() - fix;
let min_height = board_height / (24 * 60);
let frame_height = 0;
let period = 0;
let day_list = [7,1,2,3,4,5,6];
let col = $('.day_col');
let hue = 200;
let category = {
    "" : hue,
};
let j = 0;
for(let i = 0; i < schedules.length; i ++){
    if(schedules[i]["category"] in category){

    }else{
        hue += 45;
        category[schedules[i]["category"]] = hue;
    }
}
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

    $('.frame').eq(where).append('<div class="schedule" style="top: ' + distance + 'px; background-color: hsla(' + category[schedules[i]["category"]] + ', 100%, 80%, 0.8); color: hsla(' + (category[schedules[i]["category"]] + 20) + ', 100%, 30%, 1); height : '
    + frame_height + 'px;"><div class="title">' + schedules[i]["title"] + '</div><div class="time">'
    + start.getHours().toString().padStart(2, "0") + ':' + start.getMinutes().toString().padStart(2, "0")
    + '~' + end.getHours().toString().padStart(2, "0") + ':' + end.getMinutes().toString().padStart(2, "0") + '</div></div>');

}
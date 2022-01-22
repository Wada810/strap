let wait = 500;//ミリ秒後に送信する
let timeid_name;
$(function() {
    $('input[name="user_search"]').keyup(function(){
        clearTimeout(timeid_name);
        timeid_name = setTimeout(() => {
            let keyword =$(this).val();
            console.log(keyword);
            if(keyword == ''){
    
            }
            else{
                $.ajax({
                    type: "POST",
                    url: "./json_encode.php",
                    dataType : "json" ,
                    async : true ,
                    data : {user_id:keyword}
                }).done(function(data){
                    $('#candidate').html('');
                    data.forEach(element => {
                        $('#candidate').append("<div class='candidate_box'><p><img src='./img/user/" + element.id + "/" + element.img_name + "' alt=''></p><p>" + element.user_name + "</p><p>" + element.login_id + "</p></div>");
                    });
                    $('.candidate_box').click(function(){
                        let index = $('.candidate_box').index(this);
                        $('#select_display_area').append("<div class='select_item'><img src='./img/user/" + data[index].id + "/" + data[index].img_name + "' alt='ユーザーアイコン'><p>" + data[index].user_name + "</p><input type='hidden' name='member_id[]' value='" + data[index].id + "'><i class='fas fa-times-circle tag_del'></i></div>");
                        $('#candidate').html('');
                        $('input[name="user_search"]').val('');
                    });
                }).fail(function(){
                    console.log('error');
                });
            }
        },wait);
    });

    
});
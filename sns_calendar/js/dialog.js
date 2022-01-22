
    //作業完了のダイアログをけす
    function close_dialog(){
        document.getElementById("dialog_close").addEventListener("click",()=>{
            document.getElementById("dialog").remove();
            console.log("remove");
            dialog_msg_session_delete();
        })
    }

    //作業完了のダイアログをけす時に通信しsessionを削除
    function dialog_msg_session_delete (){
        var req = new XMLHttpRequest();
        req.onreadystatechange = function (){
            if(req.readyState == 4){//通信の完了時
                if(req.status == 200){//通信の成功時
                }
            }else{
                req.innerHTML = "通信中...";
            }
        }
        req.open("POST","api.php",true);//送信先のurl　方式post
        req.setRequestHeader('content-type',
        'application/x-www-form-urlencoded;charset=UTF-8');//ヘッダを設定
        req.send("dialog=close");//送信する内容
    }
    close_dialog()
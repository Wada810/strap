"use strict";

//list.php のクリックイベント制御

    //追加の前に長い要素を配置し折り返させる
    function add_space (){
        let last = document.querySelectorAll("#narrow_down > span");
        let space = document.createElement("div");
        space.style.width =  "100%";
        document.getElementById("narrow_down").insertBefore(space,last[last.length - 1]);
    }
    //プラスボタンで要素表示を切り替える
    function add_filter() {
        document.querySelector("#filter_box > span").addEventListener("click",()=>{
            document.getElementById("add_filter").classList.toggle("hidden");
            document.querySelector("#filter_box > span").classList.toggle("active");
        })
    }
    //項目ごとにそれぞれのボックスの表示をきりかえる
    function each_filters (){
        let filters = document.querySelectorAll("#add_filter > li");
        let p = document.querySelectorAll("#add_filter > li > p");
        for(let i = 0; i < filters.length; i++){
            p[i].addEventListener("click",()=>{
                for(let j = 0; j < filters.length; j ++){
                    if(i == j){
                        filters[j].lastElementChild.classList.toggle("hidden");
                    }else{
                        filters[j].lastElementChild.classList.add("hidden");
                    }
                }
            })
        }
    }
    //追加ボタンの範囲外をクリックしたとき非表示にする
    let filter_hidden = function (e){
        if(e.closest("#filter_box") == null){
            document.getElementById("add_filter").classList.add("hidden");
            document.querySelector("#filter_box > span").classList.remove("active");
        }
    }
    //3点リーダーの範囲外をクリックしたとき非表示にする
    let edit_hidden = function (e){
        let rows = document.getElementsByClassName("main_data");
        for(let i = 0; i < rows.length; i ++){
            let td = rows[i].lastElementChild;
            if(e.closest(".main_data > td:last-of-type") == null){
                td.querySelector(".edit_delete").classList.add("hidden");
                td.querySelector("span").classList.add("horiz");
                td.querySelector("span").classList.remove("close");
            }
        }
    }
    function show_tool (){
        document.getElementById("show_less").addEventListener("click",()=>{
            document.querySelector("form").classList.toggle("less");
            document.querySelector("#show_less span").classList.toggle("showless");
            document.querySelector("#show_less span").classList.toggle("showmore");
        })
    }
    //編集削除の表示
    function edit_delete (){
        let rows = document.getElementsByClassName("main_data");
        for(let i = 0; i < rows.length; i ++){
            let td = rows[i].lastElementChild;
            td.querySelector("span").addEventListener("click",()=>{
                td.querySelector(".edit_delete").classList.toggle("hidden");
                td.querySelector("span").classList.toggle("horiz");
                td.querySelector("span").classList.toggle("close");
            })
        }
    }
    //作業完了のダイアログをけす
    function close_comp(){
        document.getElementById("comp_msg_close").addEventListener("click",()=>{
            document.getElementById("comp_msg").remove();
            comp_msg_session_delete();
        })
    }

    //作業完了のダイアログをけす時に通信しsessionを削除
    function comp_msg_session_delete (){
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
        req.send("comp_msg=close");//送信する内容
    }

    //画像の表示・非表示切り替え
    function image_visivilty_toggle (){
        document.getElementById("image_visibility").addEventListener("click",()=>{
            if(document.getElementById("image_visibility").classList.length == 1){
                document.getElementById("image_visibility").classList.add("toggle_off");
                document.querySelector("th").classList.remove("invisible");
                let images = document.getElementsByClassName("main_data");
                for(let i = 0; i < images.length; i++){
                    images[i].querySelector("td").classList.remove("invisible");
                }
                image_visivilty_save("");
            }else{
                document.getElementById("image_visibility").classList.remove("toggle_off");
                document.querySelector("th").classList.add("invisible");
                let images = document.getElementsByClassName("main_data");
                for(let i = 0; i < images.length; i++){
                    images[i].querySelector("td").classList.add("invisible");
                }
                image_visivilty_save("invisible");
            }
        })
    }
    //画像の表示・非表示切り替え設定を保存
    function image_visivilty_save(visibility){
        var req = new XMLHttpRequest();
        req.open("POST","api.php",true);//送信先のurl　方式post
        req.setRequestHeader('content-type',
        'application/x-www-form-urlencoded;charset=UTF-8');//ヘッダを設定
        req.send("image_visibility=" + visibility);//送信する内容
    }
    //ダークモードを切り替える
    function dark_mode_toggle(){
        document.getElementById("dark_mode").addEventListener("click",()=>{
            if(document.getElementById("dark_mode").classList.length == 1){
                document.getElementById("dark_mode").classList.add("toggle_off");
                document.documentElement.setAttribute('theme', '');
                brightness_theme_save("");
            }else{
                document.getElementById("dark_mode").classList.remove("toggle_off");
                document.documentElement.setAttribute('theme', 'dark');
                brightness_theme_save("dark");
            }
        })
    }
    //ダークテーマの設定を保存
    function brightness_theme_save(theme){
        var req = new XMLHttpRequest();
        req.open("POST","api.php",true);//送信先のurl　方式post
        req.setRequestHeader('content-type',
        'application/x-www-form-urlencoded;charset=UTF-8');//ヘッダを設定
        req.send("brightness_theme=" + theme);//送信する内容
    }
    //設定ボタンが押されたら中身を表示
    function setting_show(){
        document.getElementById("settings").addEventListener("click",()=>{
            if(document.getElementById("setting_icon").textContent == "settings"){
                document.getElementById("setting_icon").textContent = "close";
            }else{
                document.getElementById("setting_icon").textContent = "settings";
            }
            document.getElementById("setting_list").classList.toggle("hidden");
        })
    }
    //表示設定の外のボックスをクリックしたら閉じる
    function close_settings(e){
        if(e.closest("#setting_box") == null){
            document.getElementById("setting_icon").textContent = "settings";
            document.getElementById("setting_list").classList.add("hidden");
        }
    }


    //巻数の範囲が選択された時入力ボックスを増やす
    function volume_range(){
        document.getElementById("volume_search_type").onchange = ()=>{
            if(document.getElementById("volume_search_type").value === "range"){
                let newdiv = document.createElement("div");
                newdiv.setAttribute("class","input_box range");
                newdiv.setAttribute("id","added_volume");
                let newinput = document.createElement("input");
                newinput.setAttribute("class","num");
                newinput.setAttribute("name","volume_search_range");
                newinput.setAttribute("type","number");
                newinput.setAttribute("min",0);
                let newspan = document.createElement("span");
                newspan.textContent = "巻";
                document.querySelector(".volume li").appendChild(newdiv);
                document.getElementById("added_volume").appendChild(newinput);
                document.getElementById("added_volume").appendChild(newspan);
            }else{
                if(document.getElementById("added_volume") !== null){
                    document.getElementById("added_volume").remove();
                }
            }
        }
    }
    //価格の範囲が選択された時入力ボックスを増やす
    function price_range(){
        document.getElementById("price_search_type").onchange = ()=>{
            if(document.getElementById("price_search_type").value === "range"){
                let newdiv = document.createElement("div");
                newdiv.setAttribute("class","input_box range");
                newdiv.setAttribute("id","added_price");
                let newinput = document.createElement("input");
                newinput.setAttribute("class","num");
                newinput.setAttribute("name","price_search_range");
                newinput.setAttribute("type","number");
                newinput.setAttribute("min",0);
                let newspan = document.createElement("span");
                newspan.textContent = "円";
                document.querySelector(".price li").appendChild(newdiv);
                document.getElementById("added_price").appendChild(newinput);
                document.getElementById("added_price").appendChild(newspan);
            }else{
                if(document.getElementById("added_price") !== null){
                    document.getElementById("added_price").remove();
                }
            }
        }
    }

    //イベント設定
    add_space();
    add_filter();
    each_filters();
    window.addEventListener("mousedown",e =>{
        filter_hidden(e.target);
        edit_hidden(e.target);
        close_settings(e.target);
    })
    show_tool();
    edit_delete();
    close_comp();
    setting_show();
    image_visivilty_toggle();
    dark_mode_toggle();
    volume_range();
    price_range();


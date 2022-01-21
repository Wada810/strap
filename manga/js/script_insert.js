"use strict";

//選択したファイル名を取得し表示する
function get_filename (){
    document.getElementById("cover_img").addEventListener("change",()=>{
        if(document.getElementById("cover_img").files[0] !== undefined){
            let filename = document.getElementById("cover_img").files[0].name;
            if(filename.length > 30){
                filename = filename.substring(0,20) + "..." + filename.substring(filename.length - 10)
            }
            document.getElementById("select_img").innerHTML = filename;
            previewImage(document.getElementById("cover_img"));
            document.getElementById("drug_drop").classList.add("hidden");
        }else{
            document.getElementById("drug_drop").classList.remove("hidden");
            document.getElementById("select_img").innerHTML = "画像を選択する";
            document.getElementById('preview').src = "data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==";
        }
    })
}
//画像をプレビューする
function previewImage (obj){
	var fileReader = new FileReader();
	fileReader.onload = (function() {
		document.getElementById('preview').src = fileReader.result;
	});
	fileReader.readAsDataURL(obj.files[0]);
}

get_filename();
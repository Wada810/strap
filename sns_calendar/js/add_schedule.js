for(let i=1; i<=100; i++){
    var option = $(document.createElement('option'));
    option.attr({
        "value": i,
    })
    option.text(i);
    $("#repeat_frequency").append(option);
}
$('#repeat_every').on("change",(e)=>{
    if(e.target.value == "no"){
        $('.repeat').addClass("hidden")
    }else{
        $('.repeat').removeClass("hidden")
    }
})
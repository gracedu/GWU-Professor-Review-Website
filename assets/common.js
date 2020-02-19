$(document).ready(function () {
    fixFooter();
    $(".form-ajax-btn").click(function(e){
        e.preventDefault();
        var btn=$(this);
        formAjaxSubmit(btn,commonSucHdl,commonErrHdl);
    });
});
//获取当前浏览器的高度，然后计算出当前窗口的body组件的高度
function fixFooter(){
    var windowHeight=$(window).height();
    var headHeight=$("#head").height();
    var footHeight=$("#foot").height();
    var bodyHeight=windowHeight-headHeight-footHeight;
    $("#body").css("min-height",bodyHeight);
}

//异步提交公共方法处理
function formAjaxSubmit(btn,success,error){
    var f=btn.closest("form");
    //var f=$(".form-ajax-post");
    var u=f.attr("data-action");
    var data=f.serialize();
    $.ajax({
        url:u,
        type:'post',
        data:data,
        success:function(result){
            var r=JSON.parse(result);
            if(r.success){
                success(r);
                headerPage(f.attr('data-url'));
            }
            else{
                error(r);
            }
        },
        error:function(r){
            alert("通讯故障，请联系管理员处理");
        }
    })
}
//返回消息为成功后的处理
function commonSucHdl(r){
    alert(r.info);
}
//返回消息为失败的处理
function commonErrHdl(r){
    alert(r.error);
}
//页面跳转
function headerPage(url){
    window.location.href=url;
}



;
var ops={
    init:function(){
        this.eventBind();
    },
    eventBind:function(){
        var that=this;
        $(".form-signin").submit(function(){
                var username= $.trim($("#username").val());
                var target=$("#tips");
                if(!that.isEmail(username)){
                    //target.attr("class","alert alert-success");
                    target.attr("class","alert alert-error");
                    $(target.find("strong").get(0)).html("用户名格式不对!!请填写邮箱");
                    target.show();
                    return false;
                }
                return true;
        });
    },
    isEmail:function(email) {
        if (email.search(/^([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+@([a-zA-Z0-9]+[_|_|.]?)*[a-zA-Z0-9]+\.(?:com|cn|org|cc|co|net)$/) != -1){
            return true;
        }else{
            return false;
        }
    }
}
$(document).ready(function(){
    ops.init();
});
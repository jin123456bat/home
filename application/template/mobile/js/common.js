var upload = function(input){  
    if(window.FormData)  
    {  
        if(input.val() == '' || input.val() == 'undefined')  
            return false;  
          
        var files = input[0].files;//保存要上传的文件  
        var formData = new FormData();//文件上传通道  
        var fileReader = new FileReader();  
          
        var getFileType = function(filename){  
            var extStart  = filename.lastIndexOf(".")+1;  
            return filename.substring(extStart,filename.length).toUpperCase();  
        };  
          
        var clearInput = function(){  
            input.val('');  
        };  
          
        var getKey = function(){//获得一个key  10位数字  这样可以保证几率比较小了  假如还想要几率小  可以计算md5  
            return Math.floor(Math.random()*10000000000);  
        };  
          
        var key = getKey();//保存文件的唯一key  
        var url = input.attr('data-url')||arguments[1].url;//上传地址  
        var progress = arguments[1].progress;//上传进度条  
        var complete = arguments[1].complete;//上传完成  
        var error = arguments[1].error;//上传失败  
        var maxSize = arguments[1].maxSize;//文件大小  单位字节  过滤器  
        var fileType = arguments[1].fileType;//文件类型  过滤器  
        var data = arguments[1].data;//额外数据  
        var onStart = arguments[1].onStart;//准备上传  
        var abortBtn = arguments[1].abortBtn;//中断上传按钮  
        var onAbort = arguments[1].onAbort;//中断函数  
        //文件类型验证  
        var type = getFileType(files[0].name);//获得文件类型  
        var typeAllow = false;  
        if(typeof fileType == 'object')  
        {  
            var arrayType = fileType.type;  
            $.each(arrayType,function(index,value){  
                if(value.toUpperCase() == type)  
                {  
                    typeAllow = true;  
                    return false;//相当于break  
                }  
            });  
            if(!typeAllow)  
            {  
                fileType.error(files[0],key);  
                return false;  
            }  
        }  
        //文件大小验证  
        if(typeof maxSize == 'number')  
        {  
            if(files[0].size >= maxSize)  
            {  
                maxSize.error(files[0],key);  
                return false;  
            }  
        }  
        else if(typeof maxSize == 'object')  
        {  
            if(files[0].size >= maxSize.size)  
            {  
                maxSize.error(files[0],key);  
                return false;  
            }  
        }  
        //将文件加入到上传通道  
        formData.append(input.attr('name')||'files', files[0]);  
        var xhr = new XMLHttpRequest();  
        //附加额外的数据  
       /* if(data != '' && data != 'undefined')  
        {  
            $.each(data,function(index,value){  
                formData.append(index,value);  
            });  
        }*/  
        //开始上传  
        xhr.open('POST',url,true);  
        xhr.onload = function(){  
            if(xhr.status == 200 && xhr.readyState == 4)  
            {  
                if(typeof complete == 'function')  
                    complete(xhr.response,files[0],key);  
                //clearInput();  
            }  
            else  
            {  
                if(typeof error == 'function')  
                    error(files[0],key);  
            }  
        };  
        xhr.upload.onprogress = function(event){  
            progress(event,files[0],key);  
        };  
        xhr.onloadstart = function(event){  
            //onStart(event,files[0],key);  
        };  
        xhr.send(formData);  
        //添加中断  
        $('.'+key).find(abortBtn).click(function(){  
            xhr.abort();  
            //onAbort(files[0],key);  
        });  
        return {key:key,xhr:xhr};  
    }  
    else  
    {  
        alert('浏览器版本过低');  
        return null;  
    }  
}  
function toggleCaidan(){
  if($('.caidan').hasClass('small')){
      $('.caidan').removeClass('small');
      $("#mask2").show();
    }else{
      $('.caidan').addClass('small');
      $("#mask2").hide();
    }
}
//weixin==wap
function is_weixin(){
  var ua = navigator.userAgent.toLowerCase();
  if(ua.match(/MicroMessenger/i)=="micromessenger") {
    return true;
  } else {
    return false;
  }
}
var config_base = {};
if(is_weixin()){
  config_base.pingtai = "weixin";
  config_base.paytype = "weixin";
  config_base.trade = "jsapi";
}else{
  config_base.pingtai = "wap";
  config_base.paytype = "alipay";
  config_base.trade = "wap";
}
console.log(config_base.pingtai);


function showDiv(s){
	$(""+s+"").show();
}
function hideDiv(s){
  $(""+s+"").hide();
}
function isObjectValueEqual(a, b) {
    // Of course, we can do it use for in 
    // Create arrays of property names
    var aProps = Object.getOwnPropertyNames(a);
    var bProps = Object.getOwnPropertyNames(b);
 
    // If number of properties is different,
    // objects are not equivalent
    if (aProps.length != bProps.length) {
        return false;
    }
 
    for (var i = 0; i < aProps.length; i++) {
        var propName = aProps[i];
 
        // If values of same property are not equal,
        // objects are not equivalent
        if (a[propName] !== b[propName]) {
            return false;
        }
    }
 
    // If we made it this far, objects
    // are considered equivalent
    return true;
}
var BASEURL = 'http://home.hzlianhai.com/index.php';
var BASER = 'http://home.hzlianhai.com';
var loadNum = 4;
var defaultProPic = 'images/pro1.jpg';
var baseThemeUrl = 'index.php?c=mobile&a=themeDetail';
var baseProUrl = 'index.php?c=mobile&a=proDetail';
var basePhoto = 'images/default.png';

Date.prototype.format = function(format) {
       var date = {
              "M+": this.getMonth() + 1,
              "d+": this.getDate(),
              "h+": this.getHours()<10?("0"+this.getHours()):this.getHours(),
              "m+": this.getMinutes()<10?("0"+this.getMinutes()):this.getMinutes(),
              "s+": this.getSeconds()<10?("0"+this.getSeconds()):this.getSeconds(),
              "q+": Math.floor((this.getMonth() + 3) / 3),
              "S+": this.getMilliseconds()
       };
       if (/(y+)/i.test(format)) {
              format = format.replace(RegExp.$1, (this.getFullYear() + '').substr(4 - RegExp.$1.length));
       }
       for (var k in date) {
              if (new RegExp("(" + k + ")").test(format)) {
                     format = format.replace(RegExp.$1, RegExp.$1.length == 1
                            ? date[k] : ("00" + date[k]).substr(("" + date[k]).length));
              }
       }
       return format;
}
function cartnum(){
	$.ajax( {    
    url:BASEURL+'?c=product&a=information',// 跳转到 action    
    data:{    
        c:'cart',
        a:'mycart',
        pid:pid
    },    
    type:'get',    
    cache:false,    
    dataType:'json',    
    success:function(data) { 
      if(data.code == 1){
        var n = data.body.length;
        $('.cartnum').text(n);
      }else{
        // alert(data.result);
        console.log(data.code);
      } 
    } 
  });
}
function calRestTime(etime){
	console.log(etime);
	console.log(Date.parse(new Date())/1000);
	var time_distance = etime - Date.parse(new Date())/1000;
	console.log(time_distance);
  int_hour = Math.floor(time_distance/3600)
  time_distance -= int_hour * 3600;
  int_minute = Math.floor(time_distance/60)
  time_distance -= int_minute * 60;
  int_sec = Math.floor(time_distance)
  return int_hour+":"+int_minute+":"+int_sec;
}
function countTime(id){
	var _this = $('#'+id);
    var time_now = new Date();  // 获取当前时间
        time_now = time_now.getTime();
    var time_end = _this.attr('eTime-data');
    var time_distance = time_end - time_now;  // 结束时间减去当前时间
    var int_day, int_hour, int_minute, int_second;
    if(time_distance >= 0){
        // 天时分秒换算
        int_day = Math.floor(time_distance/86400000)
        time_distance -= int_day * 86400000;
        int_hour = Math.floor(time_distance/3600000)
        time_distance -= int_hour * 3600000;
        int_minute = Math.floor(time_distance/60000)
        time_distance -= int_minute * 60000;
        int_second = Math.floor(time_distance/1000)
 
        // 时分秒为单数时、前面加零站位
        if(int_hour < 10)
        int_hour = "0" + int_hour;
        if(int_minute < 10)
        int_minute = "0" + int_minute;
        if(int_second < 10)
        int_second = "0" + int_second;
        
        // 显示时间
        var hs = int_day+'天'+int_hour+':'+int_minute+':'+int_second;
        _this.text(hs);
        
        setTimeout(function(){
        	countTime(id);
        },1000);
    }else{

    }
}
function togleAttr(obj,att,a,b){
  var attValue = $(obj).attr(att);
  if(attValue == a){
    $(obj).attr(att,b);
  }else{
    $(obj).attr(att,a);
  }
}
function calSum(id){
	$.ajax( {    
    url:BASEURL+'?c=cart&a=calculation',// 跳转到 action    
    data:{    
    },    
    type:'get',    
    cache:false,    
    dataType:'json',    
    success:function(data) { 
      if(data.code == 1){
        $('#'+id).text(data.body);
      }else{
        // alert(data.result);
        console.log(data.code);
      } 
    } 
  });
}
function alert(text){
  swal(text);
}
function html_decode(str){
    var s = "";
    if (str.length == 0) return "";
    s = str.replace(/&amp;/g, "&");
    s = s.replace(/&lt;/g, "<");
    s = s.replace(/&gt;/g, ">");
    s = s.replace(/&nbsp;/g, " ");
    s = s.replace(/&#39;/g, "\'");
    s = s.replace(/&quot;/g, "\"");
    s = s.replace(/<br\/>/g, "\n");
    return s;
} 



















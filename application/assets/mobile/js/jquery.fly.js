//用于左右或上下滑动一个块，先引用jquery.transit.js
// $("#te").fly({
//       d:false,
//       spaceWOH:300,
//       woh:$(this).height(),
//     });
(function($) {       
  $.fn.fly = function(options) {     
    var defaults = {    
      d: true,  //horizontal(横向):true,portrait：false
      spaceWOH:$(window).width(),//外部容器的宽度或长度
      woh:$(this).width(),//自己的长度或宽度
    };    
    // Extend our default options with those provided.    
    var opts = $.extend(defaults, options);
    return this.each(function(){
      // $(this).html(opts.prefix+$(this).html());
      // $(this).css({ x: '100px' });
      var _this = $(this);
      var bxoy,sxoy,nxoy,xoy,nt,t,intv,speedXOY;
      var Speed = function(){
        if(xoy!=nxoy){
          speedXOY = (xoy-nxoy)/(t-nt);
        }else{
          speedXOY = 0;
          // console.log('no');
        }
        nxoy = xoy;
        nt = t;
        var ss = (xoy-sxoy+bxoy)+'px';
        // console.log(ss);
        if(opts.d){
          _this.css({ x: ss });
        }else{
           _this.css({ y: ss });
        }
        
      }

      var endspeed = function(){
        // console.log("50-bwidth:"+(opts.spaceWOH - opts.woh));
        // console.log(opts.spaceWOH);
        // console.log(opts.woh);
        if(xoy!=nxoy){
          speedXOY = (xoy-nxoy)/(t-nt);
        }
        var myxory = opts.d?_this.css("x"):_this.css("y");
        var xxoy = (parseInt(myxory)+speedXOY*300)+"px";
        var mhxoy = parseInt(myxory);
        // console.log(mhxoy);
        //控制不出界
        var thisxoy = parseInt(xxoy);//获取顶部位置数字
        // console.log(thisx);
        if(mhxoy > 0 || opts.spaceWOH > opts.woh || thisxoy>0){
          // _this.transition({ x: "0px"}, 200,'out');
          if(opts.d){
            _this.transition({ x: "0px"}, 200,'out');
          }else{
             _this.transition({ y: "0px"}, 200,'out');
          }
          // console.log(">0");
        }else if(mhxoy < opts.spaceWOH - opts.woh  || thisxoy < opts.spaceWOH - opts.woh ){
          
          if(opts.d){
            _this.transition({ x: (opts.spaceWOH-opts.woh )}, 200,'out');
          }else{
             _this.transition({ y: (opts.spaceWOH-opts.woh )}, 200,'out');
          }
          // console.log("50-bwidth:"+(opts.spaceWOH - opts.woh));
        }else{
          if(speedXOY){
            if(opts.d){
              _this.transition({ x: xxoy}, 500,'out');
            }else{
              _this.transition({ y: xxoy}, 500,'out');
            }
            
          }
        }
        speedXOY = 0;
      }

      _this.bind("touchstart",function(){
        var myxory = opts.d?_this.css("x"):_this.css("y");
        bxoy = parseInt(myxory);
        var touch = event.touches[0];
        sxoy = nxoy  = xoy = opts.d?touch.pageX:touch.pageY;
        nt = t = new Date().getTime();
        // console.log(sx);
        intv = setInterval(function(){
          Speed();
          // console.log('0');
        },10);
      });

      _this.bind("touchmove",function(){
        event.preventDefault(); 
        var touch = event.touches[0];
          xoy = opts.d?touch.pageX:touch.pageY;
          t = new Date().getTime();
      });
      _this.bind("touchend",function(){
        clearInterval(intv);
        endspeed();
      });

    });    
  };     

})(jQuery);
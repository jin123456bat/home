//用于左右或上下滑动一个块，先引用jquery.transit.js
// $("#te").fly({
//       d:false,
//       spaceWOH:300,
//       woh:$(this).height(),
//     });
(function($) {       
  $.fn.flyCart = function(options) {     
    var defaults = {    
      spaceWOH:$(window).width(),//外部容器的宽度或长度
      woh:$(this).width(),//自己的长度或宽度
    };    
    var opts = $.extend(defaults, options);
    return this.each(function(){
      var _this = $(this);
      var bxoy,sxoy,nxoy,xoy;
      var Speed = function(){
        var ss = (xoy-sxoy+bxoy)+'px';
          _this.css({ x: ss });
      }

      var endspeed = function(){
        var myxory = _this.css("x");
        var mhxoy = parseInt(myxory);
        if(mhxoy > (opts.spaceWOH-opts.woh)*0.5){
          _this.transition({ x: "0px"}, 200,'out');
        }else{
          _this.transition({ x: (opts.spaceWOH-opts.woh )}, 200,'out');
        }
      }

      _this.bind("touchstart",function(){
        bxoy = parseInt(_this.css("x"));
        sxoy = nxoy  = xoy = event.touches[0].pageX;
      });

      _this.bind("touchmove",function(){
        event.preventDefault(); 
        xoy = event.touches[0].pageX;
        Speed();
      });
      _this.bind("touchend",function(){
        endspeed();
      });

    });    
  };     

})(jQuery);
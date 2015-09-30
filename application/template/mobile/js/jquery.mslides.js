//用于左右或上下滑动一个块，先引用jquery.transit.js
// $("#te").fly({
//       d:false,
//       spaceWOH:300,
//       woh:$(this).height(),
//     });
(function($) {       
  $.fn.mslides = function(options) {     
    var defaults = {    
      slideContainer:'slider',
      page:'pagi',
      time:3000,
      height:300,
    };    
    // Extend our default options with those provided.    
    var opts = $.extend(defaults, options);
    var p = 1;
    return this.each(function(){
      var sliderCon = $('#'+opts.slideContainer);
      var page = $('#'+opts.page);
      var _this = $(this);
      var liNum = sliderCon.find('li').length;
      //在最后加第一张图
      // ul.append('<li>'+ul.find('li').eq(0).html()+'</li>');
      //复制ul
      sliderCon.append('<ul class="slide2 clearfix">'+sliderCon.find('ul').html()+'</ul>');
      //计算一些宽度和高度并初始化
      var ulW = sliderCon.find('.slide1 li').length*$(window).width();
      sliderCon.find('ul').css('width',ulW);
      sliderCon.find('li').css('width',$(window).width());
      // setTimeout(function(){
        //sliderCon.find('li').eq(0).height();
        console.log(opts.height);
        $(this).css('height',opts.height);
      // },500);
      
      //page
      page.append('<span class="item active"></span>');
      for(var i = 1;i<sliderCon.find('li').length/2;i++){
        page.append('<span class="item"></span>');
      }
      var ml = sliderCon.find('li').length*7.5/2;
      page.css('marginLeft',0-ml);
      //初始化为第一页
      p = 1;

      var slide1 = sliderCon.find('.slide1');
      var slide2 = sliderCon.find('.slide2');
      slide1.css({ x: '-'+ulW+'px' });
      //定时运动
      var setI = function(){
        // console.log(1);
        ux = parseInt(slide1.css("x"));
        ux2 = parseInt(slide2.css("x"));
        var winX = $(window).width();
        slide1.transition({ x: (ux-winX)+'px' }, 200,'out');//css({ x: (ux-winX)+'px' });
        slide2.transition({ x: (ux2-winX)+'px' }, 200,'out');
        //page
        page.find('.item').removeClass('active');
        p++;
        if(p == liNum){
          if(cur == 2){
            slide1.css({ x: winX+'px' });
          }else{
            slide2.css({ x: winX+'px' });
          }
        }
        if(p > liNum){
          p = 1;
          cur = (cur == 1)?2:1;
          // console.log(cur);
        }
        page.find('.item').eq(p-1).addClass('active');
      }
      var intval;

      intval = setInterval(setI,opts.time);
      //绑定手势
      var sx,ux,ux2;
      var cur = 2;
      if(liNum>1){
        _this.bind("touchstart",function(){
          clearInterval(intval);
          sx = event.touches[0].pageX;
          ux = parseInt(slide1.css("x"));
          ux2 = parseInt(slide2.css("x"));
          // console.log(ux);

        });
        _this.bind("touchmove",function(){
          event.preventDefault(); 
          var x = event.touches[0].pageX;
          slide1.css({ x: (ux+x-sx)+'px' });
          slide2.css({ x: (ux2+x-sx)+'px' });
        });
        _this.bind("touchend",function(){
          // console.log('0');
          var ex = event.changedTouches[0].pageX;
          var changeX = ex-sx;
          var winX = $(window).width();
          if(changeX<0){
            slide1.transition({ x: (ux-winX)+'px' }, 200,'out');//css({ x: (ux-winX)+'px' });
            slide2.transition({ x: (ux2-winX)+'px' }, 200,'out');
            //page
            page.find('.item').removeClass('active');
            p++;
            if(p == liNum){
              if(cur == 2){
                slide1.css({ x: winX+'px' });
              }else{
                slide2.css({ x: winX+'px' });
              }
            }
            if(p > liNum){
              p = 1;
              cur = (cur == 1)?2:1;
              // console.log(cur);
            }
            page.find('.item').eq(p-1).addClass('active');
          }else{
            slide1.transition({ x: (ux+winX)+'px' }, 200,'out');
            slide2.transition({ x: (ux2+winX)+'px' }, 200,'out');
            //page
            page.find('.item').removeClass('active');
            p--;
            if(p == 1){
              if(cur == 2){
                slide1.css({ x: '-'+ulW+'px' });
              }else{
                slide2.css({ x: '-'+ulW+'px' });
              }
            }
            if(p == 0){
              p = liNum;
              cur = (cur == 1)?2:1;
              // console.log(cur);
            }
            page.find('.item').eq(p-1).addClass('active');
          }
          intval = setInterval(setI,opts.time);
        });
      }
        
    });    
  };     

})(jQuery);
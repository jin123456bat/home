var Index = function () {

    return {

        //main function
        init: function () {
            Metronic.addResizeHandler(function () {
                jQuery('.vmaps').each(function () {
                    var map = jQuery(this);
                    map.width(map.parent().width());
                });
            });
        },

        initJQVMAP: function () {

            var showMap = function (name) {
                jQuery('.vmaps').hide();
                jQuery('#vmap_' + name).show();
            }

            var setMap = function (name) {
                var data = {
                    map: 'world_en',
                    backgroundColor: null,
                    borderColor: '#333333',
                    borderOpacity: 0.5,
                    borderWidth: 1,
                    color: '#c6c6c6',
                    enableZoom: true,
                    hoverColor: '#c9dfaf',
                    hoverOpacity: null,
                    values: sample_data,
                    normalizeFunction: 'linear',
                    scaleColors: ['#b6da93', '#909cae'],
                    selectedColor: '#c9dfaf',
                    selectedRegion: null,
                    showTooltip: true,
                    onLabelShow: function (event, label, code) {

                    },
                    onRegionOver: function (event, code) {
                        if (code == 'ca') {
                            event.preventDefault();
                        }
                    },
                    onRegionClick: function (element, code, region) {
                        var message = 'You clicked "' + region + '" which has the code: ' + code.toUpperCase();
                        alert(message);
                    }
                };

                data.map = name + '_en';
                var map = jQuery('#vmap_' + name);
                if (!map) {
                    return;
                }
                map.width(map.parent().parent().width());
                map.show();
                map.vectorMap(data);
                map.hide();
            }

            setMap("world");
            setMap("usa");
            setMap("europe");
            setMap("russia");
            setMap("germany");
            showMap("world");

            jQuery('#regional_stat_world').click(function () {
                showMap("world");
            });

            jQuery('#regional_stat_usa').click(function () {
                showMap("usa");
            });

            jQuery('#regional_stat_europe').click(function () {
                showMap("europe");
            });
            jQuery('#regional_stat_russia').click(function () {
                showMap("russia");
            });
            jQuery('#regional_stat_germany').click(function () {
                showMap("germany");
            });

            $('#region_statistics_loading').hide();
            $('#region_statistics_content').show();
        },

        initCharts: function () {
            if (!jQuery.plot) {
                return;
            }

            function showChartTooltip(x, y, xValue, yValue) {
                $('<div id="tooltip" class="chart-tooltip">' + yValue + '<\/div>').css({
                    position: 'absolute',
                    display: 'none',
                    top: y - 40,
                    left: x - 40,
                    border: '0px solid #ccc',
                    padding: '2px 6px',
                    'background-color': '#fff'
                }).appendTo("body").fadeIn(200);
            }

            var data = [];
            var totalPoints = 250;

            // random data generator for plot charts

            function getRandomData() {
                if (data.length > 0) data = data.slice(1);
                // do a random walk
                while (data.length < totalPoints) {
                    var prev = data.length > 0 ? data[data.length - 1] : 50;
                    var y = prev + Math.random() * 10 - 5;
                    if (y < 0) y = 0;
                    if (y > 100) y = 100;
                    data.push(y);
                }
                // zip the generated y values with the x values
                var res = [];
                for (var i = 0; i < data.length; ++i) res.push([i, data[i]])
                return res;
            }

            function randValue() {
                return (Math.floor(Math.random() * (1 + 50 - 20))) + 10;
            }

            var visitors = [
                ['02/2013', 1500],
                ['03/2013', 2500],
                ['04/2013', 1700],
                ['05/2013', 800],
                ['06/2013', 1500],
                ['07/2013', 2350],
                ['08/2013', 1500],
                ['09/2013', 1300],
                ['10/2013', 4600]
            ];



            if ($('#site_statistics').size() != 0) {

                $('#site_statistics_loading').hide();
				
				$.ajax({
					url:'index.php?c=statistics&a=visitor',
					async:false,
					cache:false,
					contentType:"json",
					type:'get',
					success: function(response){
						visitors = response;
					}
				});
                
				$('#site_statistics_content').show();
				
                var plot_statistics = $.plot($("#site_statistics"),
                    [{
                        data: visitors,
                        lines: {
                            fill: 0.6,
                            lineWidth: 0
                        },
                        color: ['#f89f9f']
                    }, {
                        data: visitors,
                        points: {
                            show: true,
                            fill: true,
                            radius: 5,
                            fillColor: "#f89f9f",
                            lineWidth: 3
                        },
                        color: '#fff',
                        shadowSize: 0
                    }],
                    {
						xaxis: {
							tickLength: 0,
							tickDecimals: 0,
							mode: "categories",
							min: 0,
							font: {
								lineHeight: 14,
								style: "normal",
								variant: "small-caps",
								color: "#6F7B8A"
							}
						},
                        yaxis: {
                            ticks: 5,
                            tickDecimals: 0,
                            tickColor: "#eee",
                            font: {
                                lineHeight: 14,
                                style: "normal",
                                variant: "small-caps",
                                color: "#6F7B8A"
                            }
                        },
                        grid: {
                            hoverable: true,
                            clickable: true,
                            tickColor: "#eee",
                            borderColor: "#eee",
                            borderWidth: 1
                        }
                    });

                var previousPoint = null;
                $("#site_statistics").bind("plothover", function (event, pos, item) {
                    $("#x").text(pos.x.toFixed(2));
                    $("#y").text(pos.y.toFixed(2));
                    if (item) {
                        if (previousPoint != item.dataIndex) {
                            previousPoint = item.dataIndex;

                            $("#tooltip").remove();
                            var x = item.datapoint[0].toFixed(2),
                                y = item.datapoint[1].toFixed(2);

                            showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + ' visits');
                        }
                    } else {
                        $("#tooltip").remove();
                        previousPoint = null;
                    }
                });
            }


            if ($('#site_activities').size() != 0) {
                //site activities
                var previousPoint2 = null;
                
				var date = new Date();
				
				$('#site_activities_loading').hide();
				
				var changePlot = function(event){
					$('#revenue_year_selector').find('li').removeClass('active');
					$(event.target).parents('li').addClass('active');
					var year = $(event.target).html()||event;
					$.ajax({
						url:'index.php?c=statistics&a=revenue&year='+year,
						async:false,
						cache:true,
						contentType:"json",
						type:"get",
						success: function(response){
							$.plot(
								$("#site_activities"),
								[{
									data: response.table,
									lines: {
										fill: 0.2,
										lineWidth: 0,
									},
									color: ['#BAD9F5']
								}, {
									data: response.table,
									points: {
										show: true,
										fill: true,
										radius: 4,
										fillColor: "#9ACAE6",
										lineWidth: 2
									},
									color: '#9ACAE6',
									shadowSize: 1
								}, {
									data: response.table,
									lines: {
										show: true,
										fill: false,
										lineWidth: 3
									},
									color: '#9ACAE6',
									shadowSize: 0
								}],
								{
									xaxis: {
										tickLength: 0,
										tickDecimals: 0,
										mode: "categories",
										min: 0,
										font: {
											lineHeight: 18,
											style: "normal",
											variant: "small-caps",
											color: "#6F7B8A"
										}
									},
									yaxis: {
										ticks: 5,
										tickDecimals: 0,
										tickColor: "#eee",
										font: {
											lineHeight: 14,
											style: "normal",
											variant: "small-caps",
											color: "#6F7B8A"
										}
									},
									grid: {
										hoverable: true,
										clickable: true,
										tickColor: "#eee",
										borderColor: "#eee",
										borderWidth: 1
									}
								}
							);
							$('#revenue').html('$'+response.revenue);
							$('#tax').html('$'+response.tax);
							$('#shipment').html('$'+response.shipment);
							$('#order').html(response.order);
							//console.log(response);
						}
					});
				}
				
                $('#site_activities_content').show();
				changePlot(date.getFullYear());
				
				$.ajax({
					url:'index.php?c=statistics&a=revenue',
					async:false,
					cache:true,
					contentType:"json",
					type:'get',
					success: function(response){
						
						for(var i=0;i<response.length;i++)
						{
							var tpl = '<li><a href="javascript:;">'+response[i]+'</a></li>';
							if(date.getFullYear() == parseInt(response[i]))
							{
								tpl = $(tpl).addClass('active').on('click',changePlot);
							}
							else
							{
								tpl = $(tpl).on('click',changePlot);
							}
							$('#revenue_year_selector').append(tpl);
						}
					}
				});
				
				
			}
				
			$("#site_activities").bind("plothover", function (event, pos, item) {
				$("#x").text(pos.x.toFixed(2));
				$("#y").text(pos.y.toFixed(2));
				if (item) {
					if (previousPoint2 != item.dataIndex) {
						previousPoint2 = item.dataIndex;
						$("#tooltip").remove();
						var x = item.datapoint[0].toFixed(2),
							y = item.datapoint[1].toFixed(2);
						showChartTooltip(item.pageX, item.pageY, item.datapoint[0], item.datapoint[1] + '￥');
					}
				}
			});

			$('#site_activities').bind("mouseleave", function () {
				$("#tooltip").remove();
			});
            
        },

        initMiniCharts: function () {

            // IE8 Fix: function.bind polyfill
            if (Metronic.isIE8() && !Function.prototype.bind) {
                Function.prototype.bind = function (oThis) {
                    if (typeof this !== "function") {
                        // closest thing possible to the ECMAScript 5 internal IsCallable function
                        throw new TypeError("Function.prototype.bind - what is trying to be bound is not callable");
                    }

                    var aArgs = Array.prototype.slice.call(arguments, 1),
                        fToBind = this,
                        fNOP = function () {},
                        fBound = function () {
                            return fToBind.apply(this instanceof fNOP && oThis ? this : oThis,
                        aArgs.concat(Array.prototype.slice.call(arguments)));
                    };

                    fNOP.prototype = this.prototype;
                    fBound.prototype = new fNOP();

                    return fBound;
                };
            }
			
			
			 
			function loadMiniChart(url)
			{
				$.ajax({
					url:url,
					async:false,
					cache:true,
					type:"get",
					success: function(response){
						var ios = parseInt(response.ios);
						var android = parseInt(response.android);
						var wap = parseInt(response.wap);
						var web = parseInt(response.web);
						var weixin = parseInt(response.weixin);
						
						var total = ios+android+wap+web+weixin;
						
						$('.easy-pie-chart .android').attr('data-percent',android*100/total).find('span').html(android);
						$('.easy-pie-chart .ios').attr('data-percent',ios*100/total).find('span').html(ios);
						$('.easy-pie-chart .wap').attr('data-percent',(wap+weixin)*100/total).find('span').html(wap+weixin);
						
						//$('.easy-pie-chart .ios').attr('data-percent',(ios*100/total));
						
						$('.easy-pie-chart .number.ios').easyPieChart({
							animate: 1000,
							size: 75,
							lineWidth: 3,
							barColor: Metronic.getBrandColor('yellow')
						});
			
						$('.easy-pie-chart .number.android').easyPieChart({
							animate: 1000,
							size: 75,
							lineWidth: 3,
							barColor: Metronic.getBrandColor('green')
						});
			
						$('.easy-pie-chart .number.wap').easyPieChart({
							animate: 1000,
							size: 75,
							lineWidth: 3,
							barColor: Metronic.getBrandColor('red')
						});
						
					}
				});
			}
			
           

			loadMiniChart('index.php?c=statistics&a=client&type=order');
            $('.easy-pie-chart-reload').click(function () {
                loadMiniChart('index.php?c=statistics&a=client&type=order');
            });



            $("#sparkline_bar").sparkline([8, 9, 10, 11, 10, 10, 12, 10, 10, 11, 9, 12, 11, 10, 9, 11, 13, 13, 12], {
                type: 'bar',
                width: '100',
                barWidth: 5,
                height: '55',
                barColor: '#35aa47',
                negBarColor: '#e02222'
            });

            $("#sparkline_bar2").sparkline([9, 11, 12, 13, 12, 13, 10, 14, 13, 11, 11, 12, 11, 11, 10, 12, 11, 10], {
                type: 'bar',
                width: '100',
                barWidth: 5,
                height: '55',
                barColor: '#ffb848',
                negBarColor: '#e02222'
            });

            $("#sparkline_line").sparkline([9, 10, 9, 10, 10, 11, 12, 10, 10, 11, 11, 12, 11, 10, 12, 11, 10, 12], {
                type: 'line',
                width: '100',
                height: '55',
                lineColor: '#ffb848'
            });

        },

        initChat: function () {

            var cont = $('#chats');
            var list = $('.chats', cont);
            var form = $('.chat-form', cont);
            var input = $('input', form);
            var btn = $('.btn', form);

            var handleClick = function (e) {
                e.preventDefault();

                var text = input.val();
                if (text.length == 0) {
                    return;
                }

                var time = new Date();
                var time_str = (time.getHours() + ':' + time.getMinutes());
                var tpl = '';
                tpl += '<li class="out">';
                tpl += '<img class="avatar" alt="" src="' + Layout.getLayoutImgPath() + 'avatar1.jpg"/>';
                tpl += '<div class="message">';
                tpl += '<span class="arrow"></span>';
                tpl += '<a href="#" class="name">Bob Nilson</a>&nbsp;';
                tpl += '<span class="datetime">at ' + time_str + '</span>';
                tpl += '<span class="body">';
                tpl += text;
                tpl += '</span>';
                tpl += '</div>';
                tpl += '</li>';

                var msg = list.append(tpl);
                input.val("");

                var getLastPostPos = function () {
                    var height = 0;
                    cont.find("li.out, li.in").each(function () {
                        height = height + $(this).outerHeight();
                    });

                    return height;
                }

                cont.find('.scroller').slimScroll({
                    scrollTo: getLastPostPos()
                });
            }

            $('body').on('click', '.message .name', function (e) {
                e.preventDefault(); // prevent click event

                var name = $(this).text(); // get clicked user's full name
                input.val('@' + name + ':'); // set it into the input field
                Metronic.scrollTo(input); // scroll to input if needed
            });

            btn.click(handleClick);

            input.keypress(function (e) {
                if (e.which == 13) {
                    handleClick(e);
                    return false; //<---- Add this line
                }
            });
        },

        initDashboardDaterange: function () {

            $('#dashboard-report-range').daterangepicker({
                    opens: (Metronic.isRTL() ? 'right' : 'left'),
                    startDate: moment().subtract('days', 29),
                    endDate: moment(),
                    minDate: '01/01/2012',
                    maxDate: '12/31/2014',
                    dateLimit: {
                        days: 60
                    },
                    showDropdowns: false,
                    showWeekNumbers: true,
                    timePicker: false,
                    timePickerIncrement: 1,
                    timePicker12Hour: true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract('days', 1), moment().subtract('days', 1)],
                        'Last 7 Days': [moment().subtract('days', 6), moment()],
                        'Last 30 Days': [moment().subtract('days', 29), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract('month', 1).startOf('month'), moment().subtract('month', 1).endOf('month')]
                    },
                    buttonClasses: ['btn btn-sm'],
                    applyClass: ' blue',
                    cancelClass: 'default',
                    format: 'MM/DD/YYYY',
                    separator: ' to ',
                    locale: {
                        applyLabel: 'Apply',
                        fromLabel: 'From',
                        toLabel: 'To',
                        customRangeLabel: 'Custom Range',
                        daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                        monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                        firstDay: 1
                    }
                },
                function (start, end) {
                    $('#dashboard-report-range span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                }
            );


            $('#dashboard-report-range span').html(moment().subtract('days', 29).format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
            $('#dashboard-report-range').show();
        },

        initIntro: function () {

            // display marketing alert only once
            if (!$.cookie('intro_show')) {
                setTimeout(function () {
                    var unique_id = $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: '<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">Get Metronic Just For 25$</a>',
                        // (string | mandatory) the text inside the notification
                        text: 'Metronic is World\'s #1 Selling Bootstrap 3 Admin Theme Ever! 18000+ Users Can\'t be Wrong.',
                        // (string | optional) the image to display on the left
                        image: '../../assets/admin/layout/img/avatar1.jpg',
                        // (bool | optional) if you want it to fade out on its own or just sit there
                        sticky: true,
                        // (int | optional) the time you want it to be alive for before fading out
                        time: '',
                        // (string | optional) the class name you want to apply to that specific message
                        class_name: 'my-sticky-class'
                    });

                    // You can have it return a unique id, this can be used to manually remove it later using
                    setTimeout(function () {
                        $.gritter.remove(unique_id, {
                            fade: true,
                            speed: 'slow'
                        });
                    }, 12000);
                }, 2000);

                setTimeout(function () {
                    var unique_id = $.gritter.add({
                        // (string | mandatory) the heading of the notification
                        title: '<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">Develop with Metronic!</a>',
                        // (string | mandatory) the text inside the notification
                        text: 'Metronic comes with 160+ templates, 70+ plugins and 500+ UI components. Also 3 Frontend Themes, Corporate Frontend, eCommerce Frontend and One Page Parallax Frontend are included. Buy 1 Get 4!',
                        // (string | optional) the image to display on the left
                        image: '../../assets/admin/layout/img/avatar1.jpg',
                        // (bool | optional) if you want it to fade out on its own or just sit there
                        sticky: true,
                        // (int | optional) the time you want it to be alive for before fading out
                        time: '',
                        // (string | optional) the class name you want to apply to that specific message
                        class_name: 'my-sticky-class'
                    });

                    // You can have it return a unique id, this can be used to manually remove it later using
                    setTimeout(function () {
                        $.gritter.remove(unique_id, {
                            fade: true,
                            speed: 'slow'
                        });
                    }, 13000);
                }, 8000);

                setTimeout(function () {

                    $('#styler').pulsate({
                        color: "#bb3319",
                        repeat: 10
                    });

                    $.extend($.gritter.options, {
                        position: 'top-left'
                    });

                    var unique_id = $.gritter.add({
                        position: 'top-left',
                        // (string | mandatory) the heading of the notification
                        title: '<a href="http://themeforest.net/item/metronic-responsive-admin-dashboard-template/4021469?ref=keenthemes" target="_blank">Customize Metronic!</a>',
                        // (string | mandatory) the text inside the notification
                        text: 'Metronic allows you to easily customize the theme with unlimited layout options and color schemes. Try Metronic Today!',
                        // (string | optional) the image to display on the left
                        image1: './assets/img/avatar1.png',
                        // (bool | optional) if you want it to fade out on its own or just sit there
                        sticky: true,
                        // (int | optional) the time you want it to be alive for before fading out
                        time: '',
                        // (string | optional) the class name you want to apply to that specific message
                        class_name: 'my-sticky-class'
                    });

                    $.extend($.gritter.options, {
                        position: 'top-right'
                    });

                    // You can have it return a unique id, this can be used to manually remove it later using
                    setTimeout(function () {
                        $.gritter.remove(unique_id, {
                            fade: true,
                            speed: 'slow'
                        });
                    }, 10000);

                }, 23000);

                $.cookie('intro_show', 1);
            }
        }

    };

}();
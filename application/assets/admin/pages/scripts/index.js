var Index = function () {

    return {
        //main function
        
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
			
			
			 
			function loadMiniChart(url,selector)
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
						
						$('.easy-pie-chart .android',selector).attr('data-percent',android*100/total).find('span').html(android);
						$('.easy-pie-chart .ios',selector).attr('data-percent',ios*100/total).find('span').html(ios);
						$('.easy-pie-chart .wap',selector).attr('data-percent',(wap+weixin)*100/total).find('span').html(wap+weixin);
						
						//$('.easy-pie-chart .ios').attr('data-percent',(ios*100/total));
						
						$('.easy-pie-chart .number.ios',selector).easyPieChart({
							animate: 1000,
							size: 75,
							lineWidth: 3,
							barColor: Metronic.getBrandColor('yellow')
						});
			
						$('.easy-pie-chart .number.android',selector).easyPieChart({
							animate: 1000,
							size: 75,
							lineWidth: 3,
							barColor: Metronic.getBrandColor('green')
						});
			
						$('.easy-pie-chart .number.wap',selector).easyPieChart({
							animate: 1000,
							size: 75,
							lineWidth: 3,
							barColor: Metronic.getBrandColor('red')
						});
						
					}
				});
			}
			
           

			loadMiniChart('index.php?c=statistics&a=client&type=order',$('#order-easy-pie-chart'));
			loadMiniChart('index.php?c=statistics&a=client&type=user',$('#user-easy-pie-chart'));
            /*$('.easy-pie-chart-reload').click(function () {
                loadMiniChart('index.php?c=statistics&a=client&type=order');
            });*/



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

        }

    };

}();
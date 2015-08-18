var EcommerceOrders = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });
    }
	
	var unixtotime = function(unixTime, isFull, timeZone) {
		if (typeof (timeZone) == 'number')
		{
			unixTime = parseInt(unixTime) + parseInt(timeZone) * 60 * 60;
		}
		var time = new Date(unixTime * 1000);
		var ymdhis = "";
		ymdhis += time.getUTCFullYear() + "-";
		ymdhis += (time.getUTCMonth()+1) + "-";
		ymdhis += time.getUTCDate();
		if (isFull === true)
		{
			ymdhis += " " + time.getUTCHours() + ":";
			ymdhis += time.getUTCMinutes() + ":";
			ymdhis += time.getUTCSeconds();
		}
		return ymdhis;
	}

    var handleOrders = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_orders"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
				Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: '网络连接失败,请刷新',
					closeInSeconds: 5,
                    container: $('#alert'),
                    place: 'prepend'
                });
                // execute some code on network or other general error  
            },
			
            loadingMessage: '载入中...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
                "pageLength": 10, // default record count per page
                "ajax": {
                    //"url": "demo/ecommerce_orders.php", // ajax source
					"url":"?c=order&a=ajaxorderlist"
                },
				"processing": true,
				
				"columnDefs":[{
					"targets":[0],
					"data":"id",
					"orderable":false,
					"render":function(data,type,full){
						return '<input type="checkbox" class="checkboxes" name="id[]" value='+data+'>';
					}
				},{
					"targets":[2],
					"data":"createtime",
					"render":function(data,type,full){
						return unixtotime(data,true,8);
					}
				},{
					"targets":[3],
					"data":"uid",
					"render":function(data,type,full){
						var telephone = '';
						$.ajax({
							async:false,
							method:"get",
							url:"?c=user&a=telephone",
							data:{id:data},
							success:function(response){
								telephone = $.parseJSON(response).body;
							}
						});
						return '<button class="btn btn-xs default-stripe popovers" data-html="true" data-container="body" data-trigger="hover" data-placement="right" data-content="收件人:'+full.consignee+'<br>收件人号码:'+full.consigneetel+'<br>收件地址:'+full.consigneeaddress+'" data-original-title="配送信息">'+telephone+'</button>';
					}
				},{
					"targets":9,
					"data":"status",
					"render":function(data,type,full){
						switch(data)
						{
							case '0':return '等待付款';break;
							case '1':return '支付完毕';break;
							case '2':return '支付失败';break;
							case '3':return '客户取消';break;
							default:return '未知状态';break;
						}
					}
				},{
					"targets":[11,12,13],
					visible:false
				}],
				"columns":[{
					"data":"id",
					"orderable":false
				},{
					"data":'orderno',
					"orderable":true
				},{
					"data":'createtime',
					'orderable':true
				},{
					"data":'uid',
					'orderable':true
				},{
					"data":'postmode',
					'orderable':true
				},{
					"data":'paytype',
					'orderable':true
				},{
					"data":"client",
					'searchable':"true",
					'orderable':true
				},{
					"data":'ordertotalamount',
					'orderable':true
				},{
					"data":'totalamount',
					'orderable':true
				},{
					"data":'status',
					'orderable':true
				},{
					"data":'id'
				},{
					"data":'consignee',
				},{
					"data":'consigneetel',
				},{
					"data":'consigneeaddress',
				}],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            }			
        });

        // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
            if (action.val() != "" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
            } else if (action.val() == "") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
					closeInSeconds: 5,
                    message: '请选择一个操作',
                    container: $('#alert'),
                    place: 'prepend'
                });
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
					closeInSeconds: 5,
                    message: '没有选择任何订单',
                    container: $('#alert'),
                    place: 'prepend'
                });
            }
        });

    }

    return {

        //main function to initiate the module
        init: function () {

            initPickers();
            handleOrders();
        }

    };

}();
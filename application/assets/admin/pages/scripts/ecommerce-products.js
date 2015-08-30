var EcommerceProducts = function () {

    var initPickers = function () {
        //init date pickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true,
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

    var handleProducts = function() {
        var grid = new Datatable();

        grid.init({
            src: $("#datatable_products"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
				 Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: '网络连接失败,请刷新',
					closeInSeconds: 5,
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
                // execute some code on network or other general error  
            },
            loadingMessage: '载入中...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
                "columns": [{
					"data":"id",
					"orderable": false
				}, {
					"data":"sku",
					"orderable": true
				}, {
					"data":"productname",
					"orderable": true
				}, {
					"data":"categoryname",
					"orderable": true
				}, {
					"data":"price",
					"orderable": true
				}, {
					"data":"stock",
					"orderable": true
				},{
					"data":"score",
					"orderable": true
				}, {
					"data":"time",
					"orderable": true
				}, {
					"data":"status",
					"orderable": true
				}, {
					"data":"id",
					"orderable": false
				},{
					"data":"activity",
				}],
				"lengthMenu": [
                    [10, 20, 50, 100, 150],
                    [10, 20, 50, 100, 150] // change per page values here 
                ],
				"columnDefs":[{
					"targets": [0],
					"data": "id",
					'orderable': false,
					"render":function(data,type,full){
						return '<input type="checkbox" name="id[]" value='+data+'>';
					}
				},{
					"targets":[7],
					"data":"time",
					"render":function(data,type,full){
						return unixtotime(data,true,8);
					}
				},{
					"targets":[8],
					"data":"status",
					"render":function(data,type,full){
						switch(data)
						{
							case "1":return "已上架";
							case "2":return "未上架";
							case "3":return "已删除";
							default:return "未知状态";
						}
					}
				},{
					"targets":[9],
					"data":"id",
					"render":function(data,type,full){
						//console.log(full);
						var content = '<a href="?c=product&a=edit&action=edit&id='+data+'" class="btn default btn-xs green-stripe">编辑</a>';
						content += '<a href="#sale-config" class="btn default btn-xs red-stripe" data-price="'+full.price+'" data-pid="'+data+'" data-pname="'+full.productname+'" data-toggle="modal">推送</a></li>';
						return content;
					}
				},{
					targets:10,
					visible:false
				}],
				"processing": true,
                "pageLength": 10, // default record count per page
                "ajax": {
                    //"url": "http://localhost/home/application/ecommerce_products.php", // ajax source
					'url':'?c=product&a=ajaxdatatable',
                },
                "order": [
                    [0, "asc"]
                ], // set first column as a default sort by asc
				'language':{
					'emptyTable': '没有数据',  
					'loadingRecords': '加载中...',  
					'processing': '查询中...',  
					'search': '检索:',  
					'lengthMenu': '每页 _MENU_ 件',  
					'zeroRecords': '没有数据',  
					'paginate': {  
						'first':      '第一页',  
						'last':       '最后一页',  
						'next':       '下一页',  
						'previous':   '上一页'  
					},  
					'info': '第 _PAGE_ 页 / 总 _PAGES_ 页',  
					'infoEmpty': '没有数据',  
					'infoFiltered': '(过滤总件数 _MAX_ 条)'  
				}
            }
        });

         // handle group actionsubmit button click
        grid.getTableWrapper().on('click', '.table-group-action-submit', function (e) {
            e.preventDefault();
            var action = $(".table-group-action-input", grid.getTableWrapper());
			if (action.val() != "0" && grid.getSelectedRowsCount() > 0) {
                grid.setAjaxParam("customActionType", "group_action");
                grid.setAjaxParam("customActionName", action.val());
                grid.setAjaxParam("id", grid.getSelectedRows());
                
				grid.getDataTable().ajax.reload();
                grid.clearAjaxParams();
				
            } else if (action.val() == "0") {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: '请选择操作',
                    container: grid.getTableWrapper(),
                    place: 'prepend'
                });
				return false;
            } else if (grid.getSelectedRowsCount() === 0) {
                Metronic.alert({
                    type: 'danger',
                    icon: 'warning',
                    message: '请选择商品',
                    container: grid.getTableWrapper(),
                    place: 'prepend',
					closeInSeconds: 5,
                });
				return false;
            }
        });
    }

    return {

        //main function to initiate the module
        init: function () {

            handleProducts();
            initPickers();
            
        }

    };

}();
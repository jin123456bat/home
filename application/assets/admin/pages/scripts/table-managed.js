var TableManaged = function () {

    var initTable1 = function () {

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
	
        var table = $('#sample_1');

        // begin first table
        table.dataTable({
            "columns": [{
				"data":"id",
				"bSortable": false,
                "orderable": false
            }, {
				"data":"username",
				"orderable":true
			}, {
				"data":"gravatar",
				"orderable":false
			}, {
				"data":"telephone",
                "orderable": false
            }, {
				"data":"email",
                "orderable": false
            }, {
				"data":"regtime",
                "orderable": true
            }, {
				"data":"logtime",
                "orderable": true
            }, {
				"data":"money",
                "orderable": true
            }, {
				"data":"score",
				"orderable":true
			}, {
				"data":"cost",
				"orderable":true
			}, {
				"data":"ordernum",
				"orderable": true
			}, {
				"data":"oid",
				"orderable":true
			}, {
				"data":"close",
				"orderable": false
			}],
			"paging":true,
			"processing": true,
			"serverSide": true,
			"ajax" :{"url":"?c=user&a=userlistajax","type":"post"},
            "lengthMenu": [
                [10, 20, 30, -1],
                [10, 20, 30, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,
            "pagingType": "bootstrap_full_number",
            "language": {
				"search":"搜索",
                "lengthMenu": "  _MENU_ 记录",
                "paginate": {
                    "previous":"上一页",
                    "next": "下一页",
                    "last": "最后一页",
                    "first": "第一页"
                }
            },
            "columnDefs": [{
				"targets": [0],
				"data": "id",
				"orderable":false,
				"render": function(data, type, full) {
					return "<div class=checker><span><input type=checkbox class=checkboxes value="+data+"></span></div>";
				}
			}, {
				"targets":[11],
				"data":"oid",
				"render":function(data,type,full){
					$.ajaxSetup({async:false});
					var telephone = '无推荐人';
					if(data != 0)
					{
						$.get('?c=user&a=telephone',{id:data},function(data){
							data = $.parseJSON(data);
							telephone = data.body;
						});
					}
					return telephone;
				}
			}, {
				"targets":[12],
				"data":"close",
				"render":function(data,type,full){
					if(data == 0)
						toggle = 'off';
					else
						toggle = 'on';
					return '<div class="closeuser bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-small bootstrap-switch-animate bootstrap-switch-'+toggle+'"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-info">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF"></div></div>';
				}
			}, {
                "searchable": false,
                "targets": [0]
            }, {
				"targets":[2],
				"data":"gravatar",
				"render":function(data,type,full){
					return '<img src="'+data+'" width="50" height="50" onerror="this.src=\'./application/assets/gravatar.jpg\'"/>';
				}
			}, {
				"targets":[5],
				"data":"regtime",
				"render":function(data,type,full){
					return unixtotime(data,true,8);
				}
			}, {
				"targets":[6],
				data:"logtime",
				"render":function(data,type,full){
					return unixtotime(data,true,8);
				}
			}],
            "order": [
                [1, "asc"]
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
        });

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                    $(this).parents('tr').addClass("active");
					$(this).parent('span').addClass('checked');
                } else {
					$(this).parent('span').removeClass('checked');
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
			if($(this).parent('span').hasClass('checked'))
			{
				$(this).parent('span').removeClass('checked');
				$(this).attr('checked',false);
			}
			else
			{
				$(this).parent('span').addClass('checked');
				$(this).attr('checked',true);
			}
        });

    }

    

    return {

        //main function to initiate the module
        init: function () {
            if (!jQuery().dataTable) {
                return;
            }

            initTable1();

        }

    };

}();
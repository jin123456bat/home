var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#sample_1');

        // begin first table
        table.dataTable({
            "columns": [{
				"data":"id",
				"bSortable": false,
                "orderable": false
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
				"data":"ordernum",
				"orderable": true
			}, {
				"data":"id",
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
            "columnDefs": [{  // set default column settings
                'orderable': false,
                'targets': [0]
            }, {
				"targets": [0],
				"data": "id",
				"render": function(data, type, full) {
					return "<div class=checker><span><input type=checkbox class=checkboxes value="+data+"></span></div>";
				}
			}, {
				"targets":[7],
				"data":"id",
				"render":function(data,type,full){
					return '<div class="bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-small bootstrap-switch-animate bootstrap-switch-off"><div class="bootstrap-switch-container"><span class="bootstrap-switch-handle-on bootstrap-switch-info">ON</span><label class="bootstrap-switch-label">&nbsp;</label><span class="bootstrap-switch-handle-off bootstrap-switch-default">OFF</span><input type="checkbox" class="make-switch" data-size="small" data-on-color="info" data-on-text="ON" data-off-color="default" data-off-text="OFF"></div></div>';
				}
			}, {
                "searchable": false,
                "targets": [0]
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
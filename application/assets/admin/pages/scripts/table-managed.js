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
                [5, 10, 15, -1],
                [5, 10, 15, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 5,
            "pagingType": "bootstrap_full_number",
            "language": {
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
					return "<div class=checker><span><input type=checkbox class=checkboxes></span></div>";
				}
			}, {
                "searchable": false,
                "targets": [0]
            }],
            "order": [
                [1, "asc"]
            ] // set first column as a default sort by asc
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
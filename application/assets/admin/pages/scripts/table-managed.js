var TableManaged = function () {

    var initTable1 = function () {

        var table = $('#sample_1');

        // begin first table
        table.dataTable({
            "columns": [{
				"data":"id",
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
				"data":"dosomething",
				"orderable": false
			}],
			"processing": true,
			"serverSide": true,
			"ajax" : "load",
            "lengthMenu": [
                [10, 20, 30, -1],
                [10, 20, 30, "All"] // change per page values here
            ],
            // set the initial value
            "pageLength": 10,            
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
                } else {
                    $(this).attr("checked", false);
                    $(this).parents('tr').removeClass("active");
                }
            });
            jQuery.uniform.update(set);
        });

        table.on('change', 'tbody tr .checkboxes', function () {
            $(this).parents('tr').toggleClass("active");
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
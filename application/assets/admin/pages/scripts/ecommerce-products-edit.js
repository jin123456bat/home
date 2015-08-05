var EcommerceProductsEdit = function () {

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
	
    var handleImages = function() {

        // see http://www.plupload.com/
        var uploader = new plupload.Uploader({
            runtimes : 'html5,flash,silverlight,html4',
             
            browse_button : document.getElementById('tab_images_uploader_pickfiles'), // you can pass in id...
            container: document.getElementById('tab_images_uploader_container'), // ... or DOM Element itself
             
            //url : "http://localhost/home/application/assets/global/plugins/plupload/examples/upload.php",
            url : "?c=productimg&a=upload",
			
            filters : {
                max_file_size : '10mb',
                mime_types: [
                    {title : "Image files", extensions : "jpg,gif,png,jpeg,bmp"}
                ]
            },
			headers:{id:$('input[name=id]').val()},
         
            // Flash settings
            flash_swf_url : 'http://localhost/home/application/assets/global/plugins/plupload/js/Moxie.swf',
     
            // Silverlight settings
            silverlight_xap_url : 'http://localhost/home/application/assets/global/plugins/plupload/js/Moxie.xap',             
         
            init: {
                PostInit: function() {
                    $('#tab_images_uploader_filelist').html("");
         
                    $('#tab_images_uploader_uploadfiles').click(function() {
                        uploader.start();
                        return false;
                    });

                    $('#tab_images_uploader_filelist').on('click', '.added-files .remove', function(){
                        uploader.removeFile($(this).parent('.added-files').attr("id"));    
                        $(this).parent('.added-files').remove();
                    });
                },
         
                FilesAdded: function(up, files) {
                    plupload.each(files, function(file) {
                        $('#tab_images_uploader_filelist').append('<div class="alert alert-warning added-files" id="uploaded_file_' + file.id + '">' + file.name + '(' + plupload.formatSize(file.size) + ') <span class="status label label-info"></span>&nbsp;<a href="javascript:;" style="margin-top:-5px" class="remove pull-right btn btn-sm red"><i class="fa fa-times"></i> 删除</a></div>');
                    });
                },
         
                UploadProgress: function(up, file) {
                    $('#uploaded_file_' + file.id + ' > .status').html(file.percent + '%');
                },

                FileUploaded: function(up, file, response) {
                    var response = $.parseJSON(response.response);

                    if (response.code == 1) {
                        var id = response.body[0]; // uploaded file's unique name. Here you can collect uploaded file names and submit an jax request to your server side script to process the uploaded files and update the images tabke

                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-success").html('<i class="fa fa-check"></i> 上传完毕'); // set successfull upload
						var tpl = '<tr data-id="'+response.body[0]+'"><td><a href="'+response.body[4]+'" class="fancybox-button" data-rel="fancybox-button"><img class="img-responsive" src="'+response.body[4]+'" alt=""></a></td><td><input type="text" class="form-control" name="product[images][3][label]" value="'+response.body[2]+'"></td><td><input type="text" class="form-control" name="product[images][3][sort_order]" value="'+response.body[3]+'"></td><td><a href="javascript:;" class="btn default btn-sm"><i class="fa fa-times"></i> 删除 </a></td></tr>';
						$('#preview').append(tpl);
						
						$('#form').append('<input type="hidden" name="picid" value="'+response.body[0]+'"/>');
						
                    } else {
                        $('#uploaded_file_' + file.id + ' > .status').removeClass("label-info").addClass("label-danger").html('<i class="fa fa-warning"></i> 上传失败'); // set failed upload
                        Metronic.alert({type: 'danger', message: '一个或多个文件上传失败，请重新上传.', closeInSeconds: 5, icon: 'warning'});
                    }
                },
         
                Error: function(up, err) {
                    Metronic.alert({type: 'danger', message: err.message, closeInSeconds: 5, icon: 'warning'});
                }
            }
        });

        uploader.init();

    }

    var handleReviews = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_reviews"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
            loadingMessage: '载入中...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
				columns:[{
					data:'id',
				},{
					data:'time',
				},{
					data:'uid',
				},{
					data:'content',
				},{
					data:'score',
				},{
					data:'id',
				}],
                "pageLength": 10, // default record count per page
                "ajax": {
                    //"url": "demo/ecommerce_product_reviews.php", // ajax source
					url: "?c=comment&a=ajaxcomment&pid="+$('input[name=id]').val(),
                },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': true,
                    'targets': [0]
                },{
					'orderable':true,
					'targets':[1],
					'render':function(data,type,full){
						return unixtotime(data);
					}
				},{
					'orderable':true,
					'targets':[2],
					'render':function(data,type,full){
						$.ajaxSetup({async:false});
						var res = '';
						$.get('?c=user&a=telephone',{id:data},function(response){
							response = $.parseJSON(response);
							if(response.code == 1)
							{
								res = response.body;
							}
						});
						return res;
					}
				}],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            }
        });
    }

    var handleHistory = function () {

        var grid = new Datatable();

        grid.init({
            src: $("#datatable_history"),
            onSuccess: function (grid) {
                // execute some code after table records loaded
            },
            onError: function (grid) {
                // execute some code on network or other general error  
            },
			
            loadingMessage: '载入中...',
            dataTable: { // here you can define a typical datatable settings from http://datatables.net/usage/options 
                "lengthMenu": [
                    [10, 20, 50, 100, 150, -1],
                    [10, 20, 50, 100, 150, "All"] // change per page values here
                ],
				columns:[{
					data:'swift'
				},{
					data:'createtime'
				},{
					data:'uid'
				},{
					data:'status'
				},{
					data:'`orderlist`.id'
				}],
                "pageLength": 10, // default record count per page
                "ajax": {
                    //"url": "demo/ecommerce_product_history.php", // ajax source
					url:"?c=order&a=product&pid="+$('input[name=id]').val()
                },
                "columnDefs": [{ // define columns sorting options(by default all columns are sortable extept the first checkbox column)
                    'orderable': true,
                    'targets': [0]
                }],
                "order": [
                    [0, "asc"]
                ] // set first column as a default sort by asc
            }
        });
    } 

    var initComponents = function () {
        //init datepickers
        $('.date-picker').datepicker({
            rtl: Metronic.isRTL(),
            autoclose: true
        });

        //init datetimepickers
        $(".datetime-picker").datetimepicker({
            isRTL: Metronic.isRTL(),
            autoclose: true,
            todayBtn: true,
            pickerPosition: (Metronic.isRTL() ? "bottom-right" : "bottom-left"),
            minuteStep: 10
        });

        //init maxlength handler
        $('.maxlength-handler').maxlength({
            limitReachedClass: "label label-danger",
            alwaysShow: true,
            threshold: 5
        });
    }

    return {

        //main function to initiate the module
        init: function () {
            initComponents();

            handleImages();
            handleReviews();
            handleHistory();
        }

    };

}();
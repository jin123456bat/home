var EcommerceIndex = function () {
	var draw = 1;
   
    return {

        //main function
        init: function () {
			$.ajaxSetup({cache:false});
			$.each($('.banner'),function(index,value){
				if($(value).hasClass('active'))
				{
					var bid = $(value).attr('data-id');
					columns = [];
					columns.push({data:'*'});
					$.post('?c=product&a=ajaxdatatable',{draw:draw,columns:columns,action:'filter',product_bid:bid},function(data){
						data = $.parseJSON(data);
						if(data.draw == draw)
						{
							$('#container').empty();
							for(var i=0;i<data.data.length;i++)
							{
								var tpl = '<tr><td>'+data.data[i].name+'</td><td>'+data.data[i].sku+'</td><td>'+data.data[i].price+'</td><td>'+data.data[i].stock+'</td><td><a href="?c=product&a=edit&action=edit&id='+data.data[i].id+'" class="btn default btn-xs green-stripe">编辑 </a></td></tr>';
								$('#container').append(tpl);
							}
						}
						draw++;
					});
				}
			});
			
            $('.banner').live('click',function(){
				var bid = $(this).attr('data-id');
				$('#deleteBtn').data('id',bid);
				$('#modifyBtn').data('id',bid);
				columns = [];
				columns.push({data:'*'});
				$.post('?c=product&a=ajaxdatatable',{draw:draw,columns:columns,action:'filter',product_bid:bid},function(data){
					data = $.parseJSON(data);
					if(data.draw == draw)
					{
						$('#container').empty();
						for(var i=0;i<data.data.length;i++)
						{
							var tpl = '<tr><td>'+data.data[i].name+'</td><td>'+data.data[i].sku+'</td><td>'+data.data[i].price+'</td><td>'+data.data[i].stock+'</td><td><a href="?c=product&a=edit&action=edit&id='+data.data[i].id+'" class="btn default btn-xs green-stripe">编辑 </a></td></tr>';
							$('#container').append(tpl);
						}
					}
					draw++;
				});
			});
        }

    };

}();
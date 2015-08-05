// JavaScript Document
var collection = function(){
	var table;
	
	return {
		init:function(){
			var container = $('#collection_container');
			table = $('<table class="table table-hover"><thead><th>属性</th><th>价格</th><th>库存</th><th>编码</th></thead><tbody></tbody></table>');
			container.append(table);
		},
		createPrototype:function(prototype,id){
			if(table.find('tbody').html() == '')
			{
				for(var i=0;i<prototype.length;i++)
				{
					var tpl = '<tr><td>'+prototype[i]+'</td><td><input name="price" class="serverside" data-id="'+id+':'+i+'" type="text"></td><td><input class="serverside" name="stock" data-id="'+id+':'+i+'" type="text"></td><td><input name="sku" class="serverside" data-id="'+id+':'+i+'" type="text"></td></tr>';
					table.find('tbody').append(tpl);
				}
			}
			else
			{
				tr = table.find('tbody').find('tr').remove();
				table.find('thead').find('tr').prepend('<th></th>');
				num = tr.length;
				for(var i=0;i<prototype.length;i++)
				{
					th = tr.clone();
					$.each(th.find('input'),function(index,value){
						$(value).attr('data-id',$(value).attr('data-id')+','+id+':'+i);
					});
					$(th[0]).prepend('<td rowspan="'+num+'">'+prototype[i]+'</td>');
					table.find('tbody').append(th);
				}
			}
			
		},
		save:function(){
			var input = $('input.serverside');
			var pid = $('input[name=id]').val();
			var data = [];
			$.each(input,function(index,value){
				val = $(value).val();
				type = $(value).attr('name');
				did = $(value).attr('data-id');
				data.push({did:did,type:type,value:val});
			});
			
			$.post('?c=collection&a=updatevalue',{pid:pid,data:JSON.stringify(data)},function(data){
			});
		}
	};
}();
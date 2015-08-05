// JavaScript Document
var ProductEditPage = function(){
	return{
		init:function(){
			
			//$.ajaxSetup({async:false});
			var prototype = [];
			
			$('button[name=back]').on('click',function(){
				window.location = '?c=product&a=index';
			});
			
			$('#form').on('submit',function(e){
				var name = $('input[name=name]',$(this)).val(),
					id = $('input[name=id]').val(),
					category = $('select[name=category]',$(this)).val(),
					starttime = $('input[name=starttime]').val(),
					endtime = $('input[name=endtime]').val(),
					price = $('input[name=price]').val(),
					stock = $('input[name=stock]').val(),
					short_description = $('textarea[name=short_description]').val(),
					description = $('textarea[name=description]').val(),
					origin = $('input[name=origin]').val(),
					label = $('input[name=label]').val(),
					status = $('select[name=status]').val(),
					orderby = $('input[name=orderby]').val(),
					meta_title = $('input[name=meta_title]').val(),
					meta_keywords = $('textarea[name=meta_keywords]').val(),
					meta_description = $('textarea[name=meta_description]').val();
					
				if(name.length == 0)
				{
					Metronic.alert({
						type: 'danger',
						icon: 'warning',
						message: '起码也要写个名字吧',
						container: $('#alert'),
						place: 'prepend'
					});
					return false;
				}
				var picid = [];
				var input = $('input[name=picid]');
				$.each(input,function(index,value){
					picid.push($(valule).val());
				});				
				picid = JSON.stringify(picid);
				
				var prototype_id = [];
				var input = $('input[name=prototype_id]');
				$.each(input,function(index,value){
					prototype_id.push($(value).val());
				});
				prototype_id = JSON.stringify(prototype_id);
				$.post('?c=product&a=save',{prototype_id:prototype_id,label:label,picid:picid,id:id,name:name,category:category,starttime:starttime,endtime:endtime,price:price,stock:stock,origin:origin,short_description:short_description,description:description,status:status,orderby:orderby,meta_title:meta_title,meta_keywords:meta_keywords,meta_description:meta_description},function(data){
					data = $.parseJSON(data);
					if(data.code == 1)
					{
						if(id == 0)
						{
							$('input[name=id]').val(data.id);
						}
						collection.save();
						Metronic.alert({
							type: 'success',
							icon: 'success',
							message: '保存成功了',
							closeInSeconds: 5,
							container: $('#alert'),
							place: 'prepend'
						});
						return false;
					}
				});
				return false;
			});
			
			var pid = $('input[name=id]').val();
			$.get('?c=productimg&a=getproductimg',{pid:pid},function(data){
				data = $.parseJSON(data);
				if(data.code == 1)
				{
					$.each(data.body,function(index,value){
						var tpl = '<tr data-id="'+value.id+'"><td><a href="'+value.base_path+'" class="fancybox-button" data-rel="fancybox-button"><img class="img-responsive" src="'+value.base_path+'" alt=""></a></td><td><input type="text" class="form-control" name="product[images][3][label]" value="'+value.title+'"></td><td><input type="text" class="form-control" name="product[images][3][sort_order]" value="'+value.orderby+'"></td><td><a href="javascript:;" class="btn default btn-sm"><i class="fa fa-times"></i> 删除 </a></td></tr>';
						$('#preview').append(tpl);
					});
				}
			});
			$('button[name=prototype_add]').on('click',function(){
				var name = $.trim($('input[name=prototype_name]').val());
				var type = $('select[name=prototype_type]').val();
				if(type == 'text')
				{
					var value = $.trim($('#prototype_text').find('input').val());
				}
				else
				{
					var value = $.trim($('#prototype_radio').find('input').val());
				}
				if(name.length ==0 || value.length == 0)
				{
					alert('属性名或属性值不得为空');
					return false;
				}
				var prototypeobj = {name:name,type:type,value:value};
				prototype.push(prototypeobj);
				$.post('?c=prototype&a=create',{id:$('input[name=id]').val(),prototype:JSON.stringify(prototypeobj)},function(data){
					data = $.parseJSON(data);
					if(data.code ==1)
					{
						if(type == 'text')
						{
							type = '固定值';
							content = '<td>'+value+'</td>';
						}
						else
						{
							type = '可选值';
							value = value.split(',');
							content = '<td>';
							for(var i=0;i<value.length;i++)
							{
								content += '<button class="btn btn-xs btn-circle disabled">'+value[i]+'</button>';
							}
							content += '</td>';
							collection.createPrototype(value,data.body);
						}
						var tpl = '<tr><td>'+name+'</td><td>'+type+'</td>'+content+'<td><button data-id="'+data.body+'" class="btn btn-xs btn-circle prototype_remove">删除</button></td></tr>';
						$('#prototype_container').append(tpl);
						$('#form').append('<input type="hidden" name="prototype_id" value="'+data.body+'"/>');
					}
				});
				return false;
			});
			$.get('?c=prototype&a=product',{pid:$('input[name=id]').val()},function(data){
				data = $.parseJSON(data);
				if(data.code == 1)
				{
					for(var i=0;i<data.body.length;i++)
					{
						if(data.body[i].type=='text')
						{
							type = '固定值';
							content = '<td>'+data.body[i].value+'</td>';
						}
						else
						{
							type='可选值';
							content = '<td>';
							for(var j=0;j<data.body[i].value.length;j++)
							{
								content += '<button class="btn btn-xs btn-circle disabled">'+data.body[i].value[j]+'</button>';
							}
							content += '</td>';
							collection.createPrototype(data.body[i].value,data.body[i].id);
						}
						var tpl = '<tr><td>'+data.body[i].name+'</td><td>'+type+'</td>'+content+'<td><button data-id="'+data.body[i].id+'" class="btn btn-xs btn-circle prototype_remove">删除</button></td></tr>';
						$('#prototype_container').append(tpl);
						$('#form').append('<input type="hidden" name="prototype_id" value="'+data.body[i].id+'"/>');
					}
					//获取关系映射					
					$.each($('input.serverside'),function(index,value){
						var content = $(value).attr('data-id');
						var id = $('input[name=id]').val();
						$.get('?c=collection&a=find',{pid:id,content:content},function(data){
							data = $.parseJSON(data);
							if(data.code ==1)
							{
								//alert($('input[data-id="'+content+'"]'));
								if(data.body != null)
								{
									
									$('input[name=price][data-id="'+content+'"]').val(data.body.price);
									$('input[name=stock][data-id="'+content+'"]').val(data.body.stock);
									$('input[name=sku][data-id="'+content+'"]').val(data.body.sku);
								}
							}
						});
					});
					
				}
			});
			
			$('button.prototype_remove').live('click',function(){
				var ths = this;
				var id = $(this).attr('data-id');
				$.post('?c=prototype&a=remove',{id:id},function(data){
					data = $.parseJSON(data);
					if(data.code == 1)
					{
						$(ths).parents('tr').remove();
					}
				});
			});
			
			$('select[name=prototype_type]').on('change',function(){
				if($(this).val() == 'text')
				{
					$('#prototype_text').show();
					$('#prototype_radio').hide();
				}
				else
				{
					$('#prototype_text').hide();
					$('#prototype_radio').show();
				}
			});
			
			$('#prototype_radio').find('input').tagsInput({
				width: 'auto',
				interactive:true,
				defaultText:"添加属性值"
			});
			
			
		}
		
		
	}
}();

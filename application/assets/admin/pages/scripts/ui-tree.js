var UITree = function () {


     var ajaxTreeSample = function() {
        var tree = $("#tree_4").jstree({
            "core" : {
                "themes" : {
                    "responsive": true
                }, 
                // so that create works
                "check_callback" : true,
                'data' : {
                    //'url' :  'http://localhost/home/application/jstree_ajax_data.php',
					'url': '?c=category&a=ajaxtree',
                    'data' : function (node) {
                      return { 'parent' : node.id };
                    }
                }
            },
            "types" : {
                "default" : {
                	"icon" : "fa fa-file icon-state-warning icon-lg",
					//"icon" : "http://localhost/home/application/assets/gravatar.jpg"
					
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                },
				"folder":{
					"icon" : "fa fa-folder icon-state-warning icon-lg"
				}
				
            },
            "plugins" :["themes","dnd", "types","contextmenu" ],
			"contextmenu":{
			
			}
        }).bind('create_node.jstree',function(e,data){
			//console.log(data);
			//var obj = $('#'+data.node.id);
			var parent = data.parent;
			var name = data.node.text;
			$.post('?c=category&a=add',{name:name,parent:parent},function(data){
				data = JSON.parse(data);
				if(data.code == 1)
				{
					$('#tree_4').jstree('refresh');
				}
				else
				{
					alert(data.result);
				}
			});
		}).bind('rename_node.jstree',function(e,data){
			var id = data.node.id;
			var name = data.text;
			$.post('?c=category&a=rename',{id:id,name:name},function(data){
				data = JSON.parse(data);
				if(data.code == 1)
				{
					$('#tree_4').jstree('refresh');
				}
			});
		}).bind('delete_node.jstree',function(e,data){
			var id = data.node.id;
			$.post('?c=category&a=del',{id:id},function(data){
				data = JSON.parse(data);
				if(data.code !=1)
				{
					alert(data.result);
				}
				$('#tree_4').jstree('refresh');
			});
		}).bind('move_node.jstree',function(e,data){
			var id = data.node.id;
			var parent = data.parent;
			$.post('?c=category&a=move',{id:id,parent:parent},function(data){
				$('#tree_4').jstree('refresh');
			});
		}).bind('paste.jstree',function(e,data){
			var array = [];
			var parent = data.parent;
			for(var i=0;i<data.node.length;i++)
			{
				array.push(data.node[i].id);
			}
			array = JSON.stringify(array);
			$.post('?c=category&a=paste',{id:array,mode:data.mode,parent:parent},function(){
				$('#tree_4').jstree('refresh');
			});
		});

    }


    return {
        //main function to initiate the module
        init: function () {
            ajaxTreeSample();
        }

    };

}();
var UITree = function () {


     var ajaxTreeSample = function() {

        $("#tree_4").jstree({
            "core" : {
                "themes" : {
                    "responsive": false
                }, 
                // so that create works
                "check_callback" : true,
                'data' : {
                    //'url' :  '?c=category&a=ajaxtree',
					'url': '?c=category&a=ajaxtree',
                    'data' : function (node) {
                      return { 'parent' : node.id };
                    }
                }
            },
            "types" : {
                "default" : {
                    "icon" : "fa fa-folder icon-state-warning icon-lg"
                },
                "file" : {
                    "icon" : "fa fa-file icon-state-warning icon-lg"
                }
            },
            "state" : { "key" : "demo3" },
            "plugins" : [ "contextmenu","dnd", "state", "types" ]
        });
    
    }


    return {
        //main function to initiate the module
        init: function () {
            ajaxTreeSample();
        }

    };

}();
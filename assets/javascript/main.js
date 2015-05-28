requirejs.config({
    baseUrl: '/assets/javascript',
    paths: {        
        "jquery": 'lib/jquery-2.1.4.min',
        "datatables": 'jquery.dataTables.min'
    },
	shim: {
	    "dataTables": {
	        "deps": ['jquery']
	    }
    }	    
});
require(["jquery", "datatables"], function() {});

//Main application JS
requirejs(["application"], function() {});

requirejs(["bootstrap.min"], function(){});
requirejs(["branchlist"], function() {});
requirejs(["jquery.ui.shake"], function() {});
requirejs(["scorecard"], function() {});
requirejs(["users"], function() {});

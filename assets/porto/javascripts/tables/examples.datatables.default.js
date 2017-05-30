/*
Name: 			Tables / Advanced - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.5.1
*/

(function($) {

	'use strict';

	var datatableInit = function() {

		//$('#datatable-default').dataTable();
		
/*		$('#datatable-default').dataTable({
			'scrollX': true
		});
*/

        $('#datatable-default')
            .on('init.dt', function () {
               
                var $t = $(this),
                    w = $t.width();
               
                $t.width(w + 'px');
            })
            .dataTable({
                'scrollX': true,
                'autoWidth': false
            });


	};

	$(function() {
		datatableInit();
	});

}).apply(this, [jQuery]);
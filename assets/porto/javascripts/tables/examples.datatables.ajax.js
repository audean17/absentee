/*
Name: 			Tables / Ajax - Examples
Written by: 	Okler Themes - (http://www.okler.net)
Theme Version: 	1.5.1
*/

(function($) {

	'use strict';

	var datatableInit = function() {

		var $table = $('#datatable-ajax');
		$table.dataTable({
			bProcessing: true,
			sAjaxSource: $table.data('url')
		});

	};

	$(function() {
		datatableInit();
	});

	var datatableInit2 = function() {

		var $table = $('#datatable-ajax2');
		$table.dataTable({
			bProcessing: true,
			sAjaxSource: $table.data('url')
		});

	};

	$(function() {
		datatableInit2();
	});


}).apply(this, [jQuery]);
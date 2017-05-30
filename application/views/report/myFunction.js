function reverseContentDisplay(d) {
	if(d.length < 1) { return; }
	if(document.getElementById(d).style.display == "none") { document.getElementById(d).style.display = "block"; }
	else { document.getElementById(d).style.display = "none"; }
}

function showContent(d) {
	if(d.length < 1) { return; }
	document.getElementById(d).style.display = "block";
}

function hideContent(d) {
	if(d.length < 1) { return; }
	document.getElementById(d).style.display = "none";
}


function pageSubmit(actionValue) {
	document.myPage.action.value=actionValue;
	document.myPage.submit ();
}

function processConfirm(confirm_string,actionValue) {
	if(confirm(confirm_string)) {
		pageSubmit(actionValue);
	}
}

function subPageSubmit(actionValue, actionSubPage) {
	document.myPage.action.value=actionValue;
	document.myPage.actionSubPage.value=actionSubPage;
	document.myPage.submit ();
}

function openArtikel(url) {
	windowprops = "top=0,left=0,resizable=yes,dependent=true,menubar=false,scrollbars=yes";
	
	myForm=window.open(url, "viewArtikel", windowprops);
	myForm.focus();
}

function goto_page(url) {
	location.href = url;
}


function handleEnter (field, event) {
	var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;

	if (keyCode == 13) {
		var i;
		for (i = 0; i < field.form.elements.length; i++)
			if (field == field.form.elements[i])
			break;
			i = (i + 1) % field.form.elements.length;
			field.form.elements[i].focus();
			return false;
		}
	else
		return true;
}


function openPopUpForm(url,pageWidth,pageHeight) {
	LeftPosition = (screen.width) ? (screen.width-pageWidth)/2 : 0;
	TopPosition = (screen.height) ? (screen.height-pageHeight)/2 : 0;

	myForm=window.open(url,"inputMaster","dependent=1,menubar=false,scrollbars=true,width="+pageWidth+",height="+pageHeight+",left="+LeftPosition+",top="+TopPosition);
	myForm.focus();
}

function openBrowser(url) {
	windowprops = "top=0,left=0,resizable=yes,dependent=true,menubar=false,scrollbars=yes"
	+ ",width=" + screen.width + ",height=" + screen.height;
	
	myForm=window.open(url, "pgBrowser", windowprops);
	myForm.focus();
}

//PUBLIC FUNCTION FOR FORM
function pageFocus() {
	actionValue=document.myPage.action.value;
	
	if (actionValue=="refresh") {
		//do nothing
	} else {
		window.focus();
		setFocus();	
	}
	
	document.myPage.action.value="";
}

function setFocus () {
  	var i;
  	var ii;
	var ifound;
	
	objname=document.myPage.objFocused.value;
  	for (i = 0; i < document.forms.length; i++) {
  		for (ii = 0; ii < document.forms[i].elements.length; ii++) {
  			if (objname==document.forms[i].elements[ii].name) {
				document.forms[i].elements[ii].focus();
				ifound=1;
				break;
			}			
  		}
  		
  		if (ifound==1) { break; }
  	}
}

	function openContactUs(url,pageWidth,pageHeight) {
		LeftPosition = (screen.width) ? (screen.width-pageWidth)/2 : 0;
		TopPosition = (screen.height) ? (screen.height-pageHeight)/2 : 0;
	
		myForm=window.open(url,"ContactUs","dependent=1,menubar=false,scrollbars=true,width="+pageWidth+",height="+pageHeight+",left="+LeftPosition+",top="+TopPosition);
		myForm.focus();
	}


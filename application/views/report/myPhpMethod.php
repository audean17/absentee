<?php
	function stringEncrypt($myString) {
		return base64_encode($myString);
	}
	
	function stringDecrypt($myString) {
		return base64_decode($myString);
	}

	function getSessionValue($sessionGroup,$sessionField) {
		return base64_decode($_SESSION[$sessionGroup][$sessionField]);
	}
	
	function setSessionValue($sessionGroup,$sessionField,$value) {
		$_SESSION[$sessionGroup][$sessionField]=base64_encode($value);
	}

	function removeSession($sessionGroup) {
		unset($_SESSION[$sessionGroup]);
	}
	
	function raiseError($errPage="../../pages/public/errorPage.php",$errMessage="&nbsp;",$errWhen="&nbsp;",$errQueryString="",$info_type="") {
		global $pg;
		include_once ($errPage);
		exit();
	}
	
	function formatValue($value,$type,$decimalpoint=0) {
		$value=trim($value);

		switch ($type) {
		case "int":
		case "sumint":
			return number_format((double)$value,0,",",".");
			break;
		case "currency": case "sumcurrency": case "curr":
		case "cur":
		case "sumcur":
		case "sumcurcross":

			return number_format((double)$value,0,",",".");
			break;
		case "sumprec":
		case "prec":
			return number_format((double)$value,2,",",".");
			break;
		case "sumprec4":
			return number_format((double)$value,4,",",".");
			break;
		case "getMapCoordinateXY":
			return GetMapCoordinate((double)$value);
			break;
		case "date":
			if (strlen($value)<>0) {
				$valDate = str_replace("12:00AM", "", $value);
				if ($value == "Jan 1 1900 12:00AM"){
				  return "&nbsp;";
				} else {
					return $valDate;
				}
			} else {
				return "&nbsp;";
			}
			break;
		default:
			if (strlen($value)<>0) {
				return $value;
			} else {
				return "&nbsp;";
			}
		}
	}

?>
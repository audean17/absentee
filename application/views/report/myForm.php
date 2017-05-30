<?php
class myForm {
	var $page_title;
	var $page_title_right;
	var $pv;
	var $objFocused;

	var $pageLeftVerticalAlign="top";
	var $pageVerticalAlign="middle";
	var $pageRightVerticalAlign="top";
	var $tagHiddenField="";

	var $action;
	var $actionSubPage;

	var $right_width;
	var $right_valign;
	var $contents_valign;
	
	var $navigatorbar;
	var $navigatorlink;
	
	var $row_height="24";
		
	var $tag_menu;
	var $tag_contents;
	var $tag_right_contents;
	
	var $tag_header_stored;
	var $tag_detail_info;
	var $tag_detail_stored;
	var $tag_first_input;
	var $tag_detail_input;
	

	var $unfocusedpage;
	var $background_colour="#D5E0D5";

	function myForm($page_title, $file_name, $right_width=0, $right_valign="center", $contents_valign="center") {
		if (isset($_REQUEST['unfocusedpage'])) { $this->unfocusedpage=$_REQUEST['unfocusedpage']; }

		$this->pv['file_name']=$file_name;
		$this->page_title=$page_title;
		$this->right_width=$right_width;
		$this->right_valign=$right_valign;
		$this->contents_valign=$contents_valign;
    }
	
	function releaseResources() {
		unset($this->tagHiddenField);
		unset($this->pv['pageContents']);
		unset($this->pv['scriptToRun']);
	}

	function drawForm($action="#", $method="post", $name="myPage", $transactionID="") {
		$formCaption=$this->page_title;
		$formNavigator=$this->drawNavigator($transactionID,$formCaption);
		
		if (strlen($formNavigator)<> 0) {
			$formNavigator="<tr><td class=\"pageNav\">".$formNavigator."</td></tr>";
		}

		if (strlen($this->pv['pageTopWarning'])!=0) {
			$htmlTopWarning="<tr><td colspan=\"10\" style=\"height:10px;\">".$this->pv['pageTopWarning']."</td></tr>";
			$mainContentStyle="";
		} else {
			$mainContentStyle=" ";
		}
		
		$html="
		<form method=\"".$method."\" name=\"".$name."\">
		<div id=\"framecontentTop\">
			".$this->drawNavigator($transactionID,$formCaption)."
		</div>
		<div id=\"framecontentBottom\">
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"height:100%; width:100%;\">
			<tr><td class=\"pageFooterInfo\">Copyright : <strong>PUPERA @IT-Indonesia</strong> (For Internal Used Only)</td></tr>
			</table>
		</div>
			<div id=\"maincontent\" ".$mainContentStyle.">
				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"height:100%; width:100%;\">
				".$htmlTopWarning."
				<tr>
					".$this->drawLeftContents()."
					<td style=\"vertical-align:".$this->pageVerticalAlign.";\">
						<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" style=\"width:100%;\">
						<tr><td>
							<center>
							".$this->pv['pageContents']."							
							<input type='hidden' name='action' value='$this->action'>
							<input type='hidden' name='actionSubPage'>
							<input type='hidden' name='id'>
							<input type='hidden' name='idtoremove'>
							<input type='hidden' name='transid' value='$page_id'>
							<input type='hidden' name='objFocused' value='$this->objFocused'>
							".$this->tagHiddenField."
							</center>
						</td></tr>
						</table>
					</td>
					".$this->drawRightContents()."
				</tr>
				</table>
			</div>
		</form>";
		
		$html.=$this->pv['scriptToRun'];
		$this->releaseResources();
		echo $html;
	}

	function drawLeftContents() {
		if (strlen($this->pv['pageLeftContents'])==0) {
			return "";
		}
		
		$html="
			<td nowrap class=\"leftContents\" style=\"vertical-align:".$this->pageLeftVerticalAlign."; width:10px;\">
				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" style=\"width:100%;\">
				<tr><td>
					<center>
					".$this->pv['pageLeftContents']."							
					</center>
				</td></tr>
				</table>
			</td>";
		
		return $html;
	}

	function drawRightContents() {
		if (strlen($this->pv['pageRightContents'])==0) {
			return "";
		}
		
		$html="
			<td nowrap style=\"vertical-align:".$this->pageRightVerticalAlign."; width:10px;\">
				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" style=\"width:100%;\">
				<tr><td>
					<center>
					".$this->pv['pageRightContents']."							
					</center>
				</td></tr>
				</table>
			</td>";
		
		return $html;
	}
	
	function drawBlankForm($action="#", $method="post", $name="myPage") {
		switch ($this->pageVerticalAlign) {
		case "middle":
			$tableId="fullTableMiddle";
		case "top":
			$tableId="fullTableTop";
		}

		$html="
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" id=\"".$tableId."\">
			<tr>
				<td style=\"height:80%; color:black; vertical-align:".$this->pageVerticalAlign.";\">
					<center>
						<form method=\"".$method."\" name=\"".$name."\">
						".$this->pv['pageContents']."							
						<input type='hidden' name='action' value='$this->action'>
						<input type='hidden' name='actionSubPage'>
						<input type='hidden' name='id'>
						<input type='hidden' name='idtoremove'>
						<input type='hidden' name='transid' value='$page_id'>
						<input type='hidden' name='objFocused' value='$this->objFocused'>
						".$this->tagHiddenField."
						</form>
					</center>
				</td>
			</tr>
			</table>";

		$html.=$this->pv['scriptToRun'];
		
		$this->releaseResources();
		echo $html;
	}

/**** fauzan ****/
	function drawBlankFormImages($action="#", $method="post", $name="myPage", $transactionID="") {
		$formCaption=$this->page_title;
		$formNavigator=$this->drawNavigator($transactionID,$formCaption);
		
		if (strlen($formNavigator)<> 0) {
			$formNavigator="<tr><td class=\"pageNav\">".$formNavigator."</td></tr>";
		}

		if (strlen($this->pv['pageTopWarning'])!=0) {
			$htmlTopWarning="<tr><td colspan=\"10\" style=\"height:10px;\">".$this->pv['pageTopWarning']."</td></tr>";
			$mainContentStyle="";
		} else {
			$mainContentStyle=" ";
		}
		
		$html="
		<form method=\"".$method."\" name=\"".$name."\" enctype=\"multipart/form-data\">
		<div id=\"framecontentTop\">
			".$this->drawNavigator($transactionID,$formCaption)."
		</div>
		<div id=\"framecontentBottom\">
			<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"height:100%; width:100%;\">
			<tr><td class=\"pageFooterInfo\">Copyright : <strong>PUPERA @IT-Indonesia</strong> (For Internal Used Only)</td></tr>
			</table>
		</div>
			<div id=\"maincontent\" ".$mainContentStyle.">
				<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" style=\"height:100%; width:100%;\">
				".$htmlTopWarning."
				<tr>
					".$this->drawLeftContents()."
					<td style=\"vertical-align:".$this->pageVerticalAlign.";\">
						<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" style=\"width:100%;\">
						<tr><td>
							<center>
							".$this->pv['pageContents']."							
							<input type='hidden' name='action' value='$this->action'>
							<input type='hidden' name='actionSubPage'>
							<input type='hidden' name='id'>
							<input type='hidden' name='idtoremove'>
							<input type='hidden' name='transid' value='$page_id'>
							<input type='hidden' name='objFocused' value='$this->objFocused'>
							".$this->tagHiddenField."
							</center>
						</td></tr>
						</table>
					</td>
					".$this->drawRightContents()."
				</tr>
				</table>
			</div>
		</form>";
		
		$html.=$this->pv['scriptToRun'];
		$this->releaseResources();
		echo $html;
	}

/**** fauzan ****/


	function drawNavigator($transactionID,$formCaption) {
		if (strlen($transactionID)==0) {
			$transactionID="&nbsp;";
		} else {
			$transactionID="Transaction ID : <strong>&nbsp;".$transactionID."</strong>";
		}
		
		if (strlen($this->navigatorbar)<>0) {
			$temp="<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%; height:25px;\">";
			
			if (strlen($formCaption)!=0) {
				$temp.="<tr><td nowrap class=\"pageInfo\"><strong>".$formCaption."</strong></td><td class=\"largeBreak\">&nbsp;</td>";
			}
			
				$navbar=explode("|",$this->navigatorbar);
				$navlink=explode("|",$this->navigatorlink);
				$icount=count($navbar);

				for($i=0;$i< $icount;$i++) {
					$navlink[$i]=str_replace("\"","'",$navlink[$i]);
					
  					if (substr($navlink[$i],0,2)<>"<a") {
						$temp.= 
						"<td nowrap class=\"pageMenu\" onClick=\"".$navlink[$i].";\">".$navbar[$i]."</td>";
					} else {
						$temp.= "<td nowrap class=\"pageMenu\" onClick=\"".$navlink[$i].";\">".$navbar[$i]."</td>";
					}
				}
				
			$temp.= "
					<td nowrap width='100%' style=\"padding-right:15px; text-align:right;\">&nbsp;</td>
					<td nowrap style=\"padding-right:15px; text-align:right;\">".$transactionID."</td>
				</tr></table>";
		} else {
			$temp=
			"<table border=\"0\" width=\"100%\" cellpadding=\"0\" cellspacing=\"0\">
			<tr>
				<td nowrap class=\"pageInfo\"><strong>".$formCaption."</strong></td><td class=\"largeBreak\">&nbsp;</td>
				<td nowrap width='100%' style=\"padding-right:15px; text-align:right;\">&nbsp;</td>
				<td nowrap style=\"padding-right:15px; text-align:right;\">".$transactionID."</td>
			</tr>
			</table>";
		}
		
		$temp="
		<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%; height:100%;\">
		<tr><td style=\"vertical-align:middle;\">".$temp."</td></tr>
		</table>";
		
		return $temp;
	}
	
	function drawHeaderForm($arrContents) {
		for($i=0;$i<count($arrContents);$i++) {
			switch ($arrContents[$i][0]) {
			case "left":
				$arrContentsLeft[]=$arrContents[$i];
				break;
			case "right":
				$arrContentsRight[]=$arrContents[$i];
				break;
			case "full":
				$arrContentsFull[]=$arrContents[$i];
				break;
			}
		}
		
		$html=""; $htmlFull="";
		
		for($i=0;$i<count($arrContentsLeft);$i++) {
			$caption="&nbsp;"; $value="&nbsp;";
			if (strlen($arrContentsLeft[$i][1]) <> 0) { $caption=$arrContentsLeft[$i][1]." :"; }
			if (strlen($arrContentsLeft[$i][2]) <> 0) { $value=$arrContentsLeft[$i][2]; }
			$htmlLeft="<tr><td nowrap class=\"colCaption\">".$caption."</td><td nowrap class=\"colValue\">".$value."</td>";

			$caption="&nbsp;"; $value="&nbsp;";
			if (strlen($arrContentsRight[$i][1]) <> 0) { $caption=$arrContentsRight[$i][1]." :"; }
			if (strlen($arrContentsRight[$i][2]) <> 0) { $value=$arrContentsRight[$i][2]; }
			$htmlRight="<td nowrap class=\"colCaption\">".$caption."</td><td nowrap class=\"colValue\">".$value."</td></tr>";

			$html.=$htmlLeft."<td style=\"width:50px;\">&nbsp;</td>".$htmlRight;
		}

		for($i=0;$i<count($arrContentsFull);$i++) {
			$caption="&nbsp;"; $value="&nbsp;";
			if (strlen($arrContentsFull[$i][1]) <> 0) { $caption=$arrContentsFull[$i][1]." :"; }
			if (strlen($arrContentsFull[$i][2]) <> 0) { $value=$arrContentsFull[$i][2]; }
			$htmlFull.="<tr><td nowrap class=\"colCaption\">".$caption."</td><td nowrap class=\"colValue\" colspan=\"4\">".$value."</td></tr>";
		}
		
		return "<table cellpadding=\"0\" cellspacing=\"0\" border=\"0\" align=\"center\" width=\"700px\">".$html.$htmlFull."</table>";
	}
	
	function formSubInfo($value="") {
		$html="<br \><strong>".$value."</strong><br \>";
		
		return $html;
	}
	
	function formFieldInfo($labelInfo="&nbsp;", $useButtomBorder=true) {
		$html="
		<label>&nbsp;</label>
		<small>$labelInfo</small>";
		
		if ($useButtomBorder==true) {
			$borderProp="border-bottom:1px dotted; ";
		} else {
			$borderProp="";
		}
		
		$html="
		<div style=\"".$borderProp."text-align:center; font-size:10px; padding-top:5px; padding-bottom:5px;\">
		$labelInfo</div>";
		
		return $html;
	}

	function formLabelBold($labelInfo="&nbsp;", $useButtomBorder=true) {
		$html="
		<label>&nbsp;</label>
		<b>$labelInfo</b>";
		
		if ($useButtomBorder==true) {
			$borderProp="border-bottom:1px dotted; ";
		} else {
			$borderProp="";
		}
		
		$html="
		<div style=\"".$borderProp."text-align:center; font-size:12px; padding-top:5px; padding-left:5px; padding-bottom:5px;font-weight:bold;\">
		$labelInfo</div>";
		
		return $html;
	}

	function formLabel($labelCaption="&nbsp;", $labelValue="", $labelValueStyle="") {
		if (strlen($labelCaption)<>0) { $labelCaption.=" :"; }
		if (strlen(rtrim($labelValue))==0) { $labelValue="&nbsp;"; }
		
		$html="
		<label class=\"fieldCaption\">".$labelCaption."</label>".
		"<label class=\"fieldValue\" $labelValueStyle>".$labelValue."</label>"."<br>";
		
		return $html;
	}

	function formLabel2($labelCaption="&nbsp;", $labelValue="", $labelValueStyle="") {
		if (strlen($labelCaption)<>0) { $labelCaption.=" :"; }
		if (strlen(rtrim($labelValue))==0) { $labelValue="&nbsp;"; }
		
		$html="
		<label class=\"fieldCaption\">".$labelCaption."</label>".
		"<label  $labelValueStyle>".$labelValue."</label>"."<br>";
		
		return $html;
	}

	function formSearch($labelName="", $labelCaption="&nbsp;", $labelValue="", $labelIdValue="", $buttonCaption="...", $buttonEvent="") {
		if (strlen($labelValue)==0) { $labelValue="EMPTY VALUE"; $labelStyle="style=\"color:#ADADAD;\""; }
		
		$html="
		<label class=\"fieldCaption\">".$labelCaption." :</label>".
		"<label class=\"fieldSearch\" $labelStyle>".$labelValue."</label>
		<input type=\"button\" name=\"cmd".$labelName."\" value=\"$buttonCaption\" onClick=\"".$buttonEvent."\">
		".$this->hidden($labelName."_id", $labelIdValue)."
		"."<br>";
		
		return $html;
	}

	function objectDate($objName="", $value="", $objProperty="", $objStyle="style=\"width:100px; background-color:white; font-weight:bold;\"") {
		$buttonEvent="if(self.gfPop)gfPop.fPopCalendar(document.myPage.".$objName.");return false;";
		
		$html=$this->textBox($objName,$value,$objProperty." readonly",$objStyle)."<input type=\"button\" name=\"cmd".$objName."\" value='...' onClick=\"".$buttonEvent."\">";
		
		return $html;
	}
	
	function formDate($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:100px; background-color:white; font-weight:bold;\"", $labelstyle="", $rightLable="") {
		$buttonEvent="if(self.gfPop)gfPop.fPopCalendar(document.myPage.".$objName.");return false;";
		
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->textBox($objName,$value,$objProperty." readonly",$objStyle)."<input type=\"button\" name=\"cmd".$objName."\" value='...' onClick=\"".$buttonEvent."\">".$rightLable."<br>";
		
		return $html;
	}
		
	function formDateBirth($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:100px; background-color:white; font-weight:bold;\"", $labelstyle="", $rightLable="") {
		$buttonEvent="if(self.gfPop)gfPop.fPopCalendar(document.myPage.".$objName.");return false;";
		
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->textBox($objName,$value,$objProperty,$objStyle)."<input type=\"button\" name=\"cmd".$objName."\" value='...' onClick=\"".$buttonEvent."\">".$rightLable."<br>";
		
		return $html;
	}
		
	function formTextBox($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="", $rightLable="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->textBox($objName,$value,$objProperty,$objStyle)." ".$rightLable."<br>";
		
		return $html;
	}

	function textBox($objName="", $value="", $objProperty="", $objStyle="style=\"width:150px;\"") {
		$html="
		<input type=\"text\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." value=\"".$value."\" title=\"".$objName."\" $objStyle onkeypress=\"return handleEnter(this, event)\">";
		
		return $html;
	}

	function formTextArea($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:200px;\"", $labelstyle="", $rightLable="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->textArea($objName,$value,$objProperty,$objStyle)." ".$rightLable."<br>";
		
		return $html;
	}

	function textArea($objName="", $value="", $objProperty="", $objStyle="style=\"width:200px;\"") {
		$html="
		<textarea type=\"textarea\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." title=\"".$objName."\" $objStyle>".$value."</textarea>";
		
		return $html;
	}
	
	function formTextBoxPassword($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="", $rightLable="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->textBoxPassword($objName,$value,$objProperty,$objStyle)." ".$rightLable."<br>";
		
		return $html;
	}

	function textBoxPassword($objName="", $value="", $objProperty="", $objStyle="style=\"width:150px;\"") {
		$html="
		<input type=\"password\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." value=\"".$value."\" title=\"".$objName."\" $objStyle onkeypress=\"return handleEnter(this, event)\">";
		
		return $html;
	}
	
	function hidden($objName="", $value="") {
		$html="
		<input type=\"hidden\" id=\"".$objName."\" name=\"".$objName."\" value=\"".$value."\">";
		
		return $html;
	}
	
	function submit($objName="", $value="", $objProperty="", $objActionEvent="", $objStyle="") {
		$html="
		<input type=\"submit\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." value=\"".$value."\" $objStyle $objActionEvent>";
		
		return $html;
	}

	function button($objName="", $value="", $objProperty="", $objActionEvent="", $objStyle="") {
		$html="
		<input type=\"button\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." value=\"".$value."\" $objStyle $objActionEvent>";
		
		return $html;
	}
	
	function formCombo($label="&nbsp;", $objName="", $value="", $arrKey, $arrTitle, $blankCaption, $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->combo($objName, $value, $arrKey, $arrTitle, $blankCaption, $objProperty, $objStyle)."<br>";

		return $html;
	}
	
	

	function formComboPdo($label="&nbsp;", $objName="", $value="", $conn, $query, $blankCaption, $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->comboPdo($objName, $value, $conn, $query, $blankCaption, $objProperty, $objStyle)."<br>";

		return $html;
	}

	function comboPdo($objName, $value="", $conn, $query, $blankCaption, $objProperty="", $objStyle="style=\"width:150px;\"") {
		$arr_value="";
		$arr_key="";
		$arr_title="";

		foreach ($conn->query($query) as $row) {
			$arr_value.=$row[0]."|";
			$arr_title.=$row[1]."|";
		}

		$varr=explode('|',substr($arr_title,0,strlen($arr_title)-1));
		$varr_id=explode('|',substr($arr_value,0,strlen($arr_value)-1));

		$temp=$this->combo($objName, $value, $varr_id, $varr, $blankCaption, $objProperty, $objStyle);

		return $temp;
	}

	function formComboDate($label="&nbsp;", $objName, $arrMonthId, $arrMonth, $dateValue='', $monthValue='', $yearValue='', $labelProperty="", $objProperty="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->comboDate($objName, $arrMonthId, $arrMonth, $dateValue, $monthValue, $yearValue, $objProperty)."<br>";

		return $html;
	}
	
	function comboDate($objName, $arrMonthId, $arrMonth, $dateValue='', $monthValue='', $yearValue='', $objProperty="") {
		$arrDate=array(1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 21, 22, 23, 24, 25, 26, 27, 28, 29, 30, 31);

		for($i=date("Y")-5;$i<date("Y")+5+1;$i++) {
			$arrYear[]=$i;
		}

		$html=$this->combo($objName."_d", $dateValue, $arrDate, $arrDate, "-day-", $objProperty, "")."&nbsp;";
		$html.=$this->combo($objName."_m", $monthValue, $arrMonthId, $arrMonth, "-month-", $objProperty, "")."&nbsp;";
		$html.=$this->combo($objName."_y", $yearValue, $arrYear, $arrYear, "-year-", $objProperty, "");
			
		return $html;
	}
	
	function combo($objName="", $value="", $arrKey, $arrTitle, $blankCaption, $objProperty="", $objStyle="style=\"width:150px;\"") {
		$html="<select name='$objName' id='$objName' $objProperty $objStyle onkeypress=\"return handleEnter(this, event)\">";
		
		if ($blankCaption<>"") {
			$html.="<option value=''>$blankCaption</option>";
		}
		//die("ok: ".$value);
		for($i=0;$i<count($arrKey);$i++) {
			if (strlen($arrTitle[$i])<>0) {
				if($arrKey[$i]==$value) {
					$tempSel="selected";
				} else {
					$tempSel="";
				}
				//echo $arrKey[$i]." - ".$arrTitle[$i]."<br>";	
				$html.="<option value=\"$arrKey[$i]\" $tempSel>" . $arrTitle[$i] . "</option>";
			}
		}				
//		die("ok: ".$value);
	
		$html.="</select>";
		return $html;
	}

//fauzan
	function formCheckBox($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:200px;\"", $labelstyle="", $rightLable="") {
		$html="
		<label for=\"".$objName."\" ".$labelProperty.">".$label."</label>".
		$this->checkBox($objName,$value,$objProperty,$objStyle)." ".$rightLable."<br>";
		
		return $html;
	}

	function checkBox($objName="", $value="", $objProperty="", $objStyle="style=\"width:200px;\"") {
		$html="
		<input type=\"checkbox\" value=\"".$value."\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty."  title=\"".$objName."\" $objStyle>";
		
		return $html;
	}


	function formFileImage($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="", $rightLable="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->FileImage($objName,$value,$objProperty,$objStyle)." ".$rightLable."<br>";
		
		return $html;
	}

	function FileImage($objName="", $value="", $objProperty="", $objStyle="style=\"width:150px;\"") {
		$html="
		<input type=\"file\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." value=\"".$value."\" title=\"".$objName."\" $objStyle >";
		
		return $html;
	}
	
	function formLabel3($labelCaption="&nbsp;", $labelValue="", $labelValueStyle="") {
		if (strlen($labelCaption)<>0) { $labelCaption.=" :"; }
		if (strlen(rtrim($labelValue))==0) { $labelValue="&nbsp;"; }
		
		$html="
		<label class=\"fieldCaption\">".$labelCaption."</label>".
		$labelValue."<br>";
		
		return $html;
	}
	
	
	function formTextBoxCheckValue($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="", $rightLable="", $valValue="", $valObjProperty="",  $valObjStyle="", $checkValue="", $checkObjProperty="",  $checkObjStyle="",$checkFunction="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->textBoxCheckValue($objName,$value,$objProperty,$objStyle,$valValue,$valObjProperty,$valObjStyle,$checkValue,$checkObjProperty,$checkObjStyle,$checkFunction)." ".$rightLable."<br>";
		
		return $html;
	}

	function textBoxCheckValue($objName="", $value="", $objProperty="", $objStyle="style=\"width:150px;\"", $valValue="", $valObjProperty="", $valObjStyle="style=\"width:150px;\"", $checkValue="", $checkObjProperty="", $checkObjStyle="style=\"width:50px;\"",$checkFunction="") {
		$html="
		<input type=\"text\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." value=\"".$value."\" title=\"".$objName."\" $objStyle onkeypress=\"return handleEnter(this, event)\"> <input type=\"text\" id=\"val".$objName."\" name=\"val".$objName."\" ".$valObjProperty." value=\"".$valValue."\" title=\"val".$objName."\" $valObjStyle onkeypress=\"return handleEnter(this, event)\">  <input type=\"checkbox\" id=\"check".$objName."\" name=\"check".$objName."\" ".$checkObjProperty." value=\"checked\" title=\"".$objName."\" $checkObjStyle onClick=\"".$checkFunction."\">";
		
		return $html;
	}
	
	
	
	

function formCheckBoxValue($label="&nbsp;", $objName="", $value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:200px;\"", $labelstyle="", $rightLable="", $valValue="", $valObjProperty="", $valObjStyle="style=\"width:150px;\"") {
		$html="
		<label for=\"".$objName."\" ".$labelProperty.">".$label."</label>".
		$this->checkBoxValue($objName,$value,$objProperty,$objStyle, $valValue, $valObjProperty, $valObjStyle)." ".$rightLable."<br>";
		
		return $html;
	}

	function checkBoxValue($objName="", $value="", $objProperty="", $objStyle="style=\"width:200px;\"", $valValue="", $valObjProperty="", $valObjStyle="style=\"width:150px;\"") {
		$html="
		<input type=\"text\" id=\"val".$objName."\" name=\"val".$objName."\" ".$valObjProperty." value=\"".$valValue."\" title=\"val".$objName."\" $valObjStyle onkeypress=\"return handleEnter(this, event)\"> <input type=\"checkbox\" value=\"".$value."\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty."  title=\"".$objName."\" $objStyle>";
		
		return $html;
	}




function formComboNoTurun($label,$objName="", $value="", $arrKey, $arrTitle, $blankCaption, $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="") {
		$html="
		<label ".$labelProperty.">".$label."</label>".
		$this->combo($objName, $value, $arrKey, $arrTitle, $blankCaption, $objProperty, $objStyle);

		return $html;
	}
	function formTextBoxCheckValue2($label="&nbsp;", $objName="",$cbGetValue, $cb_value_id="", $cb_value="", $cbLabelProperties="",$cbValObjProperty, $cbValObjStyle="style=\"width:40px;\"",$value="", $objProperty="", $labelProperty="", $objStyle="style=\"width:150px;\"", $labelstyle="", $rightLable="", $valValue="", $valObjProperty="",  $valObjStyle="", $checkValue="", $checkObjProperty="",  $checkObjStyle="",$checkFunction="") {
		$html=
		$this->textBoxCheckValue2($label, $objName,$cbGetValue, $cb_value_id, $cb_value,$cbLabelProperties,$cbValObjProperty, $cbValObjStyle,$value,$objProperty,$objStyle,$valValue,$valObjProperty,$valObjStyle,$checkValue,$checkObjProperty,$checkObjStyle,$checkFunction)." ".$rightLable."<br>";
		
		return $html;
	}

	function textBoxCheckValue2($label, $objName="", $cbGetValue, $cb_value_id="", $cb_value="", $cbLabelProperties="",$cbValObjProperty, $cbValObjStyle="style=\"width:40px;\"", $value, $objProperty="", $objStyle="style=\"width:150px;\"", $valValue="", $valObjProperty="", $valObjStyle="style=\"width:150px;\"", $checkValue="", $checkObjProperty="", $checkObjStyle="style=\"width:50px;\"",$checkFunction="") {
		$html=
		 $this->formComboNoTurun($label,"cb".$objName, $cbGetValue, $cb_value_id, $cb_value, "", $cbLabelProperties="", "",$cbValObjProperty, $cbValObjStyle="style=\"width:40px;\"")."&nbsp;<input type=\"checkbox\" id=\"check".$objName."\" name=\"check".$objName."\" ".$checkObjProperty." value=\"checked\" title=\"".$objName."\" $checkObjStyle onClick=\"".$checkFunction."\">&nbsp;<input type=\"text\" id=\"".$objName."\" name=\"".$objName."\" ".$objProperty." value=\"".$value."\" title=\"".$objName."\" $objStyle onkeypress=\"return handleEnter(this, event)\">";
		
		return $html;
	}		





//fauzan	














































	function draw_page($page_id="",$form_property="") {
		global $lg;
		$this->set_navigator();

		if ($this->background_colour<>"") {
			$page_colour="bgcolor='#EFEEDF'";
		}
		
		if (strlen($page_id)<>0) {
			$temp_id=$lg->transaction_no . " : " . $page_id;
		}

		echo "
		<table border=0 cellpadding=0 cellspacing=0 width='100%' height='100%'>
		<form method='post' name='mypage'>
		<tr height='1'><td>
			<table width='100%' border='0' cellspacing='0' bgcolor='#EFEEDF'>
			<tr height='30'>
				<td width='5'></td>
				<td><label class='page_caption'>".$this->page_title."</label></td>
				<td width='45%' align='right'><label class='page_caption'>".$temp_id."</label></td>
				<td width='5'></td>
			</tr>
			</table>
		</td></tr>";
		
		if ($this->tag_menu<>"") {
			echo "<tr height='20' bgcolor='#EFEEDF'><td>".$this->tag_menu."</td></tr>";
		}

		echo $this->row_line("#BDC8BD", "white")."
		<tr><td>
			<table border='0' cellpadding=0 cellspacing=0 width='100%' height='100%'>";

			if ($this->tag_contents<>"") {
				echo "<tr>";
				if ($this->tag_right_contents<>"") {
					echo "
					<td $page_colour valign='$this->contents_valign'>$this->tag_contents</td>
					<td bgcolor='#EFEEDF' rowspan='10' width='$this->right_width' valign='$this->right_valign'>$this->tag_right_contents</td>";
				} else {
					echo "
					<td $page_colour valign='$this->contents_valign'>$this->tag_contents</td>
					<td rowspan='10' width='1'></td>";
				}

				echo "</tr>";
			} else {
				if ($this->tag_header_stored<>"") {
					echo "<tr height='30' bgcolor='#EFEEDF'>";
					
						if ($this->tag_right_contents<>"") {
							echo "
							<td valign='top'>$this->tag_header_stored</td>
							<td bgcolor='#EFEEDF' rowspan='10' width='$this->right_width' valign='$this->right_valign'>$this->tag_right_contents</td>";
						} else {
							echo "
							<td valign='top'>$this->tag_header_stored</td>
							<td rowspan='10' width='1'></td>";
						}
					
					echo "</tr>";
				}

				if ($this->tag_detail_info<>"") {
					echo "<tr height='30' bgcolor='#D5E0D5'><td align='center'><label style='color:#6A6A6A; font-size: 8pt; font-family: Tahoma, Arial, Helvetica, serif; font-weight: bold;'>$this->tag_detail_info</label></td></tr>";
				}

				if ($this->tag_detail_stored<>"") {
					echo "<tr height='30'><td>$this->tag_detail_stored</td></tr>";
				}

				if ($this->tag_first_input<>"") {
					echo "<tr $page_colour><td valign='top'>$this->tag_first_input</td></tr>";
				}
				
				if ($this->tag_detail_input<>"") {
					echo "<tr><td valign='center'>$this->tag_detail_input</td></tr>";
				}	
			}


		echo "
			</table>
		</td></tr>
		".$this->row_line("#BDC8BD", "white")."
		<tr height='30' bgcolor='#EFEEDF'><td align='center'><label class='soft'>Copyright : <b>PUPERA @IT-Indonesia</b><i> (For Internal Used Only)</i></label></td></tr>
		<tr height='1'><td>
			<input type='hidden' name='action' value='$this->action'>
			<input type='hidden' name='transid' value='$page_id'>
			<input type='hidden' name='objfocused' value='$this->objfocused'>
			<input type='hidden' name='unfocusedpage' value='$this->unfocusedpage'>
		</td></tr>
		</form>
		</table>";
	}

	function draw_report($page_id="") {
		global $pg;
		$myreportview=$this->tag_contents;
		
		echo "<table width='95%' align='center' border='0' cellpadding='0' cellspacing='0'>
		".$this->row_space('20')."
		<tr height='25'>
			<td colspan='10'><label class='report_header'>".$this->pv['report_caption']."</label></td>
		</tr>";

			if (strlen($this->pv['report_header_1'])<>0) {
				echo "
				<tr height='17'>
					<td width='150'><label class='black'>".$this->pv['report_header_1'][0]."</label></td>
					<td width='10'><label class='black'>:</label></td>
					<td width='200'><label class='black'>".$this->pv['report_header_1'][1]."</label></td>
					<td colspan='10' align='right'><label class='black'></label></td>
				</tr>";
			}

			if (strlen($this->pv['report_header_2'])<>0) {
				echo "
				<tr height='17'>
					<td width='150'><label class='black'>".$this->pv['report_header_2'][0]."</label></td>
					<td width='10'><label class='black'>:</label></td>
					<td width='200'><label class='black'>".$this->pv['report_header_2'][1]."</label></td>
					<td colspan='10' align='right'><label class='black'></label></td>
				</tr>";
			}
			
		echo "
		".$this->row_space('5')."
		<tr height='17'>
			<td width='150'><label class='black'>Print Date</label></td>
			<td width='10'><label class='black'>:</label></td>
			<td width='200'><label class='black'>".date("d F Y H:i:s")."</label></td>
			<td colspan='10' align='right'><label class='black'>Best View : <b>".$this->pv['best_view']."</b></label></td>
		</tr>
		<tr height='17'>
			<td width='150'><label class='black'>User Name</label></td>
			<td width='10'><label class='black'>:</label></td>
			<td width='200'><label class='black'>".$_SESSION['secsession']['user_name']."</label></td>
			<td colspan='10' align='right'><label class='black'>This report is for internal used only in PUPERA</label></td>
		</tr>
		".$this->row_space('10')."
		<tr>
			<td colspan='10'><label class='soft'>$myreportview</label></td>
		</tr>
		</td></tr>
		</table>";

//		<tr height='40'><td colspan='10' align='center'>
//		".$this->obj_button("btnclose", "Close Window", "onclick=\"window.close();\"")."
	}

	function draw_criteria() {
		global $pg;

		echo "
		<table width='100%' height='100%' border='0' cellpadding='0' cellspacing='0'>
		<form method='post' name='mypage'>
		<tr>
			<td valign='center'>
				<table align='center' width='60%' border='0' cellpadding='0' cellspacing='0'>
				<tr height='25'>".$this->col_value($this->pv['report_caption'], "report_header", "align='center'")."</tr>
				<tr height='18'>".$this->col_value("Best view in : ".$this->pv['best_view'], "soft", "align='center'")."</tr>
				".$this->row_space("10")."
				".$this->row_line("#BDC8BD", "")."
				<tr bgcolor='#EFEEDF'>
					<td valign='center'>".$this->tag_contents."</td>
				</tr>
				".$this->row_space("10","20","bgcolor='#EFEEDF'")."
				".$this->row_obj_button("btnpreview", "Preview Report", "colspan='10' align='center' bgcolor='#EFEEDF'", "onclick=\"page_submit('preview')\"")."
				".$this->row_space("10","20","bgcolor='#EFEEDF'")."
				".$this->row_line("#BDC8BD", "")."
				</table>
			</td>
		</tr>
		<tr height='1'><td>
			<input type='hidden' name='action' value='$this->action'>
			<input type='hidden' name='objfocused' value='$this->objfocused'>
		</td></tr>
		</form>
		</table>";
	}

	function set_navigator() {
		if (strlen($this->navigatorbar)<>0) {
			$temp=
			"<table border=0 width=100% cellpadding=0 cellspacing=0>
			<tr height=10>";

				$navbar=explode("|",$this->navigatorbar);
				$navlink=explode("|",$this->navigatorlink);
				$icount=count($navbar);

				for($i=0;$i< $icount;$i++) {
  					if (substr($navlink[$i],0,2)<>"<a") {
						$temp.= 
						"<td nowrap style='border-right:solid windowtext .5pt; padding:0in 6pt 0in 6pt'>
						<a href='".$navlink[$i]."' class='navigator'>".$navbar[$i]."</a></td>";
					} else {
						$temp.= "<td nowrap style='border-right:solid windowtext .5pt; padding:0in 6pt 0in 6pt'>".$navlink[$i]."</td>";
					}
				}
				
			$temp.= "<td width='100%'></td></tr></table>";
		}
		
		$this->tag_menu=$temp;
	}
	
	function row_line($colour_1="#BDC8BD", $colour_2="white", $property="colspan='20'", $height="1") {
		$temp="<tr id='ignore' bgcolor='$colour_1' height='$height'><td $property></td></tr>";
		
		if ($colour_2<>"") {
			$temp.="<tr id='ignore' bgcolor='$colour_2' height='$height'><td $property></td></tr>";
		}

		return $temp;
	}

	function row_info($value, $class="row_info", $row_property="", $col_property="colspan='20'") {
		$temp="<tr $row_property id='ignore'>".$this->col_value($value, $class, $col_property)."</tr>";
		return $temp;
	}
	
	function row_space($height="5", $colspan="20", $row_property="") {
		$temp="<tr id='ignore' height='$height' $row_property><td colspan='$colspan'></td></tr>";
		return $temp;
	}

 	function row_lable($caption, $value, $class="black", $row_property="height='20'", $col_property="") {	
		return "<tr $row_property><td style='padding:0in 4pt 0in 0pt' align='right'><label class='soft'>$caption :</label></td>
		<td $col_property><label class='$class'>$value</label></td></tr>";
	}

 	function row_lable_link($caption, $value, $link_caption="Show Detail", $href="#", $class="black", $row_property="height='20'", $col_property="") {	
		return "<tr $row_property><td style='padding:0in 4pt 0in 0pt' align='right'><label class='soft'>$caption :</label></td>
		<td $col_property>
			<table border='0' cellpadding='0' cellspacing='0' align='left' border='0' width='100%'>
				<tr>
				<td><label class='$class'>$value</label></td>
				<td align='right'><a href='$href' class='soft'>$link_caption</a></td>
			</tr>
			</table>
		</td></tr>";
	}
	
 	function double_lable($caption, $value, $use_column_space=false, $class="black", $col_property="") {	
		$temp="
		<td nowrap align='right' style='padding:0in 4pt 0in 0pt'><label class='soft'>$caption :</label></td>
		<td nowrap width='200' $col_property><label class='$class'>$value</label></td>";
		
		if ($use_column_space==true) { $temp.="<td width='30'></td>"; }
		
		return $temp;
	}
		
 	function col_value($value, $class="soft", $col_property="") {
		return "<td style='padding:0in 4pt 0in 4pt' $col_property><label class='$class'>$value</label></td>";
	}

	//OBJECT DRAWER
	function obj_hidden($name, $value='') {
		return "<input type='hidden' name='$name' value='$value'>";
	}

	function row_obj_search($caption, $value, $button_name, $button_caption, $button_property="", $width="100%") {
		return "<tr>
			<td nowrap align='right' style='padding:0in 4pt 0in 0pt'><label class='soft'>$caption :</label></td>
			<td bgcolor='white' align='right' valign='center'>
				<table width='$width' border='0' cellspacing='0' cellpadding='0'>
				".$this->row_line("#BDC8BD","")."
				<tr>
					<td align='left' style='padding:0in 0pt 0in 4pt'><label class='black'>$value<label></td>
					<td width='10' align='right'>".$this->obj_button($button_name, $button_caption, $button_property)."</td>
				</tr>
				".$this->row_line("#BDC8BD","white")."
				</table>				
			</td>
		</tr>";
	}

	function row_obj_text($caption, $name, $value, $size="15", $property="", $class="soft") {
		$temp="
			<tr height='$this->row_height'>
			<td class=\"formLabel\">$caption :</td>
			<td nowrap><input class='$class' type='text' name='$name' value='$value' size='$size' $property onkeypress=\"return handleEnterArrow(this, event)\"></td>
			</tr>";
		return $temp;
	}

	function col_obj_text($caption, $name, $value, $size="15", $property="", $class="soft") {
		$temp="
			<td class=\"formLabel\">$caption :</td>
			<td nowrap><input class='$class' type='text' name='$name' value='$value' size='$size' $property onkeypress=\"return handleEnterArrow(this, event)\"></td>";
		return $temp;
	}
	
	function obj_text($name, $value, $size="15", $property="", $class="soft") {
		$temp="<input class='$class' type='text' name='$name' value='$value' size='$size' $property onkeypress=\"return handleEnterArrow(this, event)\">";
		return $temp;
	}

	function row_obj_password($caption, $name, $value, $size="15", $property="", $class="soft") {
		$temp="
			<tr height='$this->row_height'>
			<td class=\"formLabel\">$caption :</td>
			<td nowrap><input class='$class' type='password' name='$name' value='$value' size='$size' $property onkeypress=\"return handleEnterArrow(this, event)\"></td>
			</tr>";
		return $temp;
	}
	
	function col_obj_password($caption, $name, $value, $size="15", $property="", $class="soft") {
		$temp="
			<td class=\"formLabel\">$caption :</td>
			<td nowrap><input class='$class' type='password' name='$name' value='$value' size='$size' $property onkeypress=\"return handleEnterArrow(this, event)\"></td>";
		return $temp;
	}
	
	function obj_password($name, $value, $size="15", $property="", $class="soft") {
		$temp="<input class='$class' type='password' name='$name' value='$value' size='$size' $property onkeypress=\"return handleEnterArrow(this, event)\">";
		return $temp;
	}
	
	//OBJECT BUTTON
	function row_obj_button($name, $value, $col_property="", $property="", $class="standard") {
		$temp="
			<tr id='ignore' height='$this->row_height'><td nowrap $col_property><input type='button' name='$name' value='$value' class='$class' $property></td></tr>";
		return $temp;
	}

	function col_obj_button($name, $value, $col_property="", $property="", $class="standard") {
		$temp="
			<td nowrap $col_property><input type='button' name='$name' value='$value' class='$class' $property></td>";
		return $temp;
	}

	function obj_button($name, $value, $property="", $class="standard") {
		$temp="<input type='button' name='$name' value='$value' class='$class' $property>";
		return $temp;
	}
	
	//OBJECT COMBO
	function row_obj_combo_pdo($caption, $name, $value="", $conn, $query, $col_property="", $property="", $class="standard", $blank_caption="") {
		$temp="
			<tr height='$this->row_height'><td class=\"formLabel\">$caption :</td>
			<td nowrap $col_property>";
		$temp.=$this->obj_combo_pdo($name, $value, $conn, $query, $property, $class, $blank_caption);
		$temp.="</td></tr>";
		
		return $temp;
	}

	function col_obj_combo_pdo($name, $value="", $conn, $query, $col_property="", $property="", $class="standard", $blank_caption="") {
		$temp="<td nowrap $col_property>";
		$temp.=$this->obj_combo_pdo($name, $value, $conn, $query, $property, $class, $blank_caption);
		$temp.="</td>";
		
		return $temp;
	}
	
	function obj_combo_pdo($name, $value="", $conn, $query, $property="", $class="standard", $blank_caption="") {
		$arr_key="";
		$arr_title="";

		foreach ($conn->query($query) as $row) {
			$arr_value.=$row[0]."|";
			$arr_title.=$row[1]."|";
		}

		$varr=explode('|',substr($arr_title,0,strlen($arr_title)-1));
		$varr_id=explode('|',substr($arr_value,0,strlen($arr_value)-1));
		
		$temp=$this->obj_combo($name, $value, $varr_id, $varr, $property, $class, $blank_caption);
		return $temp;
	}
	
	function row_obj_combo($caption, $name, $value, $arr_key, $arr_title, $col_property="", $property="", $class="standard", $blank_caption="") {
		$temp="
			<tr height='$this->row_height'><td class=\"formLabel\">$caption :</td>
			<td nowrap $col_property>";
		$temp.=$this->obj_combo($name, $value, $arr_key, $arr_title, $property, $class, $blank_caption);
		$temp.="</td></tr>";
		
		return $temp;
	}
	
	function col_obj_combo($name, $value, $arr_key, $arr_title, $col_property="", $property="", $class="standard", $blank_caption="") {
		$temp="<td nowrap $col_property>";
		$temp.=$this->obj_combo($name, $value, $arr_key, $arr_title, $property, $class, $blank_caption);
		$temp.="</td>";
		
		return $temp;
	}
	
	function obj_combo($name, $value, $arr_key, $arr_title, $property="", $class="standard", $blank_caption="") {
		$temp = "<select class='$class' name='$name' $property onkeypress=\"return handleEnter(this, event)\">";
			
			if ($blank_caption<>"") {
				$temp.="<option value='' $tempsel>$blank_caption</option>";
			}
			
			for($i=0;$i<count($arr_key);$i++) {
				if($arr_key[$i]==$value) {
					$tempsel="selected";
				} else {
					$tempsel="";
				}
	
				$temp.="<option value=\"$arr_key[$i]\" $tempsel>" . $arr_title[$i] . "</option>";
			}				

			$temp.="</select>";
			
		return $temp;
	}

	function obj_combo_date($name, $date='0', $month='0', $year='0000', $property="") {
		$yearinterval=2;
		$tempname=$name."_d";

		if ($date=='0') { 
			$date=date("d");

			$val="00".$date;
			$val=substr($val,strlen($val)-2,2);
		}
		
		$tempcb="
			<select name='$tempname' style='font-family: Arial, Verdana; font-size: 9pt' $property
			onkeypress=\"return handleEnter(this, event)\">";

				for($i=1;$i<32;$i++) {
					if($i==$date) {
						$temp="selected";
					} else {
						$temp="";
					}
					
					$val="00".$i;
					$val=substr($val,strlen($val)-2,2);
					
					$tempcb.="<option value=\"$val\" $temp>" . $i . "</option>";
				}				
					
			$tempcb.="</select>";
		
		$tempname=$name."_m";
		if ($month=='0') {
			$month=date("m");
		
			$val="00".$month;
			$val=substr($val,strlen($val)-2,2);
		}
		$tempcb.="
			<select name='$tempname' style='font-family: Arial, Verdana; font-size: 9pt' $property
			onkeypress=\"return handleEnter(this, event)\">";

				for($i=1;$i<13;$i++) {
					if($i==$month) {
						$temp="selected";
					} else {
						$temp="";
					}

					$val="00".$i;
					$val=substr($val,strlen($val)-2,2);
					$tempcb.="<option value=\"$val\" $temp>" . date("F",mktime(0,0,0,$i,1,2006)) . "</option>";
				}				
					
			$tempcb.="</select>";

		$tempname=$name."_y";
		if ($year=='0000') { $year=date("Y"); }
		
		$tempcb.="
			<select name='$tempname' style='font-family: Arial, Verdana; font-size: 9pt' $property
			onkeypress=\"return handleEnter(this, event)\">";
			
				for($i=date("Y")-$yearinterval;$i<date("Y")+$yearinterval+1;$i++) {
					if($i==$year) {
						$temp="selected";
					} else {
						$temp="";
					}

					$tempcb.="<option value=\"$i\" $temp>" . $i . "</option>";
				}
					
			$tempcb.="</select>";
			
			return $tempcb;
	}

	function strencrypt($string) {
		return base64_encode($string);
	}

	function strdecrypt($string) {
		return base64_decode($string);
	}

	//ONLY FOR REPORT PAGE
	function rpt_set_align($fieldtype) {
		switch ($fieldtype) {
		case "string":
			$align="left";
			break;
		case "sumint":
		case "int":
		case "currency":
		case "sumcurrency":
			$align="right";
			break;
		case "date":
			$align="right";
			break;
		default:
			$align="left";
		}
		
		return $align;
	}

	function rpt_format_val($fieldtype, $value) {
		switch ($fieldtype) {
		case "string":
			$temp=$value;
			break;
		case "sumint":
		case "int":
			$temp=number_format($value,0,",",".");
			break;
		case "currency":
		case "sumcurrency":
			$temp=number_format($value,2,",",".");
			break;
		case "date":
			$temp=$value;
			break;
		default:
			$temp=$value;
		}
		
		return $temp;
	}

 	function rpt_label($caption, $value, $class="black", $label_property="width='70'", $value_property="width=''") {	
		$temp="
		<td nowrap $label_property align='left' style='padding:0in 4pt 0in 4pt'><label class='black'>$caption</label></td>
		<td nowrap width='20' align='center' style='padding:0in 4pt 0in 4pt'><label class='black'>:</label></td>
		<td nowrap width='200' $value_property><label class='$class'>$value</label></td>";
				
		return $temp;
	}

	function rpt_col($value,$border_format="0101",$fieldwidth="0",$fieldtype="string",$col_property="height='18'") {
		if ($fieldwidth<>"0") { $width="width='$fieldwidth'"; }
		if (strlen($value)==0) { $value="<o:p>&nbsp;</o:p>"; }
		if (strlen($border_format)<>0) {
			$left=substr($border_format,0,1);
			$right=substr($border_format,1,1);
			$top=substr($border_format,2,1);
			$bottom=substr($border_format,3,1);

			if ($left=="1") { $left="solid"; } else { $left="none"; }
			if ($right=="1") { $right="solid"; } else { $right="none"; }
			if ($top=="1") { $top="solid"; } else { $top="none"; }
			if ($bottom=="1") { $bottom="solid"; } else { $bottom="none"; }
		}
		
		$align=$this->rpt_set_align($fieldtype);
		
		return "<td align='$align' $width $col_property style='border-top:$top windowtext .5pt;border-left:$left windowtext .5pt;
		border-bottom:$bottom windowtext .5pt;border-right:$right windowtext .5pt; padding:0in 4pt 0in 4pt'><label class='black'>$value</label></td>";
	}

	function rpt_cell($value,$border_format="0101",$col_property="height='18'") {
		if ($fieldwidth<>"0") { $width="width='$fieldwidth'"; }
		if (strlen($value)==0) { $value="<o:p>&nbsp;</o:p>"; }
		if (strlen($border_format)<>0) {
			$left=substr($border_format,0,1);
			$right=substr($border_format,1,1);
			$top=substr($border_format,2,1);
			$bottom=substr($border_format,3,1);

			if ($left=="1") { $left="solid"; } else { $left="none"; }
			if ($right=="1") { $right="solid"; } else { $right="none"; }
			if ($top=="1") { $top="solid"; } else { $top="none"; }
			if ($bottom=="1") { $bottom="solid"; } else { $bottom="none"; }
		}
		
		return "<td $width $col_property style='border-top:$top windowtext .5pt;border-left:$left windowtext .5pt;
		border-bottom:$bottom windowtext .5pt;border-right:$right windowtext .5pt; padding:0in 4pt 0in 4pt'><label class='black'>$value</label></td>";
	}
	
	function report_view() {
		global $db;
		global $lg;
		
		$this->tag_contents="
		<table width='100%' align='center' border='0' cellpadding='0' cellspacing='0'>
		<tr height='25' bgcolor='#EFEEDF'>";

		$col_no=count($this->pv['arrfieldcaption']);
		
		for($i=0;$i<$col_no;$i++) {
			switch ($i) {
			case 0:
				$border_format="1111";
				break;
			case $col_no:
			default:
				$border_format="0111";
				break;
			}

			$this->tag_contents.=$this->rpt_col("<b>".$this->pv['arrfieldcaption'][$i]."</b>",$border_format,$this->pv['arrfieldwidth'][$i],$this->pv['arrfieldtype'][$i]);
		}

		$this->tag_contents.="</tr>";
		
			foreach ($db->conn->query($this->pv['query']) as $row) {
				$this->tag_contents.="<tr>";
			
					for($a=0;$a<$col_no;$a++) {
						switch ($a) {
						case 0:
							$border_format="1101";
							break;
						case $col_no:
						default:
							$border_format="0101";
							break;
						}
						
						$temp=$row[$a];
						$value=$this->rpt_format_val($this->pv['arrfieldtype'][$a], $temp);
						
						if ($this->pv['arrfieldtype'][$a]=="sumcurrency") {$this->pv['arrfieldsum'][$a]=$this->pv['arrfieldsum'][$a]+$row[$a];	}
						$this->tag_contents.=$this->rpt_col($value,$border_format,$this->pv['arrfieldwidth'][$a],$this->pv['arrfieldtype'][$a]);
					}
			
				$this->tag_contents.="</tr>";
			}

		$this->tag_contents.="<tr height='25' bgcolor='#EFEEDF'>";

			for($i=0;$i<$col_no;$i++) {
				switch ($i) {
				case 0:
					$border_format="1001";
					break;
				case $col_no-1:
					$border_format="0101";
					break;
				default:
					$border_format="0001";
					break;
				}

				if ($this->pv['arrfieldtype'][$i]=="sumcurrency") {
					$value=$this->rpt_format_val($this->pv['arrfieldtype'][$i], $this->pv['arrfieldsum'][$i]);
					$this->tag_contents.=$this->rpt_col("<b>$value</b>",$border_format,$this->pv['arrfieldwidth'][$i],$this->pv['arrfieldtype'][$i]);
				} else {
					$this->tag_contents.=$this->rpt_col("",$border_format,"0","string"); 
				}
			}
		
		$this->tag_contents.="</tr>";
		
		$this->tag_contents.="</table>";
	}
}
?>
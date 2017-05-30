<?php
class myPdoSql
{
	var $conn;
	var $vServer;
	var $vDatabase;
	var $vUserName;
	var $vPassword;
	var $vErrorMessage;
	
/*	function myPdoSql($server,$database,$username,$password) {
		$this->vServer=$server;
		$this->vDatabase=$database;
		$this->vUserName=$username;
		$this->vPassword=$password;
	}
	
	function connect() {
		try {
			$this->conn = new PDO("mysql:host=".$this->vServer.";dbname=".$this->vDatabase."", $this->vUserName, $this->vPassword);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			return true;
		} catch (PDOException $e) {
			$this->vErrorMessage=$e->getMessage();
			return false;
		}
	}
*/
	function myPdoSql($server,$database,$username,$password) {
		try {
			$this->conn = new PDO("mysql:host=".$server.";dbname=".$database."", $username, $password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			print "Error!: " . $e->getMessage() . "<br/>";
			die();
		}
	}
	
	function getErrorMessage() {
		return $this->vErrorMessage;
	}

	function close() {
		$this->conn = null;
	}

	function begin() {
		$this->conn->beginTransaction();
	}

	function commit() {
		$this->conn->commit();
	}

	function rollback() {
		$this->conn->rollBack();
	}

	function isRecordExist($tablename,$criteria) {
		$isexist=false;
		
		$query="select count(*) as rowcount from $tablename $criteria ";
		foreach ($this->conn->query($query) as $row) {
			if ($row['rowcount']>0) {
				$isexist=true;
				break;
			}
		}

		$row = null;
		return $isexist;
	}

	function isRecordExistByQuery($query) {
		$isexist=false;
		
		foreach ($this->conn->query($query) as $row) {
			$isexist=true;
			break;
		}

		$row = null;
		return $isexist;
	}
	
	function valFromKey($tablename, $fieldname, $field_key, $value) {
		$query = "select $fieldname as field_value from $tablename
			where $field_key = '". $value ."'";

		foreach ($this->conn->query($query) as $row) {
			$result=$row['field_value'];
		}
		
		return $result;
    }
   
   	function valFromQuery($queryString) {
		foreach ($this->conn->query($queryString) as $row) {
			$result=$row[0];
		}
		
		return $result;
    }
	
	function executeQuery($strQuery) {
		try {
			$this->conn->exec($strQuery);
			return true;
		} catch (Exception $e) {
			$this->vErrorMessage=$e->getMessage();
			return false;
		}
	}
	
	function insertAutoNumberLog($tableName, $syntaxID, $generatedID) {
		try {
			$strSQL="
			insert into tsysLog_auto_number (section_id, syntax_id, generated_id, dt_etr, user_etr, host_etr) values
			('".$tableName."', '".$syntaxID."', '".$generatedID."', now(), '".getSessionValue("securityLogin","userName")."', '".getSessionValue("securityLogin","hostName")."')";

			$this->conn->exec($strSQL);
			return true;
		} catch (Exception $e) {
			$this->vErrorMessage=$e->getMessage();
			return false;
		}
	}
	
	function insertAuditTrailLog($actionType, $actionDescription, $physicalTableName, $referenceID, $secondReferenceID, $queryScript) {
		try {
			$strSQL="
			insert into thr_log_audit_trail (action_type, action_description, physical_table_name, reference_id, second_reference_id, query_script, dt_etr, user_etr, host_etr) values
			('".$actionType."', '".$actionDescription."', '".$physicalTableName."', '".$referenceID."', '".$secondReferenceID."', '".str_replace("'","`",$queryScript)."', now(), '".getSessionValue("securityLogin","userName")."', '".getSessionValue("securityLogin","hostName")."')";
			
			$this->conn->exec($strSQL);
			return true;
		} catch (Exception $e) {
			$this->vErrorMessage=$e->getMessage();
			return false;
		}
	}
	
	function generateKey($tablename,$additional_string="",$additional_criteria="") {
		$currentdate=date("ym");

		switch ($tablename) {
		case "tmmkn_location":
			$no_of_trailing=5;
			$string=$currentdate;
			$query="select max(right(location_id,".$no_of_trailing.")) as max_id 
				from tmmkn_location where left(location_id,". strlen($string) .") = '".$string."'";
			break;
		case "tp_request":
		$currentdate=date("Ym");
			$no_of_trailing=4;
			$string="PU".$additional_string."-".$currentdate;
			$query="select max(right(request_id,".$no_of_trailing.")) as max_id 
				from tp_request where left(request_id,". strlen($string) .") = '".$string."'";
			break;
		case "tp_request2":
		$currentdate=date("Y");
			$no_of_trailing=3;
			$string=$additional_string.$currentdate;
			$query="select max(right(request_id,".$no_of_trailing.")) as max_id 
				from tp_request2 where left(request_id,". strlen($string) .") = '".$string."'";
			break;
/*		case "tp_request2":
		$currentdate=date("Ym");
			$no_of_trailing=4;
			$string="PU".$additional_string."-".$currentdate;
			$query="select max(right(request_id,".$no_of_trailing.")) as max_id 
				from tp_request2 where left(request_id,". strlen($string) .") = '".$string."'";
			break;
*/
		case "tm_propinsi":
		$currentdate=date("Ym");
			$no_of_trailing=3;
			$string="PRO".$additional_string."-".$currentdate;
			$query="select max(right(propinsi_id,".$no_of_trailing.")) as max_id 
				from tm_propinsi where left(propinsi_id,". strlen($string) .") = '".$string."'";
			break;

		case "tm_kabupaten_kota":
		$currentdate=date("Ym");
			$no_of_trailing=4;
			$string="KAB".$additional_string."-".$currentdate;
			$query="select max(right(kabupaten_kota_id,".$no_of_trailing.")) as max_id 
				from tm_kabupaten_kota where left(kabupaten_kota_id,". strlen($string) .") = '".$string."'";
			break;

		case "tm_target_group":
		$currentdate=date("Ym");
			$no_of_trailing=3;
			$string="TAR".$additional_string."-".$currentdate;
			$query="select max(right(target_id,".$no_of_trailing.")) as max_id 
				from tm_target_group where left(target_id,". strlen($string) .") = '".$string."'";
			break;

		case "tdtr_activation_master_history":
			$no_of_trailing=4;
			$string="MH".$additional_string."-".$currentdate;
			$query="select max(right(history_master_id,".$no_of_trailing.")) as max_id 
				from ".$tablename." where left(history_master_id,". strlen($string) .") = '".$string."'";
			break;

		case "tdtr_user_activation":
			$no_of_trailing=3;
			$string="USA".$additional_string."-".$currentdate;
			$query="select max(right(activation_id,".$no_of_trailing.")) as max_id 
				from ".$tablename." where left(activation_id,". strlen($string) .") = '".$string."'";
			break;
		case "tmmkn_service_gangguan":
			$no_of_trailing=4;
			$string="SG".$additional_string."-".$currentdate;
			$query="select max(right(service_gangguan_id,".$no_of_trailing.")) as max_id 
				from tmmkn_service_gangguan where left(service_gangguan_id,". strlen($string) .") = '".$string."'";
			break;
		case "tmkn_recovery_gangguan_wo_pm":
			$query="select max(my_id) as max_id from tmkn_recovery_gangguan_wo_pm";
			break;
		}
		foreach ($this->conn->query($query) as $row) {
			$id=$row['max_id']+1;
			if ($tablename == "tmkn_air_conditioner") {
				return $id;
			}elseif ($tablename == "tmkn_pm_device") {
				return $id;
			}elseif ($tablename == "tmkn_power_supply") {
				return $id;
			}elseif ($tablename == "tmkn_recovery_gangguan_wo_pm") {
				return $id;
			}
				$id=substr(($id+10000000000),11-$no_of_trailing,$no_of_trailing);
		}
		return $string.$id;
	}


	
}
?>
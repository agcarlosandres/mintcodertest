<?php
require 'connection.php';
switch($_POST["formAction"])
{
	case "insert":
	$attribute="";
	$values="";
		foreach($_POST as $attribute => $value){ 
			if($attribute!="formAction" &&  $attribute!="formTable" &&  $attribute!="button")
			{
				$attributes.=mysql_real_escape_string($attribute).",";
                if($value=="NOW()")$value=date("Y-m-d G:i:s");
                if(ereg("CHUCAMA12358456465",$value))$value=str_replace("CHUCAMA12358456465","&",$value);				
				$values.="'".mysql_real_escape_string($value)."',";
			}
		}
		$GLOBALS['daTable']->insRecord($_POST["formTable"],substr($attributes,0,strlen($attributes)-1),substr($values,0,strlen($values)-1));		
		break;
	case "update":
		
			foreach($_POST as $attribute => $value)
				{ 
				if($attribute!="formAction" &&  $attribute!="formTable" &&  $attribute!="button" &&  $attribute!="condition")
					{
					$value=str_replace("CHUCAMA12358456465","&",$value);
					$value=str_replace("NOW()",date("Y-m-d G:i:s"),$value);
					$sets.=mysql_real_escape_string($attribute)."='".mysql_real_escape_string($value)."',";
					}
				}
			
			$condition=mysql_real_escape_string($_POST["condition"]);
			$GLOBALS['daTable']->updRecords($_POST["formTable"],substr($sets,0,strlen($sets)-1),$condition);
		break;
		case "delete":
			$condition=mysql_real_escape_string($_POST["condition"]);
			$GLOBALS['daTable']->delRecords($_POST["formTable"],$condition);
		break;
}
print "OK";
exit(); 
?>
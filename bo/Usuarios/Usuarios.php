<?php
class Usuarios
{
    var $dataQuery=array();
    
    public function getUsuarios($usuarioId=false)
	{
		if($usuarioId)
		{
			global $daTable;
			unset($this->dataQuery);  
			$dataUsers=$daTable->fgetRecords("usuarios","*","id=$usuarioId","","nombre");
		}else{
			global $daTable;
			unset($this->dataQuery);  
			$dataUsers=$daTable->fgetRecords("usuarios","*","","nombre");
		}
		foreach ($dataUsers as $dataUser)
		{
			$this->dataQuery[]=$dataUser;
		}
	}

}
?>
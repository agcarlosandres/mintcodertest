<?php
	class DaTable {
			
		public function __construct() {

			
		}

		public function upError($errno,$error){
	
			echo '<script type="text/javascript" >alert("MySQL error '.$errno.': '.$error.'");</script>'; 
	
		}
		
		public function fblExist($table,$condition){
		
			$result = mysql_query('SELECT COUNT(*) FROM '.$table.' WHERE '.$condition);
			
			if(mysql_errno()){
					$this->upError(mysql_errno(),mysql_error()); 
					exit;
				}
			
			if(mysql_result($result, 0)){
				mysql_free_result($result);
				return true; 
			}else{
				mysql_free_result($result);
				return false; 
			}
			
		}
		
			
		
		public function fgetRecords($table,$atributes='*',$condition=false,$groupBy=false,$orderBy=false,$ord='',$limit=false){
					
			$sql = 'SELECT '.$atributes.' FROM '.$table;
										  
			
			if($condition)
				$sql=$sql.' WHERE '.$condition;
			
			if($groupBy)	
				$sql=$sql.' GROUP BY '.$groupBy ;
				
			if($orderBy)	
				$sql=$sql.' ORDER BY '.$orderBy.' '.$ord ;
			
			if($limit)	
			$sql=$sql.' LIMIT '.$limit ;
			
						
			$results=$GLOBALS['mysql']->results($sql);
			
			if(mysql_errno()){
					echo "\n Sql:".$sql;
					exit;
				}
			if($GLOBALS['mysql']->num_rows)
				{
					return $results;
				}
			return array();
			}
			
		public function fgetRecordsDistinct($table,$atributes='*',$condition=false,$groupBy=false,$orderBy=false,$ord='',$limit=false){
					
			$sql = 'SELECT DISTINCT'.$atributes.' FROM '.$table;
										  
			
			if($condition)
				$sql=$sql.' WHERE '.$condition;
			
			if($groupBy)	
				$sql=$sql.' GROUP BY '.$groupBy ;
				
			if($orderBy)	
				$sql=$sql.' ORDER BY '.$orderBy.' '.$ord ;
			
			if($limit)	
			$sql=$sql.' LIMIT '.$limit ;
			
						
			$results=$GLOBALS['mysql']->results($sql);
			
			if(mysql_errno()){
					echo "\n Sql:".$sql;
					exit;
				}
			if($GLOBALS['mysql']->num_rows)
				{
					return $results;
				}
			return array();
			}
				
		public function fgetRecordsDistinctInner($table,$atributes='*',$inner=false,$condition=false,$groupBy=false,$orderBy=false,$ord='',$limit=false){
					
			$sql = 'SELECT DISTINCT '.$atributes.' FROM '.$table;
										  
			
			if($inner)
				$sql=$sql." ".$inner;
			
			if($condition)
				$sql=$sql.' WHERE '.$condition;
			
			if($groupBy)	
				$sql=$sql.' GROUP BY '.$groupBy ;
				
			if($orderBy)	
				$sql=$sql.' ORDER BY '.$orderBy.' '.$ord ;
			
			if($limit)	
			$sql=$sql.' LIMIT '.$limit ;
			
						
			$results=$GLOBALS['mysql']->results($sql);
			
			if(mysql_errno()){
					echo "\n Sql:".$sql;
					exit;
				}
			if($GLOBALS['mysql']->num_rows)
				{
					return $results;
				}
			return array();
			}
				
		
		public function fgetRecordsIN($table,$atributes='*',$id,$values,$ord=false){
					
			$sql = 'SELECT '.$atributes.' FROM '.$table.' WHERE '.$id.' IN ('.$values.') ';
				
			
			
			if($ord)
				$sql=$sql.' ORDER BY '.$id. ' '.$ord;
				
				
			
			$result = mysql_query($sql);
			
			if(mysql_errno()){
					$this->upError(mysql_errno(),mysql_error()); 
					exit;
				}
			
			$i=0;
			
			while ($row[$i] = mysql_fetch_array($result, MYSQL_NUM))$i++;
			
			mysql_free_result($result);
			
			return $row;	
		}
		
		public function fgetRecordsBW($table,$atributes='*',$id,$inival,$lastval,$ord=false){
					
			$sql = 'SELECT '.$atributes.' FROM '.$table.' WHERE ('.$id.' BETWEEN '.$inival.' AND '.$lastval.')';
				
		
			if($ord)
				$sql=$sql.' ORDER BY '.$id. ' '.$ord;
				
				
			
			$result = mysql_query($sql);
			
			if(mysql_errno()){
					$this->upError(mysql_errno(),mysql_error()); 
					exit;
				}
			
			$i=0;
			
			while ($row[$i] = mysql_fetch_array($result, MYSQL_NUM))$i++;
			
			mysql_free_result($result);
			
			return $row;	
		}
		
		public function insRecord($tabla,$atributes,$values,$duplicate=false){
			
			$sql= 'INSERT INTO '.$tabla.' ( '.$atributes.' ) VALUES ( '.$values.' )';
			
			if($duplicate)
			{
				$sql.=' ON DUPLICATE KEY UPDATE '.$duplicate;
				
			}
			
			$GLOBALS['mysql']->query($sql);
			
			if(mysql_errno()){
					echo "\n Sql:".$sql;
					exit;
				}
			
		}
		
		public function delRecord($tabla,$id,$value){
					
			mysql_query('DELETE FROM '.$tabla.' WHERE '.$id.'='.$value);
			
			if(mysql_errno()){
					$this->upError(mysql_errno(),mysql_error()); 
					exit;
				}
			
		}
		
		public function delRecords($table,$condition=false){
					
			if($condition){
				$sql = 'DELETE FROM '.$table.' WHERE '.$condition;
			
				$GLOBALS['mysql']->query($sql);
			
				if(mysql_errno()){
					echo "\n Sql:".$sql;
					exit;
				}
			
			}
			
		}
		
		public function updRecord($tabla,$id,$lastValue,$newValue){
					
			mysql_query('UPDATE '.$tabla.' SET '.$id.'='.$newValue.' WHERE '.$id.'='.$lastValue);
			
			if(mysql_errno()){
					$this->upError(mysql_errno(),mysql_error()); 
					exit;
				}
			
			
						
		}
		
		public function updRecords($table,$sets=false,$condition=false){
					
			if($condition && $sets){
				
				$sql = 'UPDATE '.$table.' SET '.$sets.' WHERE '.$condition;
				
				$GLOBALS['mysql']->query($sql);
				//echo $sql;
				if(mysql_errno()){
					echo "\n Sql:".$sql;
					exit;
				}
			
						
			}
		}
		
		
} 

$daTable= new DaTable();

?>
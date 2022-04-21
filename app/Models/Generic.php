<?php

namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;

class Generic 
{
    protected $db;
	function __construct(ConnectionInterface &$db)
	{
        
        $this->db = &$db;
		# parent::__construct();
        # $this->db = \Config\Database::connect();
        // OR $this->db = db_connect();
	}
	function add($data, $tablename)
	{
		$status = $this->db->table($tablename)->insert($data);
		return $status;
	}
        
	function addbatch($data, $tablename)
	{
		// Perform the actual insertion
		$status = $this->db->table($tablename)->insertBatch($tablename, $data);
		return $status;
	}
	
	function edit($data, $id, $tablename)
	{
		//$status = $this->db->table($tablename)->where(array('id'=>$id))->update($data);
		$status = $this->db->table($tablename)->update($data, ['id' => $id]);
		return $status;
	}

	function editall($data, $tablename)
	{
		$status = $this->db->table($tablename)->update($data);
		return $status;
	}
	
	function editByConditions($data, $condition_array, $tablename)
	{
		// $this->db->where($condition_array);
		// $status = $this->db->update($tablename, $data);
		
		$status = $this->db->table($tablename)->update($data, $condition_array);
		return $status;
	}
	
	// Get all data from a table
	function getAll($tablename, $limit=NULL, $fieldlist=null, $createdat=null, $updatedat=null, $orderbyfield=null, $d_order='asc')
	{
		$dbtable = $this->db->table($tablename);

		if($fieldlist == null)
			$dbtable->select('*');
		else 
			$dbtable->select($fieldlist);
		
		// If limit is specified
		if($limit != NULL)
			$dbtable->limit(50, $limit);
		
		if($updatedat != NULL && $updatedat != '')
		{
			$updatedat = date("Y-m-d H:i:s", strtotime($updatedat));
			$dbtable->where(array("updatedat >" => $updatedat));
		}
		
		if($createdat != NULL && $createdat != '')
		{
			$createdat = date("Y-m-d H:i:s", strtotime($createdat));
			$dbtable->where(array("createdat >" => $createdat));
		}
		
		if($orderbyfield != NULL && $orderbyfield != '')
		{
			$dbtable->orderBy($orderbyfield, $d_order);
		}
		// Clause to only fetch data with deleted_at field set to null
		$dbtable->where(['isdeleted'=>0]);
		// Query result
		$query = $dbtable->get();
		if (count($query->getResultArray()) > 0) // OR ($dbtable->countAllResults() > 0)
			return $query->getResultArray();
		else
			return false;
	}
	
	// Get count of all records in a table
	function getCount($tablename)
	{
		$total = $this->db->table($tablename)
			->select('*')
			->where(array('deleted_at'=>null))
		  	->countAllResults();
		return $total;
	}
	
	function getAllCount($tablename)
	{
		$total = $this->db->table($tablename)->select('*')
		// Clause to only fetch data with deleted_at field set to null
		->where(array('deleted_at'=>null))->countAllResults();
		return $total;
	}

	// Get data from specified table by id column
	function getByID($id, $tablename, $fieldlist=null,$orderbyfield=null, $d_order='asc')
	{
		$dbtable = $this->db->table($tablename);

		if($fieldlist == null)
			$dbtable->select('*');
		else 
			$dbtable->select($fieldlist);
		// Clause to only fetch data with deleted_at field set to null
		$dbtable->where(array('deleted_at'=>null));
		$dbtable->where('id', $id);
		if($orderbyfield != NULL && $orderbyfield != '')
		{
			$dbtable->orderBy("$tablename.$ ", $d_order);
		}
		$query = $dbtable->get();
		if (count($query->getResultArray()) > 0) // OR ($dbtable->countAllResults() > 0)
			return $query->getResultArray();
		else
			return false;
	}
	
	// Get table data by specified field
	function getByField($fieldname, $fieldvalue, $tablename, $fieldlist=null, $createdat=null, $updatedat=null, $limit=NULL, $recordcount=50, $orderbyfield=null, $d_order='asc')
	{
		$dbtable = $this->db->table($tablename);

		if($fieldlist == null)
			$dbtable->select('*');
		else 
			$dbtable->select($fieldlist);
			
		$dbtable->where($fieldname, $fieldvalue);
		
		if($updatedat != NULL && trim($updatedat) != '')
		{
			$updatedat = date("Y-m-d H:i:s", strtotime($updatedat));
			$dbtable->where(array("$tablename.updated_at >" => $updatedat));
		}
		
		if($createdat != NULL && trim($createdat) != '')
		{
			$createdat = date("Y-m-d H:i:s", strtotime($createdat));
			$dbtable->where(array("$tablename.created_at >" => $createdat));
		}
		
		// If limit is specified
		if($limit != NULL && trim($limit) != '')
			$dbtable->limit($recordcount, $limit);
		
		// Clause to only fetch data with deleted_at field set to null
		$dbtable->where(['deleted_at'=>null]);
		
		$query = $dbtable->get();
		if (count($query->getResultArray()) > 0) // OR ($dbtable->countAllResults() > 0)
			return $query->getResultArray();
		else
			return false;
	}
	
	function getByFieldCount($fieldname, $fieldvalue, $tablename, $fieldlist=null, $createdat=null, $updatedat=null, $limit=NULL, $recordcount=50, $orderbyfield=null, $d_order='asc')
	{
		$dbtable = $this->db->table($tablename);

		if($fieldlist == null)
			$dbtable->select('*');
		else
			$dbtable->select($fieldlist);

		$dbtable->where($fieldname, $fieldvalue);
	
		if($updatedat != NULL && trim($updatedat) != '')
		{
			$updatedat = date("Y-m-d H:i:s", strtotime($updatedat));
			$dbtable->where(array("$tablename.updated_at >" => $updatedat));
		}
	
		if($createdat != NULL && trim($createdat) != '')
		{
			$createdat = date("Y-m-d H:i:s", strtotime($createdat));
			$dbtable->where(array("$tablename.created_at >" => $createdat));
		}
	
		// If limit is specified
		if($limit != NULL && trim($limit) != '')
			$dbtable->limit($recordcount, $limit);
	
		// Clause to only fetch data with deleted_at field set to null
		$dbtable->where(['deleted_at'=>null]);
		
		$total = $dbtable->countAllResults();
		return $total;
	}
	
	function getByFieldSingle($fieldname, $fieldvalue, $tablename, $fieldlist=null)
	{
		$dbtable = $this->db->table($tablename);

		if($fieldlist == null)
			$dbtable->select('*');
		else
			$dbtable->select($fieldlist);

		$dbtable->where($fieldname, $fieldvalue);
	
		// Clause to only fetch data with deleted_at field set to null
		$dbtable->where(['deleted_at'=>null]);
		$query = $dbtable->get()->getRowArray(); //$query = $dbtable->get()->getRowArray();
		if (isset($query) ) // OR ($dbtable->countAllResults() > 0)
			return $query;
		else
			return false;
			
	}
	
	// Get count of all records in a table
	function getCountByField($fieldname=null, $fieldvalue=null, $tablename=null)
	{
		$dbtable = $this->db->table($tablename);

		$dbtable->select('*');
		if($fieldname == null && $fieldvalue == null )
		{}
		else
		{
			$dbtable->where($fieldname, $fieldvalue);
		}
		// Clause to only fetch data with deleted_at field set to null
		$total = $dbtable->where(['deleted_at'=>null])->countAllResults();
		return $total;
	}

	function getCountByCondition($condition_array, $tablename)
	{
		$dbtable = $this->db->table($tablename);

		$dbtable->select('*');
		$dbtable->where($condition_array);
		// Clause to only fetch data with deleted_at field set to null
		$total = $dbtable->where(['deleted_at'=>null])->countAllResults();
		return $total;
	}
	
	// Delete specified table record by id
	function deleteData($id, $tablename,$real=null)
	{
		$dbtable = $this->db->table($tablename);
		
		//$dbtable->where(array('id'=>$id));
		if($real==1)
		{
			$status = $dbtable->delete(['id' => $id]);
		}
		else
		{
        	$status = $dbtable->update(['deleted_at'=>date("Y-m-d H:i:s")],['id' => $id]);
        }
		return $status;
	}

	function deleteByCondition($condition_array, $tablename,$real=null)
	{
		$dbtable = $this->db->table($tablename);
		
		$dbtable->where($condition_array);
        if($real==1)
		{
			$status = $dbtable->delete();
		}
		else
		{
        	$status = $dbtable->update(['deleted_at'=>date("Y-m-d H:i:s")]);
        }
		return $status;
	}

	
	// Function to find duplicated data
	function findDuplicate($condition_array, $tablename)
	{
		$dbtable = $this->db->table($tablename);

		$dbtable->select('*');
		$dbtable->where($condition_array);
		// Clause to only fetch data with deleted_at field set to null
		$dbtable->where(['deleted_at'=>null]);
		$query = $dbtable->get();
		if (count($query->getResultArray()) > 0) // OR ($dbtable->countAllResults() > 0)
			return $query->getResultArray();
		else
			return false;
	}
	
	function findByCondition($condition_array, $tablename, $orderbyfield=null, $d_order='asc')
	{
		$dbtable = $this->db->table($tablename);

		$dbtable->select('*');
		$dbtable->where($condition_array);
		// Clause to only fetch data with deleted_at field set to null
		$dbtable->where(['deleted_at'=>null]);
		
		if($orderbyfield != NULL && $orderbyfield != '')
			$dbtable->orderBy("$tablename.$orderbyfield", $d_order);
		
		$query = $dbtable->get();
		if (count($query->getResultArray()) > 0) // OR ($dbtable->countAllResults() > 0)
			return $query->getResultArray();
		else
			return false;
	}
        
    public function getrowid($data,$tablename) 
    {    
		$dbtable = $this->db->table($tablename);

        $_id = $dbtable->getWhere($data)->getResultArray(); 
        if($_id == TRUE) { return $_id['id']; }
        else {return FALSE; }
    }
}

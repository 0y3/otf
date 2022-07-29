<?php

namespace App\Models;

use CodeIgniter\Model;

class DeliveryLocationsModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'delivery_locations';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['fee','city_id','state_id','status','isdeleted'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function getDeliveryLocate(){
        $data   =   $this->select('delivery_locations.*, state_cities.city_name, states.state_name')
                        ->join('state_cities', 'delivery_locations.city_id = state_cities.id', 'left')
                        ->join('states', 'delivery_locations.state_id = states.id', 'left')
                        ->orderBy('state_name ASC, city_name ASC')
                        ->findAll();
        return $data;
    }
}

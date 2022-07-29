<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = '\App\Entities\UserEntity';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['surname','firstname','gender','phone','email','password','activation_code','status','isdeleted'];

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


    public function OrderCount_($cate_id)
    {
        $Order = new \App\Models\OrderModel(); // ->asArray()
        $data_ = $Order->asObject()->where(['isdeleted' => 0, 'status' => 1, "user_id" => $cate_id])
            ->countAllResults();

       return $data_;
    }

    public function UserAndOrder_()
	{
		$data_ = [];
		$categories = $this->asArray()->where('isdeleted', 0)
			->orderBy('created_at', 'desc')
			->findAll();

		if (count($categories) > 0) {
            foreach ($categories as $key => $category) {
                $category['ordercount'] = $this->OrderCount_($category['id']);
                $data_[] = $category;
            }
		}

		return $data_;
	}
}

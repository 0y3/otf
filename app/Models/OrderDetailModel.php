<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderDetailModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'order_details';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'order_code',
                                    'order_id',
                                    'biz_id',
                                    'biz_menu_id',
                                    'name',
                                    'quantity',
                                    'price',
                                    'addup_menu',
                                    'grant_total',
                                    'order_status',
                                    'status',
                                    'isdeleted'
                                ];

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


    const pending = 'Pending';
	const processing = 'Processing';
    const dispatched = 'Dispatched';
    const delivered =  'Delivered';
    const canceled = 'Canceled';

	const TYPES = [
		self::pending => 'Pending',
		self::processing => 'Processing',
        self::dispatched =>  'Dispatched',
        self::delivered => 'Delivered',
        self::canceled => 'Canceled',
	];


    protected function generateOrderId(array $data)
	{
		$code = 'ORD-'.strtoupper(generate_random_string(12));

		$data = $this->where('order_code', $code)->first();
		if ($data) {
			$code = 'ORD-'.strtoupper(substr(uniqid(sha1(time())),0,12));
		}

		$data['data']['order_code'] = $code;

		return $data;
	}


    public static function getOrderStatusDropdown()
	{
		$types = array_merge(
			[
				'' => '-- Set Order Status --'
			],
			self::TYPES
		);
		return $types;
	}
}
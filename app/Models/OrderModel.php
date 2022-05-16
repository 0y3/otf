<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = '\App\Entities\OrderEntity';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'user_id',
                                    'reference',
                                    'biz_id',
                                    'user_address_id',
                                    'couponcode',
                                    'discount',
                                    'total_order',
                                    'delivery_fee',
                                    'payment_type',
                                    'grand_total',
                                    'order_status',
                                    'status',
                                    'delivered_at',
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

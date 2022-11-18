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
                                    'pi_id','pi_reference','pi_paid_at','pi_channel',
                                    'pi_last4','pi_card_type','pi_authorization_code',
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

    public function orderJoins_()
    {
        $data_ = [];
		$categories = $this->asArray()
                    ->where(['status' => 1, 'isdeleted' => 0])
                    ->orderBy('pi_paid_at DESC','id')
                    ->findAll();

        if (count($categories) > 0) {
            foreach ($categories as $key => $category) {
                $category['biz_details'] = $this->bizDetails_($category['biz_id']);
                $category['user_details'] = $this->userDetails_($category['user_id']);
                $category['order_details'] = $this->OrderDetails_($category['id']);
                $data_[] = $category;
            }
        }

        return $data_;
    }
    public function bizDetails_($id=null)
    {
        $data_ = (new BizModel)->where(['isdeleted' => 0,'id' => $id])->first();
        return $data_;
    }

    public function userDetails_($id=null)
    {
        $data_ = (new UserModel)->where(['isdeleted' => 0,'id' => $id])->first();
        return $data_;
    }
    public function orderDetails_($id=null)
    {
        $data_ = (new OrderDetailModel) 
                ->where(['isdeleted' => 0,'order_id' => $id])
                ->orderBy('id ASC')
                ->findAll();

       return $data_;
    }
}

<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class UserEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    const filter = [
        'isdeleted'     =>0
    ];
    protected $biz;
    protected $order;
    protected $orderDetails;
    protected $userAddress;

    public function __construct()
    {
        $this->biz              = model('BizModel');
        $this->order            = model('OrderModel');
        $this->orderDetails     = model('OrderDetailModel');
        $this->userAddress      = model('UserAddressModel');
    }

    public function getAddress()
    {
        $data_ = $this->userAddress
                    ->select('user_address.*, state_cities.city_name, states.state_name, states.code as state_code')
                    ->join('state_cities', 'user_address.city_id = state_cities.id', 'left')
                    ->join('states', 'user_address.state_id = states.id', 'left')
                    ->where('user_address.id', $this->id)
                    ->findAll();

        return $data_;
    }

    public function getAllOrders()
    {
        $data_ = [];
        $categories = $this->order->asArray()
                    ->select('orders.*, bizs.name as biz_name, bizs.slug as biz_slug, bizs.biz_type ')
                    ->join('bizs', 'bizs.id = orders.biz_id', 'left')
                    ->where(['orders.user_id' => $this->id, 'orders.status' => 1, 'orders.isdeleted' => 0])
                    ->orderBy('id ASC')
                    ->findAll();
        if (count($categories) > 0) {

            foreach ($categories as $key => $category) {
                $category['order_details'] = $this->setOrderDetails($category['id']);
                $data_[] = $category;
            }
        }

       return $data_;
    }

    public function setOrderDetails($id=null)
    {
        $data_ = $this->orderDetails
            ->where(self::filter)
            ->where(['order_id' => $id])
            ->orderBy('id ASC')
            ->findAll();

       return $data_;
    }
}

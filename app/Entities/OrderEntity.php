<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class OrderEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    const filter = [
        'status'        => 1,
        'isdeleted'     =>0
    ];
    protected $biz;
    protected $orderDetails;
    protected $userAddress;

    public function __construct()
    {
        $this->biz              = model('BizModel');
        $this->orderDetails     = model('OrderDetailModel');
        $this->userAddress      = model('UserAddressModel');
    }

    public function full_name(){
        return $this->attributes['biz_id']. " ".$this->attributes['reference'];
    }
    public function getBiz()
    {
        $data_ = $this->biz
            ->where(['id' => $this->biz_id] )
            ->first();

       return $data_;
    }

    public function getUserAddress()
    {
        $data_ = $this->userAddress
                    ->select('user_address.*, state_cities.city_name, states.state_name')
                    ->join('state_cities', 'user_address.city_id = state_cities.id', 'left')
                    ->join('states', 'user_address.state_id = states.id', 'left')
                    ->where('user_address.id', $this->user_address_id)
                    ->first();

        return $data_;
    }

    public function getOrderDetails()
    {
        $data_ = $this->orderDetails
            ->where(self::filter)
            ->where(['order_id' => $this->id])
            ->orderBy('id ASC')
            ->findAll();

       return $data_;
    }
}
<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\StateModel;

class BizEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    const filter = [
        'status'        => 1,
        'isdeleted'     =>0
    ];
    protected $Menus;
    protected $MenusCate;

    public function __construct()
    {
        $this->Menus     = model('BizMenuModel');
        $this->MenusCate = model('BizMenuCategoryModel');
        $this->states    = model('StateModel');
        $this->cities    = model('StateCityModel');
    }

    public function full_name(){
        return $this->attributes['name']. " ".$this->attributes['slug'];
    }
    public function getCategories()
    {
        $data_ = $this->MenusCate
            //->where(self::filter)
            ->where(['biz_id' => $this->id] )
            //->orderBy('sort ASC','id')
            ->findAll();

       return $data_;
    }

    public function getMenus()
    {
        $data_ = $this->Menus
            //->where(self::filter)
            ->where(['biz_id' => $this->id])
            //->orderBy('sort ASC','id')
            ->findAll();

       return $data_;
    }

    public function setMenus($cate_id)
    {
        $data_ = $this->Menus
           // ->where(self::filter)
            ->where(['biz_id' => $this->id, "biz_menu_category_id" => $cate_id])
            //->orderBy('sort ASC','id')
            ->findAll();

       return $data_;
    }

    public function geCategoryByMenus()
    {
        $data_ = [];
        $categories = $this->MenusCate
           // ->where(self::filter)
            ->where( ['biz_id' => $this->id] )
           // ->orderBy('sort ASC','id')
            ->findAll();
        

       return $data_;
    }

    public function NestedCategories($level = 0)
	{
		$data_= [];
		$categories = $this->MenusCate->where('menu_parent_id', $level)
                            ->where(self::filter)
                            ->where( ['biz_id' => $this->id] )
                            ->orderBy('sort ASC','id')
                            ->findAll();

		if (count($categories) > 0) {

			foreach ($categories as $key => $category) {
				$category['menu'] = $this->setMenus($category['id']);
				$category['children'] = $this->NestedCategories($category['id']);
				$data_[] = $category;
			}
		}

		return $data_;
	}
}

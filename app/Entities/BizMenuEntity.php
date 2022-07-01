<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class BizMenuEntity extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    const filter = [
        'status'        => 1,
        'isdeleted'     =>0
    ];
    protected $MenusAddup;
    protected $MenusAddupCate;

    public function __construct()
    {
        $this->MenusAddup       = model('BizMenuAddupModel');
        $this->MenusAddupCate   = model('BizMenuAddupCategoryModel');
    }

    public function getAddupCategories()
    {
        
        $data_ = $this->MenusAddupCate
                    ->where(self::filter)
                    ->where('biz_menu_id', $this->id)
                    ->orderBy('sort ASC','id')
                    ->findAll();

       return $data_;
    }
    public function setaddMenus($cate_id)
    {
        $data_ = $this->MenusAddup
                      ->where(self::filter)
                      ->where(['biz_menu_addup_category_id' => $cate_id])
                      ->orderBy('sort ASC','id')
                      ->findAll();
        return $data_;
    }
    public function getAddupCateMenu()
	{
		$data_= [];
		$categories = $this->getAddupCategories();

		if (count($categories) > 0) {

			foreach ($categories as $key => $category) {
				$category['addupMenus'] = $this->setaddMenus($category['id']);
				$data_[] = $category;
			}
		}

		return $data_;
	}

}

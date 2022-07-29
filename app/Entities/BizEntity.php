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
    protected $MenusAddup;
    protected $MenusAddupCate;

    public function __construct()
    {
        $this->Menus     = model('BizMenuModel');
        $this->MenusCate = model('BizMenuCategoryModel');
        $this->states    = model('StateModel');
        $this->cities    = model('StateCityModel');
        $this->MenusAddup       = model('BizMenuAddupModel');
        $this->MenusAddupCate   = model('BizMenuAddupCategoryModel');
    }

    public function full_name(){
        return $this->attributes['name']. " ".$this->attributes['slug'];
    }
    public function getCategories()
    {
        $data_ = $this->MenusCate
            //->where(self::filter)
            ->where(['biz_id' => $this->id,'isdeleted' => 0] )
            //->orderBy('sort ASC','id')
            ->findAll();

       return $data_;
    }

    public function getMenus()
    {
        $data_ = $this->Menus->asArray()
            ->select('biz_menus.*, biz_menu_categories.name as category_name,  biz_menu_categories.status as catestatus')
            //->where(self::filter)
            ->join('biz_menu_categories', 'biz_menus.biz_menu_category_id = biz_menu_categories.id', 'left')
            ->where(['biz_menus.biz_id' => $this->id, 'biz_menus.isdeleted' => 0])
            ->orderBy('biz_menus.created_at','DESC')
            // ->orderBy('sort ASC','id')
            ->findAll();

       return $data_;
    }

    public function getMenusCounts()
    {
        $data_ = $this->Menus
            ->select('biz_menus.*, biz_menu_categories.name as category_name')
            ->where(['biz_menus.biz_id' => $this->id, 'biz_menus.isdeleted' => 0])
            ->countAllResults();

       return $data_;
    }

    public function setaddMenusJoin($id=null)
    {
        // print("<pre>".print_r(json_encode($biz_id,JSON_PRETTY_PRINT),true)."</pre>");die;
        $data_ = $this->MenusAddup
                      ->select('biz_menu_addups.*, biz_menu_addup_categories.name as addup_category_name, biz_menu_addup_categories.biz_menu_id')
                      ->join('biz_menu_addup_categories', 'biz_menu_addups.biz_menu_addup_category_id = biz_menu_addup_categories.id', 'left')
                      ->where(['biz_menu_addup_categories.biz_menu_id' => $id, 'biz_menu_addup_categories.isdeleted' => 0 ])
                      ->orderBy('biz_menu_addups.sort ASC','biz_menu_addups.id')
                      ->findAll();
        return $data_;
    }

    public function addMenusJoinCount($id=null)
    {
        $data_ = $this->MenusAddup
                    ->select('biz_menu_addups.*, biz_menu_addup_categories.name as addup_category_name, biz_menu_addup_categories.biz_menu_id')
                    ->join('biz_menu_addup_categories', 'biz_menu_addups.biz_menu_addup_category_id = biz_menu_addup_categories.id', 'left')
                    ->where(['biz_menu_addup_categories.biz_menu_id' => $id, 'biz_menu_addup_categories.isdeleted' => 0 ])
                    ->countAllResults();

       return $data_;
    }
    
    public function getMenuAndAddupMenus()
    {
        $data_ = [];
        $categories = $this->getMenus();
        if (count($categories) > 0) {

            foreach ($categories as $key => $category) {
                $category['addupMenusCounts'] = $this->addMenusJoinCount($category['id']);
				$category['addupMenus'] = $this->setaddMenusJoin($category['id']);
                $data_[] = $category;
            }
        }
        // print("<pre>".print_r(($categories),true)."</pre>");die;
       return $data_;
    }

    public function setAddMenus($cate_id)
    {
        $data_ = $this->MenusAddup
                      ->where(['biz_menu_addup_category_id' => $cate_id, 'isdeleted' => 0])
                      ->orderBy('sort ASC','id')
                      ->findAll();
        return $data_;
    }

    public function setAddupCategories($id=null)
    {
        $data_ = [];
        $categories = $this->MenusAddupCate//->asArray()
                    ->where('isdeleted',0)
                    ->where('biz_menu_id', $id)
                    ->orderBy('sort ASC','id')
                    ->findAll();
        if (count($categories) > 0) {

            foreach ($categories as $key => $category) {
                $category['addupMenus'] = $this->setAddMenus($category['id']);
                $data_[] = $category;
            }
        }

       return $data_;
    }
    public function getMenuAndAddupCateMenu()
    {
        $data_ = [];
        $categories = $this->getMenus();
        if (count($categories) > 0) {

            foreach ($categories as $key => $category) {
				$category['addupCate'] = $this->setAddupCategories($category['id']);
                $data_[] = $category;
            }
        }
        // print("<pre>".print_r(($categories),true)."</pre>");die;
       return $data_;
    }

    public function setMenusByCategory($cate_id)
    {
        // print("<pre>".print_r(($cate_id),true)."</pre>");die;
        $data_ = $this->Menus
            ->where(self::filter)
            ->where(['biz_id' => $this->id, "biz_menu_category_id" => $cate_id])
            ->orderBy('sort ASC','id')
            ->findAll();

       return $data_;
    }

    public function getMenusCount()
    {
        $data_ = $this->Menus
            ->where(self::filter)
            ->where(['biz_id' => $this->id, 'isdeleted' => 0])
            //->orderBy('sort ASC','id')
            ->countAllResults();

       return $data_;
    }

    public function setMenusCount($cate_id)
    {
        $data_ = $this->Menus
            ->where(self::filter)
            ->where(['biz_id' => $this->id, "biz_menu_category_id" => $cate_id])
            //->orderBy('sort ASC','id')
            ->countAllResults();

       return $data_;
    }

    public function getCategoryAndMenus()
    {
        $data_ = [];
        $categories = $this->MenusCate
            ->where( ['biz_id' => $this->id] )
            ->orderBy('sort ASC','id')
            ->findAll();
        if (count($categories) > 0) {

            foreach ($categories as $key => $category) {
                $category['menucount'] = $this->setMenusCount($category['id']);
                $category['menu'] = $this->setMenusByCategory($category['id']);
                $data_[] = $category;
            }
        }

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
                $category['menucount'] = $this->setMenusCount($category['id']);
				$category['menu'] = $this->setMenusByCategory($category['id']);
				$category['children'] = $this->NestedCategories($category['id']);
				$data_[] = $category;
			}
		}

		return $data_;
	}
    
    public function setCategoryListCount($cate_id)
    {
        $data_ = $this->MenusCate
                    ->where(['biz_id' => $this->id, "menu_parent_id" => $cate_id])
                    ->countAllResults();

       return $data_;
    }

    public function CategoryList($level = 0)
	{
		$data_= [];
		$categories = $this->MenusCate->where('menu_parent_id', $level)
                            ->where(self::filter)
                            ->where( ['biz_id' => $this->id] )
                            ->orderBy('sort ASC','id')
                            ->findAll();

		if (count($categories) > 0) {

			foreach ($categories as $key => $category) {
                $category['menucount'] = $this->setMenusCount($category['id']);
                $category['childrencount'] = $this->setCategoryListCount($category['id']);
				$category['children'] = $this->CategoryList($category['id']);
				$data_[] = $category;
			}
		}

		return $data_;
	}

}

<?php

namespace App\Models;

use CodeIgniter\Model;

class BizMenuCategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'biz_menu_categories';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['biz_id','slug','name','menu_parent_id','image','sort','status','isdeleted'];

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
    protected $beforeInsert   = ['generateSlug'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    const filter = [
        'status'        => 1,
        'isdeleted'     =>0
    ];


    protected function generateSlug(array $data)
	{
		$slug = url_title($data['data']['name'], '-', true);
		$name = trim($data['data']['name']);

		$data = $this->where('slug', $slug)->orderBy('id', 'DESC')->first();
		if ($data) {
			$slugs = explode('-', $data->slug);
			$slugNumber = !(empty($slugs[1])) ? ((int)$slugs[1] + 1) : 1;
			$slug = $slug. '-' .$slugNumber;
		}

		$data['data']['slug'] = $slug;

		return $data;
	}
    public function getParentOptions($exceptCategoryId = null)
	{
		$categories = [];

		$menuCategoryModel = $this;
		if ($exceptCategoryId) {
			$menuCategoryModel->where('id !=', $exceptCategoryId);
		}

        if ($results = $menuCategoryModel->findAll()) {
            foreach ($results as $result) {
                $categories[] = [
                    'id' => $result->id,
                    'name' => $result->name,
                    'slug' => $result->slug,
                    'menu_parent_id' => $result->parent_id,
                    'image'     =>  $result->image,
                    'created_at' => $result->created_at,
                    'updated_at' => $result->updated_at,
                ];
            }
		}

		return $categories;
	}
    public function getNestedCategories($level = 0)
	{
        
		$results = [];
		$categories = $this->where(self::filter,['parent_id'=> $level])
			->orderBy('sort', 'asc')
			->findAll();

		if (count($categories) > 0) {
			foreach ($categories as $key => $category) {
				$results[$key] = $category->toArray();
				$results[$key]['children'] = $this->getNestedCategories($category->id);
			}
		}

		return $results;
	}
}

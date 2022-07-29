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
    protected $beforeUpdate   = ['updateSlug'];
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
        // print("<pre>".print_r($data,true)."</pre>");die;
		$slug = url_title($data['data']['name'], '_', true);
        
		$getcheck = $this->where('slug', $slug)->first();
		if ($getcheck) {
			$slugs = explode('_', $getcheck['slug']);
			$slugNumber = !(empty($slugs[1])) ? ((int)$slugs[1] + 1) : 1;
			$slug = $slug. '_' .$slugNumber;
		}

		$data['data']['slug'] = $slug;
		return $data;
	}

    protected function updateSlug(array $data)
	{
        // print("<pre>".print_r($data['id'][0],true)."</pre>");die;
        $id = $data['id'][0];
        if(isset($data['data']['name'])){

           
            $name = $data['data']['name'];
            $slug = url_title($name, '_', true);

            $getcheck = $this->where(['slug' => $slug, 'id !=' => $id])->first();
            if ($getcheck) { // if slug exist
                $slugs = explode('_', $getcheck['slug']);
                $slugNumber = !(empty($slugs[1])) ? ((int)$slugs[1] + 1) : 1;
                $slug = $slug. '_' .$slugNumber;
                
            }

            $data['data']['slug'] = $slug;
           
        }
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

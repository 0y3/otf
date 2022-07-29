<?php

namespace App\Models;

use CodeIgniter\Model;

class BizMenuModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'biz_menus';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = '\App\Entities\BizMenuEntity';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'biz_id',
                                    'biz_menu_category_id',
                                    'slug',
                                    'name',
                                    'description',
                                    'price',
                                    'image',
                                    'menu_parent_id',
                                    'sort',
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
    protected $beforeInsert   = ['generateSlug'];
    protected $afterInsert    = [];
    protected $beforeUpdate   = ['updateSlug'];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];


    protected $db_addupmenu           = 'biz_menu_addups';
    protected $db_addupmenu_cate      = 'biz_menu_addup_categories';
    protected function generateSlug(array $data)
	{
        // print("<pre>".print_r($data,true)."</pre>");die;
		$slug = url_title($data['data']['name'], '_', true);
		$name = trim($data['data']['name']);

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
        //log_message("info", "Running method before update ". json_encode($data));
        log_message('info','Running BizMenu method before update -: '. json_encode($id));
    }

    protected function generateSlugDb($db,$data)
	{
        // print("<pre>".print_r($data,true)."</pre>");die;
		$slug = url_title($data, '_', true);

		$getcheck = $this->db->table($db)->where('slug', $slug)->get()->getRowArray();
		if ($getcheck) {
			$slugs = explode('_', $getcheck['slug']);
			$slugNumber = !(empty($slugs[1])) ? ((int)$slugs[1] + 1) : 1;
			$slug = $slug. '_' .$slugNumber;
		}

		$data = $slug;
		return $data;
	}

    function insertRestMenus($bizId,$list,$menuImage)
    {
		$this->db->transBegin();
		// print("<pre>".print_r($list,true)."</pre>");die;

        /* Save to db biz_menus*/
        $menu = [
            'biz_id'        => $bizId,
            'biz_menu_category_id'  => $list['category'],
            'slug'          => $this->generateSlugDb($this->table,$list['name']),
            'name'          => $list['name'],
            'description'   => $list['desc'],
            'price'         => $list['price'],
            'image'         => $menuImage,
            'status'        => $list['status'],
        ];

        $this->db->table($this->table)->insert($menu);
		$id = $this->db->insertID();

        /* Save to db biz_menu_addup_categories*/

        foreach ($list['addup_menu_repeater_outer'] as $key => $addUpCtgy) {
            $addup_cate = [
                'biz_id'        => $bizId,
                'biz_menu_id'   => $id,
                'name'          => $addUpCtgy['addupctgy'],
                'addup_type'    => $addUpCtgy['adduptype'],
            ];

            $this->db->table($this->db_addupmenu_cate)->insert($addup_cate);
		    $id_addupMenuCate = $this->db->insertID();

            /* Save to db biz_menu_addups*/
            foreach($addUpCtgy['addup_menu_repeater_inner'] as $key2 => $addupMenu)
            {
                $addup_menu = [
                    'biz_id'        => $bizId, 
                    'biz_menu_id'   => $id,
                    'biz_menu_addup_category_id' => $id_addupMenuCate,
                    'name'          => $addupMenu['addupname'],
                    'price'         => $addupMenu['addupprice'],
                ]; 
                $this->db->table($this->db_addupmenu)->insert($addup_menu);
            }
        }
		
		if ($this->db->transStatus() === FALSE)	{
			$this->db->transRollback();
			
			return false;
		} else {
			$this->db->transCommit();
			
			return true;
		}
	}
	
	// function update_user($account_id, $user_name, $info_id, $full_name) {
	// 	$this->db->transStart();
		
	// 	$data_account = array(
	// 		'user_name' => $user_name
	// 	);
		
	// 	$this->db->table($this->table_account)->where('account_id', $account_id)->update($data_account);
		
	// 	$data_info = array(
	// 		'full_name' => $full_name
	// 	);
		
	// 	$this->db->table($this->table_info)->where('info_id', $info_id)->update($data_info);
		
	// 	$this->db->transComplete();

	// 	if ($this->db->transStatus() === FALSE) {
	// 		return false;
	// 	}
		
	// 	return true;
	// }
	
	// function delete_user($account_id, $info_id) {
	// 	$this->db->transStart();
		
	// 	$this->db->table($this->table_info)->where('info_id', $info_id)->delete();
		
	// 	$this->db->table($this->table_account)->where('account_id', $account_id)->delete();		
		
	// 	$this->db->transComplete();

	// 	if ($this->db->transStatus() === FALSE) {
	// 		return false;
	// 	}
		
	// 	return true;
	// }

}

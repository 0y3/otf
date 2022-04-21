<?php

namespace App\Models;

use CodeIgniter\Model;

class BizModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'bizs';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = '\App\Entities\BizEntity';
    protected $useSoftDeletes   = true;
    protected $protectFields    = true;
    protected $allowedFields    = [
                                    'slug',
                                    'name',
                                    'biz_type',
                                    'description',
                                    'logo',
                                    'image',
                                    'phone',
                                    'email',
                                    'address',
                                    'city_id',
                                    'state_id',
                                    'latitude',
                                    'longitude',
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


    const restaurant = 'restaurant';
	const grocery = 'grocery';
    const party ="party";

	const TYPES = [
		self::restaurant => 'restaurant',
		self::grocery => 'grocery',
        self::party =>  'party',
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

    protected function updateSlug(array $data)
	{
        $id=$data['id'];
        //log_message("info", "Running method before update ". json_encode($data));
        log_message('info','Running method before update'. json_encode($id));

        return $data;
        /*
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
        */
	}

    public static function getBizTypesDropdown()
	{
		$types = array_merge(
			[
				'' => '-- Set Biz type --'
			],
			self::TYPES
		);
		return $types;
	}
}

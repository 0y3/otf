<?php

namespace App\Controllers\Api;

use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Cookie\Cookie;
use Config\Services;

class BizController extends ResourceController
{
    /**
     * Return an array of resource objects, themselves in array format
     *
     * @return mixed
     */
    use ResponseTrait;
    const filter = [
        'status'        => 1,
        'isdeleted'     =>0
    ];

    protected $request;
    function __construct()
    {
        helper(['form', 'url','email','cookie','array']);
        $this->request      = service('request');
        $this->session      = service('session'); # or \Config\Services::session();
        $this->biz         = model('BizModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->bizMenus     = model('BizMenuModel');
        $this->bizMenusCate     = model('BizMenuCategoryModel');
        $this->bizMenusAddup     = model('BizMenuAddupModel');
        $this->bizMenusAddupCate     = model('BizMenuAddupCategoryModel');
        $this->stateModel =  model('StateModel');
        $this->cityModel =  model('StateCityModel');

        $this->data['state'] = $this->getStates();
        $this->data['city'] = $this->getCity();

        
    }

    public function index()
    {

        $bizs = $this->biz
                ->where(self::filter)
                ->orderBy('id')
                ->paginate(20);
        $this->biz->pager->setPath('api/bizs'); //customiz pagination url

        $response = [
            'status'    => 200,
            'error'     => false,
            'message'   => 'Biz Lists',
            'data'      => [
                'biz'  => $bizs,
                'pagerhas'  => $this->biz->pager->hasMore(),
                'pagercount' => $this->biz->pager->getPageCount(),
                'pager'     => $this->biz->pager->links(),
                'pagerurl'  => $this->biz->pager->getPageURI(),
            ]
        ];
        
        // $this->cachePage(60); // 60 seconds

        return $this->respondCreated($response);
    }

    /**
     * Return the properties of a resource object
     *
     * @return mixed
     */
    public function show($slug = null)
    {
        if ($slug === false) {
            return $this->index();
        }
        if(is_numeric($slug)){
            $where =['id' => $slug];
        }
        else{$where =['slug' => $slug];}
        $biz = $this->biz
                    ->where(self::filter)
                    ->where($where)
                    ->first();
        if($biz){
            $response = [
                'status'    => 200,
                'error'     => false,
                'message'   => 'Biz Details & Menus',
                'data'      => [
                    'biz'  => $biz,
                    'state'    => $this->stateModel->find($biz->state_id),
                    'city'    => $this->cityModel->find($biz->city_id),
                    'menuByCategory'  => $biz->NestedCategories(),
                ]
            ];

            return $this->respond($response);
        }
        else{ return $this->failNotFound('No Record of Biz Details & Menus: '.$slug); }
        
    }

    public function menu($bizslug, $menuslug)
    {
        if(is_numeric($bizslug)){
            $where =['id' => $bizslug];
        }
        else{$where =['slug' => $bizslug];}
        $biz = $this->biz
                    ->where(self::filter)
                    ->where($where)
                    ->first();
        if($biz){   
            
            if(is_numeric($menuslug)){
                $whereMenu =['id' => $menuslug];
            }
            else{$whereMenu =['slug' => $menuslug];}
            $menu = $this->bizMenus
                        ->where(self::filter)
                        ->where('biz_id',$biz->id)
                        ->where($whereMenu)
                        ->first();

            if($menu){
                $response = [
                    'status'    => 200,
                    'error'     => false,
                    'message'   => 'Menus Details & Pricing',
                    'data'      => [
                        'menu'  => $menu,
                        'addupMenuByCategory'  => $menu->AddupCateMenu,
                    ]
                ];

                return $this->respond($response);
            }
            else{ return $this->failNotFound('No Record of Menu Details & Pricing: '.$menuslug); }
        }
        else{ return $this->failNotFound('No Record of Biz Details : '.$bizslug); }
    }

    /**
     * Return a new resource object, with default properties
     *
     * @return mixed
     */
    public function new()
    {
        //
    }

    /**
     * Create a new resource object, from "posted" parameters
     *
     * @return mixed
     */
    public function create()
    {
        
    }

    /**
     * Return the editable properties of a resource object
     *
     * @return mixed
     */
    public function edit($id = null)
    {
        //
    }

    /**
     * Add or update a model resource, from "posted" properties
     *
     * @return mixed
     */
    public function update($id = null)
    {
        //
    }

    /**
     * Delete the designated resource object from the model
     *
     * @return mixed
     */
    public function delete($id = null)
    {
        //
    }

    private function getStates()
    {
        $states = [
            '' => '-- Set State --',
        ];

        foreach ($this->stateModel->findAll() as $state_) {
            $states[$state_['id']] = $state_['state_name'];
        }

        return $states;
    }

    private function getCity()
    {
        $data = [];

        foreach ($this->cityModel->findAll() as $data_) {
            $data[] = $data_;
        }

        return $data;
    }

    public function checkBizType()
    {   
        //set biz type via session

        // $this->session->set('sessionBizType',VENDOR_REST);
        // $this->session->set("userdata", array(
        //     "name" => "Sanjay",
        //     "emp_id" => 1001,
        //     "email" => "sanjay_test@sample.com"
        //   ));
        //$_SESSION['sessionBizType'] = VENDOR_REST;

        $data = isset($_SESSION['sessionBizType']) ? true : false;
        return $data;
        
        // $this->cachePage(60); // 60 seconds

    }

    public function bizSuperAdminDataTable()
    {   
        $params['draw'] = $_REQUEST['draw'];
        $start = $_REQUEST['start'];
        $length = $_REQUEST['length'];

        /* Value we will get from typing in search */
        $search_value = $_REQUEST['search']['value'];

        if(!empty($search_value)){

            $bizs = $this->biz
                        ->where('isdeleted', 0)
                        ->like('name', $search_value)->orlike('phone', $search_value)->orlike('email', $search_value)->orlike('biz_type', $search_value)
                        ->orderBy('created_at','DESC')
                        ->findAll();
                        
            $total_count = $this->biz->where('isdeleted', 0)
                                ->like('name', $search_value)->orlike('phone', $search_value)->orlike('email', $search_value)->orlike('biz_type', $search_value)
                                ->countAllResults();
        }
        else{

            $bizs = $this->biz
                        ->where('isdeleted', 0)
                        ->limit($start, $length)
                        ->orderBy('created_at','DESC')
                        ->findAll(); 

            $total_count = $this->biz->where('isdeleted', 0)->countAllResults();
        }

        $response = [
            "draw" => intval($params['draw']),
            'recordsTotal'     => $total_count,
            'recordsFiltered'  => $total_count,
            'data'      => $bizs
        ];
        
        // $this->cachePage(60); // 60 seconds

        return $this->respondCreated($response);
    }
}

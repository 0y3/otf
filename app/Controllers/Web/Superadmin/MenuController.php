<?php

namespace App\Controllers\Web\Superadmin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Files\File;

class MenuController extends BaseController
{
    use ResponseTrait;

    const filter = [
        'isdeleted'     =>0
    ];
    
    protected $request;
    
    function __construct()
    {
        $this->request          = service('request');
        $this->session          = service('session'); # or \Config\Services::session();
        $this->encrypter        = service('encrypter');
        $this->biz              = model('BizModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->bizMenus         = model('BizMenuModel');
        $this->bizMenusCate     = model('BizMenuCategoryModel');
        $this->bizMenusAddup    = model('BizMenuAddupModel');
        $this->bizMenusAddupCate = model('BizMenuAddupCategoryModel');
        $this->stateModel       = model('StateModel');
        $this->cityModel        = model('StateCityModel');
        $this->deliveryLocate   = model('DeliveryLocationsModel');
        
    }
    public function index($bizSlug = null)
    {
        $biz = $this->biz->where(self::filter)->where('slug',$bizSlug)->first();
        if($biz){

            $breadcrumb =   '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.site_url('otfadmin/vendor').'" class="text-muted text-hover-primary">Vendors</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.route_to('vendor', $biz->slug).'" class="text-muted text-hover-primary">'.$biz->name.'</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-dark">Menus</li>';

            // $bizMenus = $this->bizMenus//->asArray()
            //     ->select('biz_menus.*, biz_menu_categories.name as category_name')
            //     ->join('biz_menu_categories', 'biz_menus.biz_menu_category_id = biz_menu_categories.id', 'left')
            //     ->where(['biz_menus.biz_id' => $biz->id,'biz_menus.isdeleted' => 0])
            //     ->findAll();
            
            // print("<pre>".print_r(json_encode($bizMenus[0]->AddupCategories,JSON_PRETTY_PRINT),true)."</pre>");die;
            // $data_=[];
            // foreach ($bizMenus as $key => $category) {
            //         // $category['addupMenus'] = $bizMenus[$key]->AddupCategories;
            //         $category['addupMenus'] = $bizMenus[$key]->AddupCategories;
            //         $data_[] = $category;
            // }


            $this->data = [
                'encrypter'     => $this->encrypter,
                'title'         => "OTF Superadmin:- Vendors: ".$biz->name." : Menus",
                'parentMenu'    => "vendors",
                'currentMenu'   => 'menus',
                'breadcrumb'    => $breadcrumb,
                'biz'           => $biz,
                'state'         => $this->stateModel->find($biz->state_id),
                'city'          => $this->cityModel->find($biz->city_id),
                'menuByCategoryMenu'  => $biz->MenuAndAddupMenus,
            ];

            // return view('layout', $data);
            // print("<pre>".print_r(json_encode($biz->MenuAndAddupMenus,JSON_PRETTY_PRINT),true)."</pre>");die;
            return view('superadmin/vendors_menu', $this->data);
        }
        else{ return redirect()->back(); }
    }

    public function add($bizSlug)
    {
        $biz = $this->biz->where(self::filter)->where('slug',$bizSlug)->first();
        if($biz){

            $breadcrumb =   '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.site_url('otfadmin/vendor').'" class="text-muted text-hover-primary">Vendors</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.route_to('vendor', $biz->slug).'" class="text-muted text-hover-primary">'.$biz->name.'</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.route_to('menus', $biz->slug).'" class="text-muted text-hover-primary">Menus</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-dark">Add Menu</li>';


            $this->data = [
                'encrypter'     => $this->encrypter,
                'title'         => "OTF Superadmin:- Vendors: ".$biz->name." : Add Menus",
                'parentMenu'    => "vendors",
                'currentMenu'   => 'menus',
                'breadcrumb'    => $breadcrumb,
                'biz'           => $biz,
                'state'         => $this->stateModel->find($biz->state_id),
                'city'          => $this->cityModel->find($biz->city_id),
            ];

            // return view('layout', $data);
            // print("<pre>".print_r(json_encode($biz->CategoryList(),JSON_PRETTY_PRINT),true)."</pre>");die;
            return view('superadmin/vendors_add_menu', $this->data);
        }
        else{ return redirect()->back(); }
    }

    Public function add_($bizSlug)
    {
        $biz = $this->biz->where(self::filter)->where('slug',$bizSlug)->first();
        if($biz){
            
            // print("<pre>".print_r($this->request->getPost(),true)."</pre>");die;
            if($this->request->getFile('image_file')){
                $file = $this->request->getFile('image_file');
                if ($file->isValid() && ! $file->hasMoved()) {
                        // Get random file name
                        $newMenuName = $file->getRandomName();
                        $path= FCPATH.'img/vendor/'.$biz->id.'/menus';
    
                        // Store file in public/img/vendor/ folder
                        $file->move($path, $newMenuName);
                        $menuImage = $file->getName();
                        
                }
                else{  throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')'); }
            }
            if($biz->biz_type == VENDOR_REST)
            {$newMenu = $this->bizMenus->insertRestMenus($biz->id,$this->request->getPost(),$menuImage);}
            else{
                $data = [
                    'biz_id'        => $biz->id,
                    'biz_menu_category_id'        => $this->request->getVar('category',FILTER_SANITIZE_NUMBER_INT),
                    'name'          => $this->request->getVar('name',FILTER_SANITIZE_STRING),
                    'description'   => $this->request->getVar('desc',FILTER_SANITIZE_STRING),
                    'price'         => $this->request->getVar('price', FILTER_SANITIZE_NUMBER_INT),
                    'image'         => $file->getName(),
                    'status'        => $this->request->getVar('status',FILTER_SANITIZE_NUMBER_INT)
                ];

                $newMenu = $this->bizMenus->insert($data);
            }
            //print("<pre>".print_r($this->request->getFile('image_file'),true)."</pre>");die;
            return $this->respond($newMenu);
        }
        else{ return redirect()->back(); }
    }

    Public function edit_($bizSlug,$menuId)
    {

    }

    Public function checkMenuName($bizId)
    {
        $data = ['valid' => true];
        $name = $this->request->getVar('name',FILTER_SANITIZE_STRING);
        $biz = $this->bizMenus->where(['biz_id' => $bizId,'name' => $name,'isdeleted' => 0])->first();
        if($biz){$data = ['valid' => false];}
        return $this->respond($data); 
    }
    Public function checkAddupMenuName($bizId)
    {
        $data = ['valid' => true];
        $name = $this->request->getVar('name',FILTER_SANITIZE_STRING);
        $biz = $this->bizMenusAddup->where(['biz_id' => $bizId,'name' => $name,'isdeleted' => 0])->first();
        if($biz){$data = ['valid' => false];}
        return $this->respond($data); 
    }
    Public function checkMenuCategoryName()
    {
        // print("<pre>".print_r($this->request->getPostGet(),true)."</pre>");die;
        $data = ['valid' => true];
        $bizId = $this->request->getVar('id');
        $name = $this->request->getVar('name',FILTER_SANITIZE_STRING);
        $biz = $this->bizMenusCate->where(['biz_id' => $bizId,'name' => $name,'isdeleted' => 0])->first();
        if($biz){$data = ['valid' => false];}
        return $this->respond($data); 
    }

    Public function menuCategory($bizSlug)
    {
        $biz = $this->biz->where(self::filter)->where('slug',$bizSlug)->first();
        if($biz){

            $breadcrumb =   '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.site_url('otfadmin/vendor').'" class="text-muted text-hover-primary">Vendors</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.route_to('vendor', $biz->slug).'" class="text-muted text-hover-primary">'.$biz->name.'</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-dark">Menus</li>';
                                    
        $this->data = [
            'encrypter'     => $this->encrypter,
            'title'         => "OTF Superadmin:- Vendors: ".$biz->name." : Menus",
            'parentMenu'    => "vendors",
            'currentMenu'   => 'categories',
            'breadcrumb'    => $breadcrumb,
            'biz'           => $biz,
            'state'         => $this->stateModel->find($biz->state_id),
            'city'          => $this->cityModel->find($biz->city_id),
            // 'category'      => $biz->CategoryList(),
        ];

        // print("<pre>".print_r(json_encode($biz->CategoryList(),JSON_PRETTY_PRINT),true)."</pre>");die;
        return view('superadmin/vendor_menucategory', $this->data);
    }
    else{ return redirect()->back(); }
    }

    public function menuCategoryAdd_($id = null,$parentId = null)
    {    

        $data = [
            'biz_id' => $id,
            'name'   => $this->request->getVar('name',FILTER_SANITIZE_STRING),
        ];
        if($parentId)
        {
            $bizNotRest = $this->biz->where(self::filter)->where(['id' => $id,'biz_type !=' => VENDOR_REST])->first();
            if($bizNotRest){ $data['menu_parent_id'] = $parentId; }
        }
        // $db=    \Config\Database::connect();
        // $data_    =  $db->table('biz_menu_categories')->insert($data);

        // print("<pre>".print_r($this->request->getPostGet(),true)."</pre>");die;
        $data_ = $this->bizMenusCate->insert($data);
        
        //  return print("<pre>".print_r($data,true)."</pre>");die;
         return $this->respond($data_); //json
        // Redirect to the cart page
    }

    public function menuCategoryEdit_($id=null)
    {    
        $data = [
            'name'   => $this->request->getVar('name',FILTER_SANITIZE_STRING),
        ];

        $data_ = $this->bizMenusCate->update($id,$data);
        
        // print("<pre>".print_r($data,true)."</pre>");die;
        return $this->respond($data_); //json
        // Redirect to the cart page
    }

    public function menuCategoryDelete($id=null)
    {    
        $data = ['isdeleted' => 1];
        // $data = $this->bizMenusCate->update($id,$data);
        $this->bizMenusCate->update($id,$data);
        $data = $this->bizMenusCate->delete($id);
        
        //  return print("<pre>".print_r($data,true)."</pre>");die;
         return $this->respond($data); //json
        // Redirect to the cart page
    }
}

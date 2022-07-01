<?php

namespace App\Controllers\Web\Superadmin;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Files\File;


class BizController extends BaseController
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
    public function index()
    {
        $bizs = $this->biz
                ->where(self::filter)
                ->orderBy('created_at','DESC')
                ->findAll();
                //->paginate(50);
        
        $breadcrumb =   ' <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                <li class="breadcrumb-item text-dark">Vendors</li>';

        $this->data = [
            'encrypter'     => $this->encrypter,
            'title'         => "OTF Superadmin:- Vendors",
            'parentMenu'    => "vendors",
            'currentMenu'   => 'vendor',
            'breadcrumb'    => $breadcrumb,
            'biz'           => $bizs,
            'deliveryloc'   => $this->deliveryLocate->getDeliveryLocate(),
            //'pager'         => $this->biz->pager,
        ];

        //return view('layout', $data);
        //print("<pre>".print_r(json_encode($bizs,JSON_PRETTY_PRINT),true)."</pre>");die;
        return view('superadmin/vendors', $this->data);
    }

    public function add()
    {    
        $bizloc = $this->request->getVar('delivery');
        $deliveryloc = $this->deliveryLocate->where('id',$bizloc)->first();
        
        $data = [
            'name'          => $this->request->getVar('name'),
            'biz_type'      => $this->request->getVar('biz_type'),
            'description'   => $this->request->getVar('desc'),
            'phone'         => $this->request->getVar('phone'),
            'email'         => $this->request->getVar('email'),
            'address'       => $this->request->getVar('address'),
            'city_id'       => (int)$deliveryloc['city_id'],
            'state_id'      => (int)$deliveryloc['state_id'],
        ];

        $newBiz = $this->biz->insert($data);
        // save and upload image file
        if($this->request->getFile('logo')){
            $file = $this->request->getFile('logo');
            if ($file->isValid() && ! $file->hasMoved()) {
                    // Get random file name
                    $newLogo = $file->getRandomName();
                    $path= FCPATH.'img/vendor/'.$newBiz.'/logo';

                    // Store file in public/img/vendor/ folder
                    $file->move($path, $newLogo);
                    $data_img['logo'] = $file->getName();

                    // $data = [
                    //     'uploaded_flleinfo' => $file,
                    //     'getName' => $file->getName(),
                    //     'getClientName' => $file->getClientName(),
                    //     'getTempName' => $file->getTempName(),
                    //     'getClientExtension' => $file->getClientExtension(),
                    // ];
                    // print("<pre>".print_r($data,true)."</pre>");
                    
            }
            else{  throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')'); }
        }

        if($this->request->getFile('cover_image_file')){
            $file = $this->request->getFile('cover_image_file');
            if ($file->isValid() && ! $file->hasMoved()) {
                    // Get random file name
                    $newLogo = $file->getRandomName();
                    $path= FCPATH.'img/vendor/'.$newBiz.'/logo';

                    // Store file in public/img/vendor/ folder
                    $file->move($path, $newLogo);
                    $data_img['image'] = $file->getName();
                    
            }
            else{  throw new \RuntimeException($file->getErrorString() . '(' . $file->getError() . ')'); }
        }
        // update biz
        $updateBiz = $this->biz->update($newBiz,$data_img);

        //return print("<pre>".print_r($this->request->getFile('cover_image_file'),true)."</pre>");die;
        return $this->respond($updateBiz); //json
    }

    public function overview($slug = null)
    {
        $biz = $this->biz->where(self::filter)->where('slug',$slug)->first();
                //->paginate(50);
        if($biz){

            $breadcrumb =   '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.site_url('otfadmin/vendor').'" class="text-muted text-hover-primary">Vendors</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-dark">'.$biz->name.'</li>';

            $this->data = [
                'encrypter'     => $this->encrypter,
                'title'         => "OTF Superadmin:- Vendors: ".$biz->name,
                'parentMenu'    => "vendors",
                'currentMenu'   => 'overview',
                'breadcrumb'    => $breadcrumb,
                'biz'           => $biz,
                'state'         => $this->stateModel->find($biz->state_id),
                'city'          => $this->cityModel->find($biz->city_id),
                // 'menuByCategory'  => $biz->NestedCategories(),
            ];

            //return view('layout', $data);
            // print("<pre>".print_r($biz->category_and_menus,true)."</pre>");die;
            return view('superadmin/vendors_overview', $this->data);
        }
        else{ return redirect()->back(); }
    }

    public function menus($slug = null)
    {
        
        $biz = $this->biz->where(self::filter)->where('slug',$slug)->first();
        if($biz){

            $breadcrumb =   '<li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.site_url('otfadmin/vendor').'" class="text-muted text-hover-primary">Vendors</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-muted"><a href="'.route_to('vendor', $biz->slug).'" class="text-muted text-hover-primary">'.$biz->name.'</a></li>
                            <li class="breadcrumb-item"><span class="bullet bg-gray-200 w-5px h-2px"></span></li>
                                    <li class="breadcrumb-item text-dark">Menus</li>';

            $bizMenus = $this->bizMenus//->asArray()
                ->select('biz_menus.*, biz_menu_categories.name as category_name')
                ->join('biz_menu_categories', 'biz_menus.biz_menu_category_id = biz_menu_categories.id', 'left')
                ->where(['biz_menus.biz_id' => $biz->id,'biz_menus.isdeleted' => 0])
                ->findAll();
            
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
}

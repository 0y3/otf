<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;


class BizController extends BaseController
{
    use ResponseTrait;

    const filter = [
        'status'        => 1,
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
        $this->stateModel       =  model('StateModel');
        $this->cityModel        =  model('StateCityModel');
        $this->deliveryLocate   = model('DeliveryLocationsModel');
        $this->cart             = cart();
        
    }
    public function index($slug = null)
    {
        if ($slug === false) {
            return redirect()->to('');
        }
        else{
            if($slug === VENDOR_REST){$where = ['biz_type' => VENDOR_REST];}
            elseif($slug === VENDOR_GROC){$where = ['biz_type' => VENDOR_GROC];}
            elseif($slug === VENDOR_PART){$where = ['biz_type' => VENDOR_PART];}
            else{  return redirect()->to('');}
            $bizs = $this->biz
                    ->where(self::filter)
                    ->where($where)
                    ->orderBy('id')
                    ->paginate(24);
        }

        $this->data = [
            'encrypter'     => $this->encrypter,
            'title'         => "OTF Vendors:- ".$slug,
            'currentMenu'   => $slug,
            'biz'           => $bizs,
            'pager'         => $this->biz->pager,
            'deliveryloc'   => $this->deliveryLocate->getDeliveryLocate(),
        ];

        //return view('layout', $data);
        //print("<pre>".print_r($data,true)."</pre>");die;
        return view('main/biz', $this->data);
    }

    public function bizCategoryMenu($slug = null)
    {
        if ($slug === false) {
            redirect()->to('');
        }
        else{
            if (url_is(VENDOR_REST.'*')) {$biztype = VENDOR_REST; $where =['biz_type' => VENDOR_REST,'slug' => $slug];}
            if (url_is(VENDOR_GROC.'*')) {$biztype = VENDOR_GROC; $where =['biz_type' => VENDOR_GROC,'slug' => $slug];}
            if (url_is(VENDOR_PART.'*')) {$biztype = VENDOR_PART; $where =['biz_type' => VENDOR_PART,'slug' => $slug];}
        }
        $biz = $this->biz
                    ->where(self::filter)
                    ->where($where)
                    ->first();
        if($biz){
            //if($this->cart->contents()){
            $checkcart = null;
            foreach ($this->cart->contents() as $key => $val) {
                if ($val['vendor_id'] === $biz->id) {
                    $checkcart = true;
                }else{ $checkcart = false; break;}
            }
            if($checkcart == false){
                $this->cart->destroy(); 
            }
                
            $this->data = [
                'encrypter'     => $this->encrypter,
                'title'         => "OTF Vendors:- ".$biz->name,
                'currentMenu'   => $biztype,
                'biz'           => $biz,
                'state'         => $this->stateModel->find($biz->state_id),
                'city'          => $this->cityModel->find($biz->city_id),
                'menuByCategory'  => $biz->NestedCategories(),
                'cart'          => $this->cart->contents(), 
                'sum_total'     => $this->cart->total(),
                'total_items'   => $this->cart->totalItems(),
                'deliveryloc'   => $this->deliveryLocate->getDeliveryLocate(),
            ];
            
            
            //print("<pre>".print_r($this->data,true)."</pre>");die;
            return view('main/bizcategorymenu', $this->data);
        }
        else{  
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function menu($bizslug, $menuslug)
    {
        // print("<pre>".print_r(site_url(uri_string(true)),true)."</pre>");die;
        $biz = $this->biz
                    ->where(self::filter)
                    ->where(['biz_type' => VENDOR_REST,'slug' => $bizslug])
                    ->first();
        if($biz){
            
            // if(is_numeric($menuslug)){
            //     $menuslug = $this->encrypter->decrypt($menuslug);
            //     $where =['biz_id' => $biz->id,'id' => $menuslug];}
            // else{$where =['biz_id' => $biz->id,'slug' => $menuslug];}
            
            $bizMenus = $this->bizMenus
                        ->where(self::filter)
                        ->where(['biz_id' => $biz->id,'slug' => $menuslug])
                        ->first();

            if($bizMenus){

                $data = [
                        'title' => "OTF Vendors:- ".$menuslug,
                        'currentMenu'   => $bizslug,
                        'menu'  => $bizMenus,
                        'addupMenuByCategory'  => $bizMenus->AddupCateMenu,
                    ];
                
                //print("<pre>".print_r($data,true)."</pre>");die;
                return $this->respond($data); //json
                //return view('main/bizmenu', $data);
            }
            else{ throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();}
        }
        else{throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();}
    }

    public function vendors()
    {
        $bizs = $this->biz
                    ->where(self::filter)
                    ->orderBy('id')
                    ->paginate(20);
        
        $data = [
            'title' => "OTF Vendors ",
            'currentMenu'   => "",
            'biz' => $bizs,
        ];

        return view('main/biz', $data);
    }
    public function checkBizType()
    {   

        //check biz type for filtring;
        delete_cookie('cookieBizType');
        set_cookie('cookieBizType', VENDOR_REST, 3600*2);

        $filterBiz=[];
        $filterBiz =['get' => get_cookie('cookieBizType'),'has' =>has_Cookie('cookieBizType')];
        if(has_cookie('cookieBizType') == null){$filterBiz[] = ['biz_type' => 'select Biz Type'];}
        else
        {
            if(get_cookie('cookieBizType') === VENDOR_REST){$filterBiz[] = ['biz_type' => VENDOR_REST];};
            if(get_cookie('cookieBizType') === VENDOR_GROC){$filterBiz[] = ['biz_type' => VENDOR_GROC];};
            if(get_cookie('cookieBizType') === VENDOR_PART){$filterBiz[] = ['biz_type' => VENDOR_PART];};
        }
        //$filterBiz['get_Cookie_Store'] = Services::response()->getCookieStore();


        //set biz type via session

        $this->session->set('BizTypeFilter',VENDOR_REST);
        $this->session->set("userdata", array(
            "name" => "Sanjay",
            "emp_id" => 1001,
            "email" => "sanjay_test@sample.com"
          ));
        $_SESSION['BizTypeFilter'] = VENDOR_REST;

        $data = isset($_SESSION['sessionBizType']) ? true : false;
        return $data;
    }

    public function setCookiesLocation()
    {
        delete_cookie('cookiesLocation');
        $enc = $this->encrypter->encrypt($this->request->getVar('delivery'));
        set_cookie('cookiesLocation',$enc, 3600*2);
    }

    public function getCookiesLocation()
    {
        $filterBiz=[];
        $filterBiz =['get' => get_cookie('cookiesLocation'),'has' =>has_Cookie('cookiesLocation')];
        if(has_cookie('cookiesLocation') == null){$filterBiz[] = ['biz_type' => 'select Biz Type'];}
        else
        {
            $cookieLocation = $this->encrypter->decrypt(get_cookie('cookieLocation'));
            if($cookieLocation === VENDOR_REST){$filterBiz[] = ['biz_type' => VENDOR_REST];};
            if($cookieLocation === VENDOR_GROC){$filterBiz[] = ['biz_type' => VENDOR_GROC];};
            if($cookieLocation === VENDOR_PART){$filterBiz[] = ['biz_type' => VENDOR_PART];};
        }
        return true;
    }

    public function addToCart()
    {    
        $data = [
            'menu_id'   => $this->request->getVar('menu_id'),
            'vendor_id' => $this->request->getVar('vendor_id'),
            'qty'       => $this->request->getVar('menu_qty'),
            'price'     => $this->request->getVar('menu_price'),
            'total'     => $this->request->getVar('menu_subtotal'),
            'name'      => $this->request->getVar('menu_name')
        ];
        $id_same = $this->request->getVar('menu_id');
        $insert_data =[];

        foreach($this->request->getVar('menu_addups') AS $addup_menu)
        {
            $insert_data[] = [
                'id'        => $addup_menu->id,
                'cate_id'   => $addup_menu->cate_id,
                'cate_name' => $addup_menu->cate_name,
                'name'      => $addup_menu->name,
                'price'     => $addup_menu->price
            ];
            $id_same .=  $addup_menu->id;
        }
        $data['id'] = $this->request->getVar('vendor_id').'-'.$id_same;
        $data['addups'] = $insert_data;
        $data['options'] = $insert_data;
        $insert = $this->cart->insert($data);

        $data_ = [
            'cart'          => $this->cart->contents(),
            'sum_total'     => $this->cart->total(),
            'total_items'   => $this->cart->totalItems(),
        ];
        // $this->cart->destroy();
        
         //return print("<pre>".print_r($data_(),true)."</pre>");die;
         return $this->respond($data_); //json
        // Redirect to the cart page
    }

    public function removeCart($rowid)
    {
        $remove = $this->cart->remove($rowid);

        $data = [
            'cart'          => $this->cart->contents(),
            'sum_total'     => $this->cart->total(),
            'total_items'   => $this->cart->totalItems()
        ];
        return $this->respond($data); 
    }

    public function checkOut($slug)
    {
        // print("<pre>".print_r(site_url(uri_string(true)),true)."</pre>");die;
        
        if ($slug === false) {
            redirect()->to('');
        }
        else{
            if (url_is(VENDOR_REST.'*')) {$biztype = VENDOR_REST; $where =['biz_type' => VENDOR_REST,'slug' => $slug];}
            if (url_is(VENDOR_GROC.'*')) {$biztype = VENDOR_GROC; $where =['biz_type' => VENDOR_GROC,'slug' => $slug];}
            if (url_is(VENDOR_PART.'*')) {$biztype = VENDOR_PART; $where =['biz_type' => VENDOR_PART,'slug' => $slug];}
        }
        $biz = $this->biz
                    ->where(self::filter)
                    ->where($where)
                    ->first();
        if($biz)
        {
            //check delivery location
            if(!getDeliveryLocationTemp()){ return redirect()->to($where['biz_type'].'/'.$slug);}

            // check cart not empty
            if(empty($this->cart->contents()) ){ return redirect()->to($where['biz_type'].'/'.$slug);}
            else{
                $checkcart = null;
                foreach ($this->cart->contents() as $key => $val) {
                    if ($val['vendor_id'] === $biz->id) {
                        $checkcart = true;
                    }else{ $checkcart = false; break;}
                }
                if($checkcart == false){$this->cart->destroy(); return redirect()->back();}
            }

            // check if login 
            if(!$this->session->get('isLoggedIn')){
                return setBackUrl(site_url(uri_string()));
            }
            $delivery_fee = 2000;
            $sum_total = (float)$this->cart->total();
            $grand_total = $sum_total + $delivery_fee;

            $this->data = [
                'encrypter'     => $this->encrypter,
                'title'         => "OTF Vendors:- Checkout",
                'currentMenu'   => "Checkout",
                'biz'           => $biz,
                'state'         => $this->stateModel->find($biz->state_id),
                'city'          => $this->cityModel->find($biz->city_id),
                'cart'          => $this->cart->contents(),
                'delivery_fee'  => $delivery_fee,
                'sum_total'     => $sum_total,
                'grand_total'   => $grand_total,
                'deliveryloc'   => $this->deliveryLocate->getDeliveryLocate(),
            ];
                // print("<pre>".print_r($this->data['cart'],true)."</pre>");
                //print("<pre>".print_r(json_encode($this->data['cart']['d33443769121f404c7c87015223dac57']['addups'],JSON_PRETTY_PRINT),true)."</pre>");die;
                //print("<pre>".print_r($this->data['cart'],true)."</pre>");die;
                return view('main/checkout', $this->data);
        }
        else{ throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();}
    }

    public function deliveryLocation_($id=null)
    {
        if($this->request->getVar('deliveryId')){$id = $this->request->getVar('deliveryId');}
        setDeliveryLocationTemp($id);
        $data = [
            'deliveryLocateId'    => $id,
            'deliveryLocateState' => getDeliveryLocationTemp()['deliveryLocateState'],
            'deliveryLocateCity'  => getDeliveryLocationTemp()['deliveryLocateCity'],

        ];
        return $this->respond($data);
    }

    public function getDeliveryLocation()
    {
        if(getDeliveryLocationTemp())
        {
            $data = [
                'deliveryLocateId'    => $this->encrypter->decrypt(getDeliveryLocationTemp()['deliveryLocateId']),
                'deliveryLocateState' => getDeliveryLocationTemp()['deliveryLocateState'],
                'deliveryLocateCity'  => getDeliveryLocationTemp()['deliveryLocateCity'],

            ];
            return $this->respond($data);
        }
        else{return false;}
    }
}

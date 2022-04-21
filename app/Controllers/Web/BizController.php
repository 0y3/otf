<?php

namespace App\Controllers\Web;

use App\Controllers\BaseController;


class BizController extends BaseController
{

    const filter = [
        'status'        => 1,
        'isdeleted'     =>0
    ];
    
    protected $request;
    
    function __construct()
    {
        $this->request      = service('request');
        $this->session      = service('session'); # or \Config\Services::session();
        $this->encrypter      = service('encrypter');
        $this->biz         = model('BizModel'); # or \App\Models::UserModel(); or (new UserModel); or new UserModel 
        $this->bizMenus     = model('BizMenuModel');
        $this->bizMenusCate     = model('BizMenuCategoryModel');
        $this->bizMenusAddup     = model('BizMenuAddupModel');
        $this->bizMenusAddupCate     = model('BizMenuAddupCategoryModel');
        $this->stateModel =  model('StateModel');
        $this->cityModel =  model('StateCityModel');

        
        
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
        $data = [
            'title' => "OTF Vendors:- ".$slug,
            'currentMenu'   => $slug,
            'biz'   => $bizs,
            'pager'   => $this->biz->pager,
        ];

        //return view('layout', $data);
        //print("<pre>".print_r($data,true)."</pre>");die;
        return view('main/biz', $data);
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
            
            $data = [
                'title' => "OTF Vendors:- ".$biz->name,
                'currentMenu'   => $biztype,
                'biz'   => $biz,
                'state'    => $this->stateModel->find($biz->state_id),
                'city'    => $this->cityModel->find($biz->city_id),
                'menuByCategory'  => $biz->NestedCategories(),
            ];
            
            //print("<pre>".print_r($data,true)."</pre>");die;
            return view('main/bizcategorymenu', $data);
        }
        else{  
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }
    }

    public function Menu($bizslug, $menuslug)
    {
        if (url_is(VENDOR_REST.'*')) {$where =['biz_type' => VENDOR_REST,'slug' => $bizslug];}
        if (url_is(VENDOR_GROC.'*')) {$where =['biz_type' => VENDOR_GROC,'slug' => $bizslug];}
        if (url_is(VENDOR_PART.'*')) {$where =['biz_type' => VENDOR_PART,'slug' => $bizslug];}

        //print("<pre>".print_r(site_url(uri_string(true)),true)."</pre>");die;
        $biz = $this->biz
                    ->where(self::filter)
                    ->where($where)
                    ->first();
        if($biz){

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
            
                return view('main/bizmenu', $data);
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

    public function getCookiesLocation(){
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
}

<div id="kt_aside" class="aside" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
   





   

   <!--begin::Aside Toolbarl-->
   <div class="aside-toolbar flex-column-auto" id="kt_aside_toolbar">
      <!--begin::Aside user-->
      <!--begin::User-->
      <div class="aside-user d-flex align-items-sm-center justify-content-center py-5">
         <!--begin::Symbol-->
         <div class="symbol symbol-50px">
            <!-- <img src="../assets/media/avatars/300-1.jpg" alt="" /> -->
            <div class="symbol-label fs-2 fw-bold bg-<?=BG_NAME[array_rand(BG_NAME)]?> text-inverse-danger"><?= $_SESSION['userSurname'][0].''.substr($_SESSION['userFirstname'],0,1)?></div>
         </div>
         
         <!--end::Symbol-->
         <!--begin::Wrapper-->
         <div class="aside-user-info flex-row-fluid flex-wrap ms-5">
            <!--begin::Section-->
            <div class="d-flex">
               <!--begin::Info-->
               <div class="flex-grow-1 me-2">
                  <!--begin::Username-->
                  <a href="#" class="text-white text-hover-primary fs-6 fw-bold"><?= $_SESSION['userSurname'] .' '. $_SESSION['userFirstname']?></a>
                  <!--end::Username-->
                  <!--begin::Description-->
                  <span class="text-gray-600 fw-bold d-block fs-8 mb-1"><?= $_SESSION['userSurname'] .' '. $_SESSION['userFirstname']?></span>
                  <!--end::Description-->
                  <!--begin::Label-->
                  <div class="d-flex align-items-center text-success fs-9">
                  <span class="bullet bullet-dot bg-success me-1"></span>online</div>
                  <!--end::Label-->
               </div>
               <!--end::Info-->

               <!--begin::User menu-->
               <div class="me-n2">
                  <!--begin::Action-->
                  <a href="#" class="btn btn-icon btn-sm btn-active-color-primary mt-n2" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-overflow="true">
                     <!--begin::Svg Icon | path: icons/duotune/coding/cod001.svg-->
                     <span class="svg-icon svg-icon-muted svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path opacity="0.3" d="M22.1 11.5V12.6C22.1 13.2 21.7 13.6 21.2 13.7L19.9 13.9C19.7 14.7 19.4 15.5 18.9 16.2L19.7 17.2999C20 17.6999 20 18.3999 19.6 18.7999L18.8 19.6C18.4 20 17.8 20 17.3 19.7L16.2 18.9C15.5 19.3 14.7 19.7 13.9 19.9L13.7 21.2C13.6 21.7 13.1 22.1 12.6 22.1H11.5C10.9 22.1 10.5 21.7 10.4 21.2L10.2 19.9C9.4 19.7 8.6 19.4 7.9 18.9L6.8 19.7C6.4 20 5.7 20 5.3 19.6L4.5 18.7999C4.1 18.3999 4.1 17.7999 4.4 17.2999L5.2 16.2C4.8 15.5 4.4 14.7 4.2 13.9L2.9 13.7C2.4 13.6 2 13.1 2 12.6V11.5C2 10.9 2.4 10.5 2.9 10.4L4.2 10.2C4.4 9.39995 4.7 8.60002 5.2 7.90002L4.4 6.79993C4.1 6.39993 4.1 5.69993 4.5 5.29993L5.3 4.5C5.7 4.1 6.3 4.10002 6.8 4.40002L7.9 5.19995C8.6 4.79995 9.4 4.39995 10.2 4.19995L10.4 2.90002C10.5 2.40002 11 2 11.5 2H12.6C13.2 2 13.6 2.40002 13.7 2.90002L13.9 4.19995C14.7 4.39995 15.5 4.69995 16.2 5.19995L17.3 4.40002C17.7 4.10002 18.4 4.1 18.8 4.5L19.6 5.29993C20 5.69993 20 6.29993 19.7 6.79993L18.9 7.90002C19.3 8.60002 19.7 9.39995 19.9 10.2L21.2 10.4C21.7 10.5 22.1 11 22.1 11.5ZM12.1 8.59998C10.2 8.59998 8.6 10.2 8.6 12.1C8.6 14 10.2 15.6 12.1 15.6C14 15.6 15.6 14 15.6 12.1C15.6 10.2 14 8.59998 12.1 8.59998Z" fill="currentColor" />
                           <path d="M17.1 12.1C17.1 14.9 14.9 17.1 12.1 17.1C9.30001 17.1 7.10001 14.9 7.10001 12.1C7.10001 9.29998 9.30001 7.09998 12.1 7.09998C14.9 7.09998 17.1 9.29998 17.1 12.1ZM12.1 10.1C11 10.1 10.1 11 10.1 12.1C10.1 13.2 11 14.1 12.1 14.1C13.2 14.1 14.1 13.2 14.1 12.1C14.1 11 13.2 10.1 12.1 10.1Z" fill="currentColor" />
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </a>
                  <!--begin::User account menu-->
                  <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                     <!--begin::Menu item-->
                     <div class="menu-item px-3">
                        <div class="menu-content d-flex align-items-center px-3">
                           <!--begin::Avatar-->
                           <div class="symbol symbol-50px me-5">
                              <img alt="Logo" src="../assets/media/avatars/300-1.jpg" />
                           </div>
                           <!--end::Avatar-->
                           <!--begin::Username-->
                           <div class="d-flex flex-column">
                              <div class="fw-bolder d-flex align-items-center fs-5">Max Smith 
                              <span class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span></div>
                              <a href="#" class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
                           </div>
                           <!--end::Username-->
                        </div>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu separator-->
                     <div class="separator my-2"></div>
                     <!--end::Menu separator-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5">
                        <a href="../account/overview.html" class="menu-link px-5">My Profile</a>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5">
                        <a href="../apps/projects/list.html" class="menu-link px-5">
                           <span class="menu-text">My Projects</span>
                           <span class="menu-badge">
                              <span class="badge badge-light-danger badge-circle fw-bolder fs-7">3</span>
                           </span>
                        </a>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                        <a href="#" class="menu-link px-5">
                           <span class="menu-title">My Subscription</span>
                           <span class="menu-arrow"></span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/referrals.html" class="menu-link px-5">Referrals</a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/billing.html" class="menu-link px-5">Billing</a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/statements.html" class="menu-link px-5">Payments</a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/statements.html" class="menu-link d-flex flex-stack px-5">Statements 
                              <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="View your statements"></i></a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu separator-->
                           <div class="separator my-2"></div>
                           <!--end::Menu separator-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <div class="menu-content px-3">
                                 <label class="form-check form-switch form-check-custom form-check-solid">
                                    <input class="form-check-input w-30px h-20px" type="checkbox" value="1" checked="checked" name="notifications" />
                                    <span class="form-check-label text-muted fs-7">Notifications</span>
                                 </label>
                              </div>
                           </div>
                           <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5">
                        <a href="../account/statements.html" class="menu-link px-5">My Statements</a>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu separator-->
                     <div class="separator my-2"></div>
                     <!--end::Menu separator-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="right-start">
                        <a href="#" class="menu-link px-5">
                           <span class="menu-title position-relative">Language 
                           <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English 
                           <img class="w-15px h-15px rounded-1 ms-2" src="../assets/media/flags/united-states.svg" alt="" /></span></span>
                        </a>
                        <!--begin::Menu sub-->
                        <div class="menu-sub menu-sub-dropdown w-175px py-4">
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/settings.html" class="menu-link d-flex px-5 active">
                              <span class="symbol symbol-20px me-4">
                                 <img class="rounded-1" src="../assets/media/flags/united-states.svg" alt="" />
                              </span>English</a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/settings.html" class="menu-link d-flex px-5">
                              <span class="symbol symbol-20px me-4">
                                 <img class="rounded-1" src="../assets/media/flags/spain.svg" alt="" />
                              </span>Spanish</a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/settings.html" class="menu-link d-flex px-5">
                              <span class="symbol symbol-20px me-4">
                                 <img class="rounded-1" src="../assets/media/flags/germany.svg" alt="" />
                              </span>German</a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/settings.html" class="menu-link d-flex px-5">
                              <span class="symbol symbol-20px me-4">
                                 <img class="rounded-1" src="../assets/media/flags/japan.svg" alt="" />
                              </span>Japanese</a>
                           </div>
                           <!--end::Menu item-->
                           <!--begin::Menu item-->
                           <div class="menu-item px-3">
                              <a href="../account/settings.html" class="menu-link d-flex px-5">
                              <span class="symbol symbol-20px me-4">
                                 <img class="rounded-1" src="../assets/media/flags/france.svg" alt="" />
                              </span>French</a>
                           </div>
                           <!--end::Menu item-->
                        </div>
                        <!--end::Menu sub-->
                     </div>
                     <!--end::Menu item-->

                     <!--begin::Menu item-->
                     <div class="menu-item px-5 my-1">
                        <a href="../account/settings.html" class="menu-link px-5">Account Settings</a>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5">
                        <a href="<?=site_url('otfadmin/logout') ?>" class="menu-link px-5">Sign Out</a>
                     </div>
                     <!--end::Menu item-->
                     <!--begin::Menu separator-->
                     <div class="separator my-2"></div>
                     <!--end::Menu separator-->
                     <!--begin::Menu item-->
                     <div class="menu-item px-5">
                        <div class="menu-content px-5">
                           <label class="form-check form-switch form-check-custom form-check-solid pulse pulse-success" for="kt_user_menu_dark_mode_toggle">
                              <input class="form-check-input w-30px h-20px" type="checkbox" value="1" name="mode" id="kt_user_menu_dark_mode_toggle" data-kt-url="../dark/index.html" />
                              <span class="pulse-ring ms-n1"></span>
                              <span class="form-check-label text-gray-600 fs-7">Dark Mode</span>
                           </label>
                        </div>
                     </div>
                     <!--end::Menu item-->
                  </div>
                  <!--end::User account menu-->

                  <!--end::Action-->
               </div>
               <!--end::User menu-->
            </div>
            <!--end::Section-->
         </div>
         <!--end::Wrapper-->
      </div>
      <!--end::User-->
      <!--end::Aside user-->
   </div>
   <!--end::Aside Toolbarl-->










   <!--begin::Aside menu-->
   <div class="aside-menu flex-column-fluid">
      <!--begin::Aside Menu-->
      <div class="hover-scroll-overlay-y px-2 my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-height="auto" data-kt-scroll-dependencies="{default: '#kt_aside_toolbar, #kt_aside_footer', lg: '#kt_header, #kt_aside_toolbar, #kt_aside_footer'}" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="5px" style="height: 117px;">
         <!--begin::Menu-->
         <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
            <div class="menu-item">
               <a class="menu-link <?= ($currentMenu == 'dashboard') ? 'active' : '' ?>" href="<?=site_url('otfadmin/dashboard')?>">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <rect x="2" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                           <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2" fill="currentColor"></rect>
                           <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                           <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2" fill="currentColor"></rect>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">Dashboard</span>
               </a>
            </div>


            <div class="menu-item">
               <div class="menu-content pt-8 pb-2">
                  <span class="menu-section text-muted text-uppercase fs-8 ls-1">Orders Menu</span>
               </div>
            </div>
            <div class="menu-item">
               <a class="menu-link <?=($currentMenu == 'order') ? 'active' : '' ?>" href="<?= route_to('orders')?> ">
                  <span class="menu-link">
                     <span class="menu-icon">
                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                        <span class="svg-icon svg-icon-2">
                           <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                              <path opacity="0.3" d="M18.041 22.041C18.5932 22.041 19.041 21.5932 19.041 21.041C19.041 20.4887 18.5932 20.041 18.041 20.041C17.4887 20.041 17.041 20.4887 17.041 21.041C17.041 21.5932 17.4887 22.041 18.041 22.041Z" fill="currentColor"></path>
                              <path opacity="0.3" d="M6.04095 22.041C6.59324 22.041 7.04095 21.5932 7.04095 21.041C7.04095 20.4887 6.59324 20.041 6.04095 20.041C5.48867 20.041 5.04095 20.4887 5.04095 21.041C5.04095 21.5932 5.48867 22.041 6.04095 22.041Z" fill="currentColor"></path>
                              <path opacity="0.3" d="M7.04095 16.041L19.1409 15.1409C19.7409 15.1409 20.141 14.7409 20.341 14.1409L21.7409 8.34094C21.9409 7.64094 21.4409 7.04095 20.7409 7.04095H5.44095L7.04095 16.041Z" fill="currentColor"></path>
                              <path d="M19.041 20.041H5.04096C4.74096 20.041 4.34095 19.841 4.14095 19.541C3.94095 19.241 3.94095 18.841 4.14095 18.541L6.04096 14.841L4.14095 4.64095L2.54096 3.84096C2.04096 3.64096 1.84095 3.04097 2.14095 2.54097C2.34095 2.04097 2.94096 1.84095 3.44096 2.14095L5.44096 3.14095C5.74096 3.24095 5.94096 3.54096 5.94096 3.84096L7.94096 14.841C7.94096 15.041 7.94095 15.241 7.84095 15.441L6.54096 18.041H19.041C19.641 18.041 20.041 18.441 20.041 19.041C20.041 19.641 19.641 20.041 19.041 20.041Z" fill="currentColor"></path>
                           </svg>
                        </span>
                        <!--end::Svg Icon-->
                     </span>
                     <span class="menu-title">Orders</span>
                     <span class="menu-label">
                        <span class="badge badge-light-danger">new</span>
                     </span>
                  </span>
               </a>
            </div>
            
            
            
            
            <div class="menu-item">
               <div class="menu-content pt-8 pb-2">
                  <span class="menu-section text-muted text-uppercase fs-8 ls-1">App Menus</span>
               </div>
            </div>

            <div data-kt-menu-trigger="click" class="menu-item <?=(isset($parentMenu) && $parentMenu == 'vendors') ? 'here show' : '' ?> menu-accordion">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path d="M21 10H13V11C13 11.6 12.6 12 12 12C11.4 12 11 11.6 11 11V10H3C2.4 10 2 10.4 2 11V13H22V11C22 10.4 21.6 10 21 10Z" fill="currentColor" />
                           <path opacity="0.3" d="M12 12C11.4 12 11 11.6 11 11V3C11 2.4 11.4 2 12 2C12.6 2 13 2.4 13 3V11C13 11.6 12.6 12 12 12Z" fill="currentColor" />
                           <path opacity="0.3" d="M18.1 21H5.9C5.4 21 4.9 20.6 4.8 20.1L3 13H21L19.2 20.1C19.1 20.6 18.6 21 18.1 21ZM13 18V15C13 14.4 12.6 14 12 14C11.4 14 11 14.4 11 15V18C11 18.6 11.4 19 12 19C12.6 19 13 18.6 13 18ZM17 18V15C17 14.4 16.6 14 16 14C15.4 14 15 14.4 15 15V18C15 18.6 15.4 19 16 19C16.6 19 17 18.6 17 18ZM9 18V15C9 14.4 8.6 14 8 14C7.4 14 7 14.4 7 15V18C7 18.6 7.4 19 8 19C8.6 19 9 18.6 9 18Z" fill="currentColor" />
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">Vendors</span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion">
                  <!-- <div class="menu-item">
                     <a class="menu-link <?=($currentMenu == 'vendoradd') ? 'active' : '' ?>" href="<?= site_url('otfadmin/add/vendor')?>">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Add Vendor</span>
                     </a>
                  </div> -->
                  <div class="menu-item">
                     <a class="menu-link <?=($currentMenu == 'vendor') ? 'active' : '' ?>" href="<?= site_url('otfadmin/vendor')?>">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Vendor List</span>
                     </a>
                  </div>
               </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item  <?=(isset($parentMenu) && $parentMenu == 'customers') ? 'here show' : '' ?> menu-accordion">
               <span class="menu-link">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm002.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor"></path>
                           <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor"></path>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">Customers</span>
                  <span class="menu-arrow"></span>
               </span>
               <div class="menu-sub menu-sub-accordion">
                  <!-- <div class="menu-item">
                     <a class="menu-link" href="<?= site_url('otfadmin/add/customer')?>">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Add Customer</span>
                     </a>
                  </div> -->
                  <div class="menu-item">
                     <a class="menu-link <?=($currentMenu == 'customer') ? 'active' : '' ?>" href="<?= site_url('otfadmin/customer')?>">
                        <span class="menu-bullet">
                           <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Customer List</span>
                     </a>
                  </div>
               </div>
            </div>
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion">
               <a class="menu-link" href="" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Build your layout and export HTML for server side integration">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                           <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">Ads</span>
               </a>
            </div>


            <div class="menu-item">
               <div class="menu-content pt-8 pb-0">
                  <span class="menu-section text-muted text-uppercase fs-8 ls-1">User</span>
               </div>
            </div>
            <div class="menu-item">
               <a class="menu-link" href="" title="" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss="click" data-bs-placement="right" data-bs-original-title="Build your layout and export HTML for server side integration">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor"></path>
                           <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor"></path>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">Ads</span>
               </a>
            </div>


            <div class="menu-item">
               <div class="menu-content">
                  <div class="separator mx-1 my-4"></div>
               </div>
            </div>
            <div class="menu-item">
               <a class="menu-link" href="../documentation/getting-started/changelog.html">
                  <span class="menu-icon">
                     <!--begin::Svg Icon | path: icons/duotune/coding/cod003.svg-->
                     <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                           <path d="M16.95 18.9688C16.75 18.9688 16.55 18.8688 16.35 18.7688C15.85 18.4688 15.75 17.8688 16.05 17.3688L19.65 11.9688L16.05 6.56876C15.75 6.06876 15.85 5.46873 16.35 5.16873C16.85 4.86873 17.45 4.96878 17.75 5.46878L21.75 11.4688C21.95 11.7688 21.95 12.2688 21.75 12.5688L17.75 18.5688C17.55 18.7688 17.25 18.9688 16.95 18.9688ZM7.55001 18.7688C8.05001 18.4688 8.15 17.8688 7.85 17.3688L4.25001 11.9688L7.85 6.56876C8.15 6.06876 8.05001 5.46873 7.55001 5.16873C7.05001 4.86873 6.45 4.96878 6.15 5.46878L2.15 11.4688C1.95 11.7688 1.95 12.2688 2.15 12.5688L6.15 18.5688C6.35 18.8688 6.65 18.9688 6.95 18.9688C7.15 18.9688 7.35001 18.8688 7.55001 18.7688Z" fill="currentColor"></path>
                           <path opacity="0.3" d="M10.45 18.9687C10.35 18.9687 10.25 18.9687 10.25 18.9687C9.75 18.8687 9.35 18.2688 9.55 17.7688L12.55 5.76878C12.65 5.26878 13.25 4.8687 13.75 5.0687C14.25 5.1687 14.65 5.76878 14.45 6.26878L11.45 18.2688C11.35 18.6688 10.85 18.9687 10.45 18.9687Z" fill="currentColor"></path>
                        </svg>
                     </span>
                     <!--end::Svg Icon-->
                  </span>
                  <span class="menu-title">Changelog v8.0.38</span>
               </a>
            </div>
         </div>
         <!--end::Menu-->
      </div>
      <!--end::Aside Menu-->
   </div>
   <!--end::Aside menu-->






   <!--begin::Footer-->
   <div class="aside-footer flex-column-auto py-5" id="kt_aside_footer">
      <a href="<?=site_url('otfadmin/logout') ?>" class="btn btn-custom btn-primary w-100">
         <span class="btn-label">Sign Out</span>
         <!--begin::Svg Icon | path: icons/duotune/general/gen005.svg-->
         <span class="svg-icon btn-icon svg-icon-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
               <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22ZM12.5 18C12.5 17.4 12.6 17.5 12 17.5H8.5C7.9 17.5 8 17.4 8 18C8 18.6 7.9 18.5 8.5 18.5L12 18C12.6 18 12.5 18.6 12.5 18ZM16.5 13C16.5 12.4 16.6 12.5 16 12.5H8.5C7.9 12.5 8 12.4 8 13C8 13.6 7.9 13.5 8.5 13.5H15.5C16.1 13.5 16.5 13.6 16.5 13ZM12.5 8C12.5 7.4 12.6 7.5 12 7.5H8C7.4 7.5 7.5 7.4 7.5 8C7.5 8.6 7.4 8.5 8 8.5H12C12.6 8.5 12.5 8.6 12.5 8Z" fill="currentColor" />
               <rect x="7" y="17" width="6" height="2" rx="1" fill="currentColor" />
               <rect x="7" y="12" width="10" height="2" rx="1" fill="currentColor" />
               <rect x="7" y="7" width="6" height="2" rx="1" fill="currentColor" />
               <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />
            </svg>
         </span>
         <!--end::Svg Icon-->
      </a>
   </div>
   <!--end::Footer-->

</div>
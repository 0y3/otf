<?= $this->extend('superadmin/layout') ?>

<?= $this->section('content') ?>
<!--begin::Container-->
<div id="kt_content_container" class="container-xxl">
    <!--begin::Navbar-->
    <?= $this->include('superadmin/vendors_details_menu') ?>
    <!--end::Navbar-->
    
    <!--begin::Form-->
    <form id="newMenu_form" class="form newMenu_form" action="<?= route_to('menu_new',$biz->slug) ?>" method="post" enctype="multipart/form-data">
    <div class="row g-xxxl-9">
        <!--begin::Col-->
        <div class="col-xl-3 col-xxxl-3">
            <!--begin::Thumbnail settings-->
            <div class="card card-flush py-4 mb-md-5 mb-5">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Thumbnail</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="fv-row card-body text-center pt-0">
                    <!--begin::Image input-->
                    <div class="image-input image-input-empty image-input-outline mb-3" data-kt-image-input="true" style="background-image: url(<?= base_url('img/blank_image.svg')?>)">
                        <!--begin::Preview existing avatar-->
                        <div class="image-input-wrapper w-150px h-150px"></div>
                        <!--end::Preview existing avatar-->
                        <!--begin::Label-->
                        <label class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" title="Change avatar">
                            <i class="bi bi-pencil-fill fs-7"></i>
                            <!--begin::Inputs-->
                            <input type="file" name="image_file" accept=".png, .jpg, .jpeg" />
                            <input type="hidden" name="avatar_remove" />
                            <!--end::Inputs-->
                        </label>
                        <!--end::Label-->
                        <!--begin::Cancel-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" title="Cancel avatar">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Cancel-->
                        <!--begin::Remove-->
                        <span class="btn btn-icon btn-circle btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" title="Remove avatar">
                            <i class="bi bi-x fs-2"></i>
                        </span>
                        <!--end::Remove-->
                    </div>
                    <!--end::Image input-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the product thumbnail image. Only *.png, *.jpg and *.jpeg image files are accepted</div>
                    <!--end::Description-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Thumbnail settings-->
            
            <!--begin::Status-->
            <div class="fv-row card card-flush py-4 mb-md-5 mb-5">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Status</h2>
                    </div>
                    <!--end::Card title-->
                    <!--begin::Card toolbar-->
                    <div class="card-toolbar">
                        <div class="rounded-circle bg-success w-15px h-15px" id="kt_ecommerce_add_product_status"></div>
                    </div>
                    <!--begin::Card toolbar-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Select2-->
                    <select name="status" class="form-select mb-2" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="" required="required" value="">
                        <option></option>
                        <option value="1" selected="selected">Published</option>
                        <option value="0">Inactive</option>
                    </select>
                    <!--end::Select2-->
                    <!--begin::Description-->
                    <div class="text-muted fs-7">Set the product status.</div>
                    <!--end::Description-->
                    <!--begin::Datepicker-->
                    <div class="d-none mt-10">
                        <label for="kt_ecommerce_add_product_status_datepicker" class="form-label">Select publishing date and time</label>
                        <input class="form-control" id="kt_ecommerce_add_product_status_datepicker" placeholder="Pick date &amp; time" />
                    </div>
                    <!--end::Datepicker-->
                    <div class="fv-plugins-message-container invalid-feedback"></div>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Status-->
            <!--begin::Category & tags-->
            <div class="card card-flush py-4 mb-md-5 mb-5">
                <!--begin::Card header-->
                <div class="card-header">
                    <!--begin::Card title-->
                    <div class="card-title">
                        <h2>Product Categories</h2>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <div class="fv-row">
                        <!--begin::Select2-->
                        <select  name="category" class="form-select mb-2" data-control="select2" data-placeholder="Select an option" required="required" value="">
                            <option></option>
                            <?php foreach ($biz->CategoryList() as $data) :?>
                            <option class="" value="<?=$data['id']?>"> <?= ucwords($data['name']) ?> </option>
                                <?php if($data['children']): ?>
                                <?php foreach ($data['children'] as $data2) :?>
                                <option value="<?=$data2['id']?>"> <?= ucwords($data2['name']) ?> <small>(<?= ucwords($data['name']) ?>)</small> </option>
                                <?php endforeach;?>
                                <?php endif;?>
                            <?php endforeach;?>
                        </select>
                        <!--end::Select2-->
                        <!--begin::Description-->
                    </div>
                    <div class="text-muted fs-7 mb-7">Add product to a category.</div>
                    <!--end::Description-->
                    <!--end::Input group-->
                    <!--begin::Button-->
                    <a href="<?= route_to('menucategory', $biz->slug) ?>" id="test" class="btn btn-light-primary btn-sm mb-10">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                    <span class="svg-icon svg-icon-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->Create new category</a>
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Category & tags-->
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xl-9">
            <!--begin::General options-->
            <div class="card card-flush py-4 mb-md-5 mb-5">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>General</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="required form-label">Product Name</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="text" name="name" class="form-control mb-2"  required="required" placeholder="Product name" value="" />
                        <!--end::Input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">A product name is required and recommended to be unique.</div>
                        <!--end::Description-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="form-label">Description</label>
                        <!--end::Label-->
                        <!--begin::Description-->
                        <textarea name="desc" class="form-control mb-2" rows="3"></textarea>
                        <!--end::Input-->
                        <!--end::Description-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set a description to the product for better visibility.</div>
                        <!--end::Description-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="fv-row mb-10">
                        <!--begin::Label-->
                        <label class="required form-label">Price</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <input type="number" name="price" class="form-control mb-2" placeholder="Product price"  required="required" value="" />
                        <!--end::Input-->
                        <!--begin::Description-->
                        <div class="text-muted fs-7">Set the product price.</div>
                        <!--end::Description-->
                        <div class="fv-plugins-message-container invalid-feedback"></div>
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::General options-->
            <?php if ($biz->biz_type == VENDOR_REST) :?>
            <!--begin::Variations-->
            <div class="card card-flush py-4 mb-md-5 mb-5">
                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title">
                        <h2>Add-Up Menu Variations</h2>
                    </div>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body pt-0">
                    <!--begin::Input group-->
                    <!--begin::Repeater-->
<div id="addup_menu_repeater">
    <!--begin::Form group-->
    <div class="form-group">
        <div data-repeater-list="addup_menu_repeater_outer">
            <div class="mb-2" data-repeater-item>
                <div class="form-group row">
                    <div class="col-md-10 col-xs-10">
                        <div class="form-group row mt-3">
                            <div class="col-md-6">
                                <div class="mb-5">   
                                <!-- <label class="form-label text-muted ">Add-Up Menu Ctgy Name:</label> -->
                                <!-- <span class="form-text text-muted ">Add-Up Menu Ctgy Name:</span> -->
                                
                                    <h5 class="fw-bold form-text text-muted required">Add-Up Menu Ctgy Name</h5>
                                    <input type="text" class="form-control form-control-lg mb-2 mb-md-0" required="required" name="addupctgy" placeholder="Addup Menu Ctgy name" />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-5"> 
                                    <h5 class="fw-bold form-text text-muted required ">Add-Up Menu Option Type</h5>
                                    <!-- <span class="form-text text-muted ">Add-Up Menu Option Type</span> -->
                                    <div class="btn-group btn-group-sm w-100 w-lg-50" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                        <label class="btn btn-smm btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                            <input class="btn-checkk" checked="checked" type="radio" required="required" name="adduptype" value="radio button" /> RadioButton
                                        </label>
                                        <label class="btn btn-smm btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-success" data-kt-button="true">
                                            <input class="btn-checkk" type="radio" required="required" name="adduptype" value="checkbox" /> CheckBox
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row mt-3">
                            <label class="col-md-3 col-form-label text-right">Menu Details</label>
                            <div class="addup-menu-repeater col-md-9" >
                                <div data-repeater-list="addup_menu_repeater_inner">
                                    <div data-repeater-item>
                                        <div class="form-group row">
                                            <div class="col-md-5 col-12">
                                                <div class="form-floating mb-2 mb-md-0">
                                                    <input type="text" class="form-control form-control-sm" id="" required="required" name="addupname" placeholder=""/>
                                                    <label class="required">Add-Up Menu Name</label>
                                                </div>
                                                <!-- <input type="text" class="form-control form-control-sm mb-2 mb-md-0" required="required" name="addupname" placeholder="Add-Up Menu Name" /> -->
                                            </div>
                                            <div class="col-md-5 col-8">
                                                <div class="form-floating mb-2 mb-md-0">
                                                    <input type="number" class="form-control form-control-sm" id="" required="required" name="addupprice" placeholder=""/>
                                                    <label>Add-Up Menu Price</label>
                                                </div>
                                                <!-- <input type="number" class="form-control form-control-sm mb-2 mb-md-0" name="addupprice" placeholder="Add-Up Menu Price" /> -->
                                            </div>
                                            <div class="col-md-2 col-4">
                                                <button type="button" data-repeater-delete="" class="btn btn-sm btn-icon btn-light-danger">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor"></rect>
                                                            <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor"></rect>
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->
                                                </button>
                                            </div>
                                        </div>
                                        <div class="separator separator-dashed my-5"></div>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <div class="col">
                                        <button class="btn btn-sm btn-light-primary" data-repeater-create type="button">
                                            <i class="la la-plus"></i> Add Add-Up Menu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="separator separator-dashed my-10"></div>
                    </div>
                        <div class="col-md-2 col-xs-2">
                            <a href="javascript:;" data-repeater-delete class="btn btn-sm btn-light-danger mt-3 mt-md-8">
                                <i class="la la-trash-o"></i>Delete Row
                            </a>
                        </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Form group-->

    <!--begin::Form group-->
    <div class="form-group mt-5">
        <a href="javascript:;" data-repeater-create class="btn btn-sm btn-light-primary">
            <i class="la la-plus"></i>Add another variation
        </a>
    </div>
    <!--end::Form group-->
</div>
<!--end::Repeater--><!--end::Input group-->
                </div>
                <!--end::Card header-->
            </div>
            <!--end::Variations-->
            <?php endif ;?>
            <div class="d-flex justify-content-end">
                <!--begin::Button-->
                <button type="submitt" id="menu_submit" class="btn btn-primary">
                    <span class="indicator-label">Save Menu</span>
                    <span class="indicator-progress">Please wait... 
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <!--end::Button-->
            </div>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Form-->
    </form>

</div>
<!--end::Container-->

<?= $this->endsection() ?>

<?=$this->section("scripts")?>
    <script>var biz_id = <?= json_encode($biz->id)?>;</script>
	<?php if ($biz->biz_type == VENDOR_REST) :?><script src="<?=base_url('admin/plugins/custom/formrepeater/formrepeater.bundle.js')?>"></script><?php endif ;?>
    <script src="<?=base_url('admin/js/custom/datatable/vendor_menu.js')?>"></script>
<?=$this->endSection()?>
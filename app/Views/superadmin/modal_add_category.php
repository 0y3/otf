<!--begin::Modal - New Address-->
<div class="modal fade" id="newCategoryModal" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content">
            <!--begin::Form-->
            <form id="modal_ctgy_form" class="form fv-plugins-bootstrap5 fv-plugins-framework" action="<?= site_url('otfadmin/add//menu-category/'.$biz->id)?>" method="POST">
                <!--begin::Modal header-->
                <div class="modal-header" id="">
                    <!--begin::Modal title-->
                    <h2 class="fw-bolder ctgyheader">Add Menu Category</h2>
                    <!--end::Modal title-->
                    <!--begin::Close-->
                    <div id="modal_ctgy_close" class="btn btn-icon btn-sm btn-active-icon-primary">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor"></rect>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor"></rect>
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--end::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body py-10 px-lg-17">
                    <!--begin::Scroll-->
                    <div class="d-flex flex-column scroll-y me-n7 pe-7">
                        <div class="fw-bolder fs-3 rotate collapsible mb-7"><?=esc(ucwords( $biz->name))?> CTGY</div>
                        
                        <div id="" class="ctgybody"> </div>

                        <div class="d-flex flex-column mb-7 fv-row fv-plugins-icon-container">
                            <label class="fs-6 fw-bold mb-2 required">Category Name</label>
                            <input class="form-control form-control-solid" placeholder="" name="name" required="required" value="">
                            <div class="fv-plugins-message-container invalid-feedback"></div>
                        </div>

                        
                    </div>
                    <!--end::Scroll-->
                </div>
                <!--end::Modal body-->
                <!--begin::Modal footer-->
                <div class="modal-footer flex-center">
                    <!--begin::Button-->
                    <button type="reset" id="modal_ctgy_cancel" class="btn btn-light me-3">Discard</button>
                    <!--end::Button-->
                    <!--begin::Button-->
                    <button type="submit" id="modal_ctgy_submit" class="btn btn-primary">
                        <span class="indicator-label">Submit</span>
                        <span class="indicator-progress">Please wait... 
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
                </div>
                <!--end::Modal footer-->
            <div></div></form>
            <!--end::Form-->
        </div>
    </div>
</div>
<!--end::Modal - New Address-->
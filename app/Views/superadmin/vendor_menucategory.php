<?= $this->extend('superadmin/layout') ?>


<?= $this->section('content') ?>
<!--begin::Container-->
<div class="container-xxl overlay"> 
    <!--begin::Navbar-->
    <?= $this->include('superadmin/vendors_details_menu') ?>
    <!--end::Navbar-->

    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Category Management 
                <!-- <span class="d-block text-muted pt-2 font-size-sm">Vendor management made easy</span></h3> -->
            </div>
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-2"></span>
                <input type="text" data-kt-catemenu-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Category"/>
            </div>
            <!--end::Search-->
            <div class="card-toolbar">

                <!--begin::Export dropdown-->
                <div class="m-2">
                    <a href="javascript:" class="btn btn-primary font-weight-bolder" data-bs-toggle="modal" data-bs-target="#newCategoryModal" data-modaltype="addctgy" data-innit="<?=$biz->id?>">Add Category</a>
                </div>
                    
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body ">
            <!--begin: Datatable-->
            <!-- <div class="datatable datatable-bordered datatable-head-custom" ><table class="display" id="kt_vendor_datatable"></table></div> -->
            <!--end: Datatable-->
            <!--begin::Datatable-->
            <table id="kt_cate_menu" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    
                    <th></th>
                    <?= ($biz->biz_type != VENDOR_REST) ? '<th>Sub-Ctgy No</th>' : '' ?>
                    <th>Ctgy Name</th>
                    <th>Created At</th>
                    <th>Sort</th>
                    <th>Menu No</th>
                    <th class="text-end min-w-100px">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-600 fw-bold">
                </tbody>
            </table>
            <!--end::Datatable-->

        </div>
        <!--end::Body-->
    </div>
    <!--end::Card-->
</div>
<!--end::Container-->

<!-- Add Vendor modal -->
<?= $this->include('superadmin/modal_add_category') ?>
<!-- /Add Vendor modal -->

<?= $this->endsection() ?>

<?=$this->section("scripts")?>
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/crypto-js/4.1.1/crypto-js.min.js"></script> -->
    <script type="text/javascript">
        let data = <?= json_encode($biz->CategoryList())?>;
        let biz_type = <?= json_encode($biz->biz_type)?>;

        // Encrypt
        const encrypted = CryptoJS.AES.encrypt(JSON.stringify(data), 'secret key 123').toString();//CryptoJS.AES(data);

        // Decrypt
        let bytes  = CryptoJS.AES.decrypt(encrypted, 'secret key 123');
        const decrypted = JSON.parse(bytes.toString(CryptoJS.enc.Utf8));
        
        console.log(encrypted)
        console.log()
        console.log(decrypted)
    </script>
    <script src="<?=base_url('admin/js/custom/datatable/vendor_menu.js')?>"></script>
<?=$this->endSection()?>
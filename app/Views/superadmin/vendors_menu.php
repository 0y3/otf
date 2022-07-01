<?= $this->extend('superadmin/layout') ?>


<?= $this->section('content') ?>
<!--begin::Container-->
    <div class="container-xxl"> 
    <!--begin::Navbar-->
    <?= $this->include('superadmin/vendors_details_menu') ?>
    <!--end::Navbar-->
	
    <!--begin::Card-->
    <div class="card">
        <!--begin::Header-->
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Vendors Menus
                <!-- <span class="d-block text-muted pt-2 font-size-sm">Vendor management made easy</span></h3> -->
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body ">
            <!--begin: Datatable-->
            <!-- <div class="datatable datatable-bordered datatable-head-custom" id="kt_datatable"></div> -->
            <!--end: Datatable-->
            <!--begin::Datatable-->
            <table id="kt_vendor_menu_datatable" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    
                    <th></th>
                    <th></th>
                    <th>Created</th>
                    <th>Category</th>
                    <th>Menu</th>
                    <th class="mw-200px">description</th>
                    <th>Price</th>
                    <th>Sort No.</th>
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

<?= $this->endsection() ?>

<?=$this->section("scripts")?>
    <script>var data = <?= json_encode($menuByCategoryMenu)?>;</script>
    <script src="<?=base_url('admin/js/custom/datatable/vendor_menu.js')?>"></script>
<?=$this->endSection()?>
<?= $this->extend('superadmin/layout') ?>


<?= $this->section('content') ?>
<!--begin::Container-->
<div class="container-xxl overlay"> 
    <!--begin::Card-->
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
                <h3 class="card-label">Orders 
                <!-- <span class="d-block text-muted pt-2 font-size-sm">Vendor management made easy</span></h3> -->
            </div>
            <!--begin::Search-->
            <div class="d-flex align-items-center position-relative my-1">
                <span class="svg-icon svg-icon-2"></span>
                <input type="text" data-kt-order-table-filter="search" class="form-control form-control-solid w-250px ps-15" placeholder="Search Orders"/>
            </div>
            <!--end::Search-->
            <div id="kt_orders_filter" class="d-none"></div>
            <div class="card-toolbar">
                <!--begin::Filter-->
                <div class="m-2 w-150px">
                    <!--begin::Input-->
                    <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Order Status" name="biz_status_filter" data-kt-order-table-filter="status">
                        <option></option>
                        <option value="All">All</option>
                        <option value="Pending">Pending</option>
                        <option value="Processing">Processing</option>
                        <option value="Dispatched">Dispatched</option>
                        <option value="Delivered">Delivered</option>
                        <option value="Canceled">Canceled</option>
                    </select>
                    <!--end::Input-->
                </div>
                    <!--end::Filter-->
                
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Body-->
        <div class="card-body ">
            <!--begin: Datatable-->
            <!-- <div class="datatable datatable-bordered datatable-head-custom" ><table class="display" id="kt_vendor_datatable"></table></div> -->
            <!--end: Datatable-->
            <!--begin::Datatable-->
            <table id="order_table" class="table align-middle table-row-dashed fs-6 gy-5">
                <thead>
                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                    
                    <th></th>
                    <th></th>
                    <th>Paymenr Id</th>
                    <th>Date</th>
                    <th>Customer</th>
                    <th>Company</th>
                    <th>Payment Method</th>
                    <th class="min-w-150xpx">Amount</th>
                    <th>Status</th>
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
    <script>var data = <?= json_encode($order)?>;</script>
    <script src="<?=base_url('admin/js/custom/datatable/order.js')?>"></script>
<?=$this->endSection()?>
"use strict";

var KTDatatables = function() {
    // Shared variables
    let table = '#order_table';
    let dt;
    // Private functions
    var initDatatable = function() {
        dt = $(table).DataTable({
            data: data,
            responsive: false,
            // stateSave: true,
            pageLength: 20,
            lengthMenu: [
                [20, 50, 100, 200, 500, -1],
                [20, 50, 100, 200, 500, 'All'],
            ],
            // deferRender:    true,
            // scrollY:        200,  //
            // scrollCollapse: true,
            // scroller:       true
            order: [
                [3, 'asc']
            ],
            columns: [
                { data: 'id' },
                { data: null },
                { data: 'pi_id' },
                { data: 'pi_paid_at' },
                { data: 'user_id' },
                { data: 'biz_name' },
                { data: 'pi_card_type' },
                { data: 'grand_total' },
                { data: 'order_status' },
                { data: null }
            ],
            columnDefs: [{
                    targets: 0,
                    orderable: false,
                    searchable: false,
                },
                {
                    targets: 1,
                    data: null,
                    orderable: false,
                    searchable: false,
                    render: function(data, type, row) {
                        return `
                                <button type="button" class="btn btn-sm btn-icon btn-light btn-active-light-primary toggle h-25px w-25px position-relative submenubutton" data-bs-toggle="tooltip" data-bs-custom-class="tooltip-dark" data-bs-placement="bottom" title="Order Details">
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                    <span class="svg-icon svg-icon-3 m-0 toggle-off">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr089.svg-->
                                    <span class="svg-icon svg-icon-3 m-0 toggle-on">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>`;
                    }
                },
                {
                    targets: 2,
                    render: function(data, type, row) {
                        return `<a href="${base_url}/otfadmin/orders/${row['pi_reference']}" class="text-gray-800 text-hover-primary fw-bolder"">#${data}</a>`;
                    }
                },
                {
                    targets: 3,
                    render: function(data, type, row) {
                        // return moment(data).format("Do MMM, YYYY LT"); 
                        return `${moment(data).fromNow()} <br><span class="badge badge-light fw-bolder text-gray-800 fs-7" > ${moment(data).format("Do MMM, YYYY LT")} </span>`;
                        // moment(data).format("lll");
                    }
                },
                {
                    targets: 4,
                    render: function(data, type, row) {
                        return `
                                <div class="d-flex align-items-center">
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column ms-2">
                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-7">${row['user_details']['surname']} ${row['user_details']['firstname']}</span>
                                        <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">${row['user_details']['phone']}</span>
                                        <span class="badge badge-light fs-7">${row['user_details']['email']}</span>
                                    </div>
                                    <!--end::Name-->
                                </div>`;
                    }
                },
                {
                    targets: 5,
                    render: function(data, type, row) {
                        var stateNo = KTUtil.getRandomInt(0, 7);
                        var states = [
                            'success',
                            'primary',
                            'danger',
                            'success',
                            'warning',
                            'dark',
                            'primary',
                            'info'
                        ];
                        let state = states[stateNo];
                        let img = (row['biz_details']['logo']) ?
                            '<div class="symbol symbol-30px symbol-2by3 flex-shrink-0 me-2"><img src= "' + base_url + '/img/vendor/' + row['biz_id'] + '/logo/' + row['biz_details']['logo'] + '"></div>' :
                            '<div class="symbol symbol-30px symbol-2by3 flex-shrink-0 me-2">\
                                                    <span class="symbol-label  bg-' + state + ' fs-2 fw-bold font-weight-bold">' + data.substring(0, 1) + '</span>\
                                                </div>';
                        return `
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    ${img}
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column ms-2">
                                        <span class="text-dark fw-bolder text-hover-primary mb-1 fs-7">${row['biz_details']['name']}</span>
                                        <span class="text-muted text-hover-primary fw-bold text-muted d-block fs-7">${row['biz_details']['phone']}</span>
                                        <span class="badge badge-light fs-7">${row['biz_details']['email']}</span>
                                    </div>
                                    <!--end::Name-->
                                </div>`;
                    }
                },
                {
                    targets: 6,
                    render: function(data, type, row) {
                        let card = (data == 'visa') ?
                            `<div class="symbol symbol-30px symbol-2by3 flex-shrink-0 me-1"><img src= "${base_url}/img/visa.svg"></div>` :
                            `<div class="symbol symbol-30px symbol-2by3 flex-shrink-0 me-1"><img src= "${base_url}/img/mastercard.svg"></div>`;

                        return `
                                <div class="d-flex align-items-center">
                                    <!--begin::Avatar-->
                                    ${card}
                                    <!--end::Avatar-->
                                    <!--begin::Name-->
                                    <div class="d-flex justify-content-start flex-column ms-1">****${row['pi_last4']}</div>
                                    <!--end::Name-->
                                </div>`;
                    }
                },
                {
                    targets: 7,
                    render: function(data, type, row) {
                        let status = 'text-danger';
                        if (row['status'] == 1) { status = 'text-success'; }
                        return `
                                <span class="fw-bold mb-1 fs-6 text-start pe-0 ${status}">₦${parseFloat(data).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</span>
                                <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">₦${parseFloat(row['total_order']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}(Order)</span>
                                <span class="text-gray-400 fw-semibold fs-7 d-block text-start ps-0">₦${parseFloat(row['delivery_fee']).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}(Delivery)</span>
                                `;
                    }
                },
                {
                    targets: 8,
                    render: function(data, type, row) {
                        let status = 'danger';
                        if (row['order_status'] == 'Canceled') { status = 'danger'; }
                        if (row['order_status'] == 'Pending') { status = 'warning'; }
                        if (row['order_status'] == 'Processing') { status = 'info'; }
                        if (row['order_status'] == 'Dispatched') { status = 'primary'; }
                        if (row['order_status'] == 'Delivered') { status = 'success'; }
                        return `<span class="badge badge-light-${status} fs-7">${data}</span>`;
                    }
                },
                {
                    targets: -1,
                    data: null,
                    orderable: false,
                    className: 'text-end',
                    render: function(data, type, row) {
                        return `
                        <div class="">
                            <a href="${base_url+'/otfadmin/customer/'+row['user_id']+'/'+row['id']}" class="btn btn-icon btn-flex btn-active-light-primary btn-sm w-30px h-30pxbtn-sm me-1">
                                <span class="svg-icon svg-icon-3">
                                    <!--begin::Svg Icon | path:/var/www/preview.keenthemes.com/metronic/releases/2021-05-14-112058/theme/html/demo8/dist/../src/media/svg/icons/General/Visible.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path opacity="0.5" d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z" fill="currentColor"/>
                                            <path opacity="0.5" d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z" fill="currentColor"/>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </a>
                        </div>
                        `;
                    },
                },
            ]
        });

        dt.on('order.dt search.dt', function() {
            let i = 1;

            dt.cells(null, 0, { search: 'applied', order: 'applied' }).every(function(cell) {
                this.data(i++);
            });
        }).draw();

        var subtableMenu = (e) => {
            // `e` is the original data object for the row
            let value = '<div class="col-md-80">' +
                '<table class="table table-bordered">';

            _.forEach(e.order_details, function(data) {
                let status = 'danger';
                if (data.order_status == 'Canceled') { status = 'danger'; }
                if (data.order_status == 'Pending') { status = 'warning'; }
                if (data.order_status == 'Processing') { status = 'info'; }
                if (data.order_status == 'Dispatched') { status = 'primary'; }
                if (data.order_status == 'Delivered') { status = 'success'; }
                var price = ((data.price == '')) ? 0 : parseFloat(data.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
                var grant_total = ((data.grant_total == '')) ? 0 : parseFloat(data.grant_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');

                let addup = '';
                _.forEach(JSON.parse(data.addup_menu), function(data1) {
                    if (data1.price) {
                        addup += _.upperFirst(data1.name) + ': <small class="text-dark fw-bolder fs-7">₦' + parseFloat(data1.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</small>, ';
                    } else {
                        addup += _.upperFirst(data1.cate_name) + ': <small class="text-dark fw-bolder fs-7">' + data1.name + '</small>, ';
                    }
                });


                value += `
                    <tr>
                        <td colspan="3">
                            <div class="text-gray-800 fs-7 w-150px">Order No.</div>
                            <div class="text-gray-800 text-hover-primary fs-7 fw-bolder">${_.upperFirst(data.order_code)}</div>
                        </td>
                        <td class="align-items-center min-w-125pxx">
                            <div class="text-gray-800 fs-7">Name</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.name)}</div>
                        </td>
                        <td class="align-items-center">
                            <div class="text-gray-800 fs-7">Qty</div>
                            <div class="text-muted fs-7 fw-bolder">${_.upperFirst(data.quantity)}</div>
                        </td>
                        <td>
                            <div class="text-gray-800 fs-7">Price</div>
                            <div class="text-muted fs-7 fw-bolder">₦${parseFloat(data.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}</div>
                        </td>
                        <td class="mw-200px">
                            <div class="text-gray-800 fs-7">Addup Menus</div>
                            <div class="text-muted fs-7 fw-bolder">${addup}</div>
                        </td>
                        <td>
                            <div class="text-gray-800 fs-7">Grand Total</div>
                            <div class="text-muted fs-7 fw-bolder">₦${grant_total}</div>
                        </td>
                        <td class="text-end">
                            <div class="text-gray-800 fs-7 me-3">Status</div>
                            <div class="text-muted fs-7 fw-bolder"><div class="badge badge-light-${status}">${_.upperFirst(data.order_status)}</div></div>
                        </td>
                        <td></td>
                    </tr>
                `;

            });
            value += '</table></div>';
            return value;
        };

        // Add event listener for opening and closing details
        $('#order_table tbody').on('click', '.submenubutton', function() {
            var tr = $(this).closest('tr');
            var row = dt.row(tr);

            if (row.child.isShown()) {
                // This row is already open - close it
                row.child.hide();
                $(this).removeClass('active');
                //tr.removeClass('isOpen');
            } else {
                // Open this row
                row.child(subtableMenu(row.data())).show();
                $(this).addClass('active');
                //tr.addClass('isOpen');
            }
        });
    }

    var handleSearchDatatable = function() {
            const filterSearch = document.querySelector('[data-kt-order-table-filter="search"]');
            filterSearch.addEventListener('keyup', function(e) {
                dt.search(e.target.value).draw();
            });
        }
        // Handle status filter dropdown
    var handleStatusFilter = () => {
            const filterStatus = document.querySelector('[data-kt-order-table-filter="status"]');
            $(filterStatus).on('change', e => {
                let value = e.target.value;
                if (value === 'All') {
                    value = '';
                }
                console.log(value);
                dt.column(8).search(value).draw();
            });
        }
        // Public methods
    return {
        init: function() {
            initDatatable();
            KTMenu.createInstances();
            handleSearchDatatable();
            handleStatusFilter();
        }
    }
}();


// On document ready
// KTUtil.onDOMContentLoaded(function () {
jQuery(document).ready(function() {
    KTDatatables.init();
});
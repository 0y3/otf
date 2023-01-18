/*
Template Name: OTF Online - Online Food Ordering Website HTML Template
Author: Trovolink
Version: 1.0
*/



(function($) {
    "use strict"; // Start of use strict

    // ===========Select2============
    $('select').select2();
    $(".locationselection").select2();

    // on click delivery location dropdown set session and hid modal
    $('.locationselection').on('select2:select', function(e) {
        $('.error_loc').text('');
        $("#deliveryLocateModal .locationselection").prop("disabled", true);
        axios.post(base_url + '/deliverylocation', {
                deliveryId: $(".locationselection").select2("val")
            })
            .then(function(response) {
                $('.span-delivery-location').html(response.data.deliveryLocateCity + ' (<small>' + response.data.deliveryLocateState + '</small>)');
            })
            .catch(function(error) {
                console.log(error);
            })
            .then(function() {
                $('#deliveryLocateModal').modal('hide');
            });
        //$('#deliveryLocateModal').modal('hide');
    });

    $('#deliveryLocateModal').on('show.bs.modal', function(event) {
        $(".locationselection").prop("disabled", false);
    });

    axios.get(`${base_url}/deliverylocation`)
        .then(function(response) {
            if (response.data !== '' && response.data.constructor === Object) {} else { $('#deliveryLocateModal').modal('show'); }
        })
        .catch(function(error) {
            console.log(error);
        });



    $('.osahan-category-item-a').on('click', function(e) {
        if (!$(".locationselection").select2("val")) {
            e.preventDefault();
            $('.locationselection').prop('required', true);
            $('.error_loc').text('You need to Select your delivery location First');
        }
    })

    $('input[type=radio][name=address_id]').change(function() {
        if ($(this).is(':checked')) {

            axios.post(base_url + '/deliveryaddress', {
                    userAddressId: $(this).val(),
                    deliveryId: $(this).data("deliverylocations"),
                })
                .then(function(response) {
                    $('.delivery-fee').attr('data-deliverylocationfee', response.data.fee);
                    $('.delivery-fee').html(`₦${ parseFloat(response.data.fee).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,')}`);

                    let sum_total = parseFloat(response.data.fee) + parseFloat($('.subtotal').attr('data-subtotal'));
                    $('.grand-total').text('₦' + parseFloat(sum_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
                })
                .catch(function(error) {
                    console.log(error);
                })
        }
    });
    // Add to NEW Address Button
    // $(document).on('click', '#user_address_submit', function(e) {
    $('#addAddress').submit(function(e) {
        // Prevent default button action
        e.preventDefault();
        var formData = new FormData($(this)[0]);
        axios.post(base_url + '/user/add/address', formData)
            .then(function(response) {
                // console.log(response.data.cart);
                location.reload(true);
            })
            .catch(function(error) {
                console.log(error);
            });
    });

    // ===========My Account Tabs============
    /*
    $(window).on('hashchange', function() {
        var url = document.location.toString();
        if (url.match('#')) {
            //$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
            $('a[href="' + window.location.hash + '"]').trigger('click');
        }
        $('.nav-tabs a').on('shown', function(e) {
            window.location.hash = e.target.hash;
        })
    });
    var url = document.location.toString();
    if (url.match('#')) {
        //$('.nav-tabs a[href=#'+url.split('#')[1]+']').tab('show') ;
        $('a[href="' + window.location.hash + '"]').trigger('click');
    }
    // Change hash for page-reload
    $('.nav-tabs a').on('shown', function(e) {
        window.location.hash = e.target.hash;
    })
    */

    // Category Owl Carousel
    const objowlcarousel = $('.owl-carousel-category');
    if (objowlcarousel.length > 0) {
        objowlcarousel.owlCarousel({
            responsive: {
                0: {
                    items: 3,
                },
                600: {
                    items: 4,
                },
                1000: {
                    items: 6,
                },
                1200: {
                    items: 8,
                },
            },
            loop: true,
            lazyLoad: true,
            autoplay: true,
            dots: false,
            autoplaySpeed: 1000,
            autoplayTimeout: 2000,
            autoplayHoverPause: true,
            nav: true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
        });
    }

    // Homepage Owl Carousel  
    var fiveobjowlcarousel = $(".owl-carousel-four");
    if (fiveobjowlcarousel.length > 0) {
        fiveobjowlcarousel.owlCarousel({
            responsive: {
                0: {
                    items: 1,
                },
                600: {
                    items: 2,
                },
                1000: {
                    items: 4,
                },
                1200: {
                    items: 4,
                },
            },

            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            nav: true,
            stopOnHover: true,
            navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"]
        });
    }

    // Owl Carousel Five
    var fiveobjowlcarousel = $(".owl-carousel-five");
    if (fiveobjowlcarousel.length > 0) {
        fiveobjowlcarousel.owlCarousel({
            responsive: {
                0: {
                    items: 2,
                },
                600: {
                    items: 3,
                },
                1000: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
            },
            lazyLoad: true,
            pagination: false,
            loop: true,
            dots: false,
            autoPlay: 2000,
            nav: true,
            stopOnHover: true,
            navText: ["<i class='icofont-thin-left'></i>", "<i class='icofont-thin-right'></i>"]
        });
    }

    // Homepage Ad Owl Carousel
    const mainslider = $('.homepage-ad');
    if (mainslider.length > 0) {
        mainslider.owlCarousel({
            responsive: {
                0: {
                    items: 1,
                },
                764: {
                    items: 1,
                },
                765: {
                    items: 1,
                },
                1200: {
                    items: 1,
                },
            },
            lazyLoad: true,
            loop: true,
            autoplay: true,
            autoplaySpeed: 1000,
            dots: false,
            autoplayTimeout: 5000,
            nav: true,
            navText: ["<i class='fa fa-chevron-left'></i>", "<i class='fa fa-chevron-right'></i>"],
            autoplayHoverPause: true,
        });
    }

    // Tooltip
    $('[data-toggle="tooltip"]').tooltip();

})(jQuery); // End of use strict


var menu_var = {
    "vendor_id": "",
    "menu_id": "",
    "menu_qty": 1,
    "menu_name": "",
    "menu_price": 0,
    "menu_subtotal": 0,
    "menu_addups": []
};
var addupd_count = 0;
var addups = [];
$('#addupMenuModal').on('hide.bs.modal', function(event) {
    _.remove(addups);
    menu_var = {
        "vendor_id": "",
        "menu_id": "",
        "menu_qty": 1,
        "menu_name": "",
        "menu_price": 0,
        "menu_subtotal": 0,
        "menu_addups": []
    };
    $('.addupmenu-modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>')
});

// add up menu modal 
$('#addupMenuModal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget); // Button that triggered the modal
    var menuid = button.data('menu');
    var menuname = button.data('name');
    var menuslug = button.data('mi');
    var bizslug = button.data('bi');
    var html = '';
    var modal = $(this);
    $('.addupmenu-modal-body').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>')

    axios.get('/restaurant/' + bizslug + '/' + menuslug, )
        .then(function(response) {
            //console.log(response.data);

            menu_var['vendor_id'] = response.data.menu.biz_id;
            menu_var['menu_id'] = response.data.menu.id;
            menu_var['menu_name'] = response.data.menu.name;
            menu_var['menu_price'] = parseFloat(response.data.menu.price);
            menu_var['menu_subtotal'] = parseFloat(response.data.menu.price);

            html += '<div class="dropdown-cart-top-header p-4 mb-1">'
            if (_.isEmpty(response.data.menu.image)) {
                html += '<img class="img-fluid mr-3" alt="osahan" src="' + base_url + '/img/logo_1.jpg">'
            } else {
                html += '<img class="img-fluid mr-3" alt="osahan" src="' + base_url + '/img/vendor/' + response.data.menu.biz_id + '/menus/' + response.data.menu.image + '">'
            }
            html += '<h6 class="mb-0">' + _.upperFirst(response.data.menu.name) + '</h6>'
            if (_.isNil(response.data.menu.description)) {} else {
                html += '<p class="text-secondary mb-0">' + response.data.menu.description + '</p>'
            }
            html += '<p class="text-gray mb-0 float-right ml-2">₦ <span class="menuprice">' + parseFloat(response.data.menu.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></p>'
            html += '<span class="count-number float-right" data-price="' + parseFloat(response.data.menu.price) + '" data-menu_id="" data-menu_name="' + response.data.menu.name + '">'
            html += '<button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>'
            html += '<input id="menuQTY_' + response.data.menu.id + '" class="count-number-input menuQTY" name="menupriceQty" type="text" min="1" value="1" readonly="">'
            html += '<button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>'
            html += '</span>'
            html += '</div>'

            if (_.isEmpty(response.data.addupMenuByCategory)) {} else {
                html += '<div class="dropdown-cart-top-body border-top p-4 mt-1">'
                    // html += '<p class="text-gray mb-0 float-right ml-2">$260</p>'
                    // html += '<span class="count-number float-right">'
                    // html += '<button class="btn btn-outline-secondary  btn-sm left dec"> <i class="icofont-minus"></i> </button>'
                    // html += '<input class="count-number-input" type="text" min="1" value="1" readonly="">'
                    // html += '<button class="btn btn-outline-secondary btn-sm right inc"> <i class="icofont-plus"></i> </button>'
                    // html += '</span>'
                    // html += '<p class="mt-1 mb-0 text-black">Cheese corn Roll</p>'

                //Add ups Menus list
                _.forEach(response.data.addupMenuByCategory, function(value1) {
                    if (_.isEmpty(value1.addupMenus)) {} else {

                        html += '<h6 class="pt-2">' + _.upperFirst(value1.name) + '</h6>'
                        html += '<div class="gold-members p-2 border-bottom">'
                        if (value1.addup_type == 'checkbox') {
                            _.forEach(value1.addupMenus, function(value) {
                                let addups_r = {};
                                addups_r['id'] = value.id;
                                addups_r['name'] = value.name;
                                addups_r['price'] = value.price;
                                addups_r['cate_id'] = value1.id;
                                addups_r['cate_name'] = value1.name;
                                addups[value.id] = addups_r;

                                html += '<div class="media"><div class="media-body">'
                                    //html += '<p class="mt-1 mb-0 text-black">' + value.name + '<span class="float-right text-dark">₦ <span class="menuprice">' + value.price + '</span></span></p>'
                                html += '<div class="custom-control custom-checkbox mb-2">'
                                html += '<input type="checkbox" class="custom-control-input menuaddups" id="customCheck' + value.id + '" name="menuaddups[]" value="' + value.id + '">'
                                html += '<label class="custom-control-label" for="customCheck' + value.id + '">' + _.upperFirst(value.name) + '</label>'
                                if (_.isEmpty(value.price)) {} else {
                                    html += '<span class="float-right text-dark">₦ <span class="menuprice">' + parseFloat(value.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></span>'
                                }
                                html += '</div>'
                                html += '</div></div>'
                            })
                        }
                        if (value1.addup_type == 'radio button') {
                            _.forEach(value1.addupMenus, function(value) {

                                let addups_r = {};
                                addups_r['id'] = value.id;
                                addups_r['name'] = value.name;
                                addups_r['price'] = value.price;
                                addups_r['cate_id'] = value1.id;
                                addups_r['cate_name'] = value1.name;
                                addups[value.id] = addups_r;

                                html += '<div class="media"><div class="media-body">'
                                html += '<div class="custom-control custom-radio mb-2">'
                                html += '<input type="radio" class="custom-control-input menuaddups" name="menuaddups[]" value="' + value.id + '" id="customRadio' + value.id + '">'
                                html += '<label class="custom-control-label" for="customRadio' + value.id + '">' + _.upperFirst(value.name) + '</label>'
                                if (_.isEmpty(value.price)) {} else {
                                    html += '<span class="float-right text-dark">₦ <span class="menuprice">' + parseFloat(value.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></span>'
                                }
                                html += '</div>'
                                html += '</div></div>'
                            })
                        }
                        html += '</div>'
                    }
                })
                html += '</div>'
            }

            //sub total
            html += '<div id="sub-total" class="dropdown-cart-top-footer border-top p-4">'
            html += '<p class="mb-0 font-weight-bold text-secondary">Sub Total <span class="float-right text-dark">₦ <span class="subtotalmenuprice">' + parseFloat(response.data.menu.price).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</span></span></p>'
            html += '</div>'
                //cart
            html += '<div class="dropdown-cart-top-footer border-top p-2">'
            html += '<a id="add_cart" class="btn btn-success btn-block btn-lg add_cart" href="javascript:;"> Add to Cart</a>'
            html += '</div>'
            $('.addupmenu-modal-body').html(html);
            //console.log(addups);
            //console.log(menu_var);
        })
        .catch(function(error) {
            console.log(error);
        });

    // modal.find('.modal-title').text(menuname + ' :-Menu ' + menuslug + '-' + bizslug)
    // modal.find('.modal-body input').val(menuid)
});
//click dec in addup menu list
// $('.dec').click((e) => {
$(document).on('click', '.dec', function(e) {
    let getnewmenuprice = 0;
    let inputmin = $('.count-number').find('#menuQTY_' + menu_var['menu_id']); // find the Quantity div
    var getoldinputmin = inputmin.val();

    const minValue = 1
    const currentInput = $(e.currentTarget).parent().next(); // get the prev parant div after des-button value
    const current_price = $(e.currentTarget).parent().data('price'); // get the price of product
    const current_id = $(e.currentTarget).parent().data('sub_menu_id'); // get the id of product
    const current_name = $(e.currentTarget).parent().data('sub_menu_name'); // get the name of product
    const subtotaldiv = $('.addupmenu-modal-body').find('#sub-total');
    // currentInput.css({ "background-color": "red" });
    //console.log($('.addupmenu-modal-body').find('#sub-total').attr('class'));
    if (getoldinputmin > minValue) {
        getoldinputmin--;
        getnewmenuprice = menu_var['menu_subtotal'] - menu_var['menu_price'];
        menu_var['menu_qty'] = getoldinputmin;
        menu_var['menu_subtotal'] = getnewmenuprice;
        //console.log(menu_var['menu_qty'] + '=' + menu_var['menu_price'] + '==' + getnewmenuprice);
    } else {
        getnewmenuprice = menu_var['menu_price'];
    }
    inputmin.val(getoldinputmin);
    subtotaldiv.find('.subtotalmenuprice').text(getnewmenuprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    //console.log(menu_var);
});


$(document).on('click', '.inc', function(e) {
    var inputmin = $('.count-number').find('#menuQTY_' + menu_var['menu_id']); // find the Quantity div
    var getoldinputmin = inputmin.val();

    const maxValue = 50;
    const subtotaldiv = $('.addupmenu-modal-body').find('#sub-total');

    if (getoldinputmin <= maxValue) {
        getoldinputmin++;
        getnewmenuprice = menu_var['menu_subtotal'] + menu_var['menu_price'];
        menu_var['menu_qty'] = getoldinputmin;
        menu_var['menu_subtotal'] = getnewmenuprice;
    }
    //console.log(getoldinputmin + '= ' + inputmin.attr('id'));
    inputmin.val(getoldinputmin);
    subtotaldiv.find('.subtotalmenuprice').text(getnewmenuprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    //console.log(menu_var);
});


$(document).on('change', 'input[name="menuaddups[]"]', function(e) {
    let getnewmenuprice = 0;
    const subtotaldiv = $('.addupmenu-modal-body').find('#sub-total');

    if ($(this).is(":checked") == true) {
        //alert($(this).val());
        let array_addups = _.find(addups, ['id', $(this).val()]);
        if (_.isEmpty(array_addups.price)) {
            getnewmenuprice = menu_var['menu_subtotal'];
        } else {
            getnewmenuprice = menu_var['menu_subtotal'] + parseFloat(array_addups.price);
            menu_var['menu_subtotal'] = getnewmenuprice;
        }

        var menu_addups_sort = [];

        $('input[name="menuaddups[]"]:checked').each(function() {
            var $this = $(this).val();
            var array_addups = _.find(addups, ['id', $(this).val()]);

            if (_.isEmpty(array_addups.price)) {
                var array_price = '';
            } else {
                var array_price = array_addups.price;
            }
            menu_addups_sort.push({
                id: array_addups.id,
                name: array_addups.name,
                price: array_price,
                cate_id: array_addups.cate_id,
                cate_name: array_addups.cate_name,
            });
            //array_addups = '';
        });
        menu_var['menu_addups'] = menu_addups_sort;
        //console.log(menu_var['menu_addups']);
    }
    if ($(this).is(":checked") == false) {
        let array_addups = _.find(addups, ['id', $(this).val()]);
        if (_.isEmpty(array_addups.price)) { getnewmenuprice = menu_var['menu_subtotal']; } else {
            getnewmenuprice = menu_var['menu_subtotal'] - parseFloat(array_addups.price);
            menu_var['menu_subtotal'] = getnewmenuprice;
        }

        _.remove(menu_var['menu_addups'], function(value, key, array) {
            return value.id == parseInt(array_addups.id);
        });
        // delete menu_var['menu_addups'][array_addups.id];



        console.log(menu_var['menu_addups']);
    }

    subtotaldiv.find('.subtotalmenuprice').text(getnewmenuprice.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));
    //console.log(addups);
    //console.log(menu_var);
});

// Add to cart Button
$(document).on('click', '.add_cart', function(e) {
    axios.post(base_url + '/addtocart', menu_var)
        .then(function(response) {

            checkoutView(response);
            $('#addupMenuModal').modal('hide');
            // console.log(response.data.cart);

        })
        .catch(function(error) {
            console.log(error);
        });

});

//Delete From Cart
$(document).on('click', '.del', function(e) {
    const current_row = $(e.currentTarget).parent().data('row'); // get the row

    axios.get('/removecart/' + current_row)
        .then(function(response) {
            checkoutView(response);
            $('#addupMenuModal').modal('hide');
            // console.log(response.data.cart);

        })
        .catch(function(error) {
            console.log(error);
        });

});


function checkoutView(response) {
    html = ''
    var x = 0;
    var sum_ = 0
    if (_.isEmpty(response.data.cart)) {
        last_url = current_url.split("/");
        last_url_str = last_url[last_url.length - 1];
        if (last_url_str == 'checkout') { window.location.reload(); }
        html += '<div class="gold-members p-2"><div class="media-body"><h6 class="mt-1 mb-0 text-black">No Order</h6></div></div></div>';
        $('#pad').html('');
    } else {
        _.forEach(response.data.cart, function(data) {

            html += '<div class="gold-members p-2 border-bottom">';
            html += '<p class="text-gray mb-0 float-right ml-2">₦' + parseFloat(data.total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</p>';
            //Edit & delete Button
            html += '<span id="' + data.rowid + '" class="count-number float-right" data-row="' + data.rowid + '">'
                //html += '<a href="javascript:;" class="btn btn-outline-info btn-sm left edi" data-toggle="tooltip" title="Edit!"><i class="icofont-edit-alt"></i> </a>'
            html += '<a href="javascript:;" class="btn btn-outline-danger btn-sm right del" data-toggle="tooltip" title="Delete!"> <i class="icofont-ui-delete"></i> </a>'
            html += '</span>';
            html += '<div class="media" data-toggle="tooltip" title="' + _.upperFirst(data.name) + ' x ' + data.qty + ' Qty">';
            //image
            html += '<div class="mr-2"><i class="icofont-food-cart text-success food-item"></i></div>'
            html += '<div class="media-body"><p class="mt-1 mb-0 text-black">' + _.upperFirst(data.name) + ' x ' + data.qty + ' Qty</p></div></div></div>';
            x = ++x;
        });
        sum_ = response.data.sum_total;
        $('#pad').html('<a href="' + current_url + '/checkout" class="btn btn-success btn-block btn-lg">Checkout <i class="icofont-long-arrow-right"></i></a>');
    }
    $('#order-count').text(parseInt(x) + ' Quantity');
    $('#checkout').html(html);
    $('.subtotal').attr('data-subtotal', sum_);
    $('.subtotal').text('₦' + parseFloat(sum_).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

    let sum_total = sum_ + parseFloat($('.delivery-fee').attr('data-deliverylocationfee'));
    $('.grand-total').text('₦' + parseFloat(sum_total).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

}
//axios('/api/biz');
// GET request for remote image in node.js
// Optionally the request above could also be done as
// axios.get('/api/biz', {
//     // params: {
//     //   ID: 12345
//     // }
//   })
//   .then(function (response) {
//     console.log(response);
//   })
//   .catch(function (error) {
//     console.log(error);
//   })
//   .then(function () {
//     // always executed
//   });

// check valid email formate
function ValidateEmail(input) {
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if (input.match(validRegex)) {
      console.log("Valid email address!");
      return true;
    } else {
        console.log("Invalid email address!");
        return false;
    }  
}
// Reset Password Button
$(document).on('click', '#resetpwd', function(e) {
    let resetEmail = $('input[type=email][name=forgotemail]').val();
    $('#forgotpasswordalert').html(``);
    if(ValidateEmail(resetEmail)){
        $('.forgotpasswordalert').html('<div class="d-flex justify-content-center"><div class="spinner-border" role="status"></div></div>')
        axios.post(`${base_url}/forgotpassword`, {
            email: resetEmail
        })
        .then(function(response) {
            console.log(response);
            if(response.data.status == 200){
                $('#forgotpasswordalert').html(`
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Email Sent Successfully!</strong> ${response.data.msg}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                `);
            }
            else{
                $('#forgotpasswordalert').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error Reseting Password!</strong> ${response.data.msg}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                `); 
                console.log(response.data.emailmsg)
            }
        })
        .catch(function(error) {
            console.log(error);
            $('#forgotpasswordalert').html(`
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error Reseting Password!</strong> Try again 
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                        </button>
                    </div>
                `); 
        });
    }
    else{
        $('#forgotpasswordalert').html(`
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Invalid Email!</strong> Check email fields if empty or wrong email formate.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
            </div>
        `);
    }

});

$('#forgotpasswordModal').on('hide.bs.modal', function(event) {
    $('#forgotpasswordalert').html(``);
    $('input[type=email][name=forgotemail]').val('');
});
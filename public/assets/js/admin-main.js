$(document).ready(function () {
    $("#frmAddCategory").validate({
        rules: {
            name: {
                required: true
            },
            image: {
                required: true
            },
            description: {
                required: true
            }
        }
    });

    $("#frmEditCategory").validate({
        rules: {
            name: {
                required: true
            },
            description: {
                required: true
            }
        }
    });

    $("#frmAddDeal").validate({
        rules: {
            category: {
                required: true
            },
            image: {
                required: true
            },
            name: {
                required: true
            },
            description: {
                required: true
            },
            end_date: {
                required: true
            }
        }
    });

    $("#frmEditDeal").validate({
        rules: {
            category: {
                required: true
            },
            name: {
                required: true
            },
            description: {
                required: true
            },
            end_date: {
                required: true
            }
        }
    });

    $("#frmAddProvider").validate({
        rules: {
            logo: {
                required: true
            },
            brand_name: {
                required: true
            },
            strap_line: {
                required: true
            },
            description: {
                required: true
            },
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            mobile: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            street: {
                required: true
            },
            city: {
                required: true
            },
            state: {
                required: true
            },
            zipcode: {
                required: true
            },
            available_for_zipcodes: {
                required: true
            },
            commission_rate: {
                required: true
            },
            whoop_credit: {
                required: true
            }
        }
    });

    $("#frmAddBoostCodeProvider").validate({
        rules: {
            name: {
                required: true
            },
            description: {
                required: true
            },
            country: {
                required: true
            },
            credits: {
                required: true
            },
            commission_rate: {
                required: true
            },
            image: {
                required: true
            }
        }
    });

    $("#frmEditBoostCodeProvider").validate({
        rules: {
            name: {
                required: true
            },
            description: {
                required: true
            },
            country: {
                required: true
            },
            credits: {
                required: true
            },
            commission_rate: {
                required: true
            }
        }
    });

    $(".deletecategory").click(function () {
        if (confirm("Are you sure you want to delete this?")) {
            var getCategoryId = $(this).data("id");
            var geturl = base_url + "/admin/category/destroy/" + getCategoryId;
            window.location.href = geturl;
        } else {
            return false;
        }
    });

    $(".deletedeal").click(function () {
        if (confirm("Are you sure you want to delete this?")) {
            var getDealId = $(this).data("id");
            var geturl = base_url + "/admin/deal/destroy/" + getDealId;
            window.location.href = geturl;
        } else {
            return false;
        }
    });

    $(".deletequote").click(function () {
        if (confirm("Are you sure you want to delete this?")) {
            var getQuoteId = $(this).data("id");
            var geturl = base_url + "/admin/quote-messages/destroy/" + getQuoteId;
            window.location.href = geturl;
        } else {
            return false;
        }
    });

    //Delete Providers
    $(".deleteimage").click(function () {
        var token = $('input[name="_token"]').val();
        var image = $('#delete_file').val();
        var imageType = $(this).data("type");
        var cid = $('#hdn_' + imageType + '_id').val();
        var $this = $(this);

        $.ajax({
            url: base_url + '/admin/' + imageType + '/edit/deleteImage',
            type: 'POST',
            dataType: "json",
            data: {image: image, id: cid, "_token": token},
            success: function (resp) {
                if (resp.success == true) {
                    $(".image").hide();
                    $this.hide();
                }
            }
        });
    });

    $('#deal_end_date').datetimepicker({
        autoclose: true
    });

    $("#available_for_zipcodes").tagsinput('items');

    //--jQuery MiniColors--
    $('.colorpicker').each(function () {
        $(this).minicolors({
            control: $(this).attr('data-control') || 'hue',
            defaultValue: $(this).attr('data-defaultValue') || '',
            inline: $(this).attr('data-inline') === 'true',
            letterCase: $(this).attr('data-letterCase') || 'lowercase',
            opacity: $(this).attr('data-opacity'),
            position: $(this).attr('data-position') || 'bottom left',
            change: function (hex, opacity) {
                if (!hex) return;
                if (opacity) hex += ', ' + opacity;
                try {
                    console.log(hex);
                } catch (e) {
                }
            },
            theme: 'bootstrap'
        });

    });

    function loadDeals(token, getCategoryId) {
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/admin/service-provider/add/getDeals',
            method: 'POST',
            data: {cat_id: getCategoryId, token: token},
            dataType: "json",
            success: function (response) {
                if (response.success == true) {
                    $(".deal-container span").hide();
                    $(".deal-container").html(response.data);
                } else {
                    $(".deal-container").html(response.data);
                }

            }
        });
    }

    var token = $('input[name="_token"]').val();
    $("#frmAddProvider #category, #frmEditProvider #category").change(function () {
        var getCategoryId = $(this).val();
        loadDeals(token, getCategoryId);
    });

    var getCategoryId = $("#category").val();
    loadDeals(token, getCategoryId);

    $(".deletecategory").click(function () {
        if (confirm("Are you sure you want to delete this?")) {
            var getCategoryId = $(this).data("id");
            var geturl = base_url + "/admin/category/destroy/" + getCategoryId;
            window.location.href = geturl;
        } else {
            return false;
        }
    });

    $(".deletedeal").click(function () {
        if (confirm("Are you sure you want to delete this?")) {
            var getDealId = $(this).data("id");
            var geturl = base_url + "/admin/deal/destroy/" + getDealId;
            window.location.href = geturl;
        } else {
            return false;
        }
    });


    $(".deleteprovider").click(function () {
        if (confirm("Are you sure you want to delete this?")) {
            var getProviderId = $(this).data("id");
            var geturl = base_url + "/admin/service-provider/destroy/" + getProviderId;
            window.location.href = geturl;
        } else {
            return false;
        }
    });

    $(".deleteimage").click(function () {
        var token = $('input[name="_token"]').val();
        var image = $('#delete_file').val();
        var imageType = $(this).data("type");
        var cid = $('#hdn_' + imageType + '_id').val();
        var $this = $(this);

        if (imageType == "provider") {
            imageType = "service-provider";
        }
        
        $.ajax({
            url: base_url + '/admin/' + imageType + '/edit/deleteImage',
            type: 'POST',
            dataType: "json",
            data: {image: image, id: cid, "_token": token},
            success: function (resp) {
                if (resp.success == true) {
                    $(".image").hide();
                    $this.hide();
                }
            }
        });
    });


    $(".deletevideo").click(function () {
        var token = $('input[name="_token"]').val();
        var video = $('#delete_video_file').val();
        var videoType = $(this).data("type");
        var cid = $('#hdn_' + videoType + '_id').val();
        var $this = $(this);

        if (videoType == "provider") {
            videoType = "service-provider";
        }
        
        $.ajax({
            url: base_url + '/admin/' + videoType + '/edit/deleteVideo',
            type: 'POST',
            dataType: "json",
            data: {video: video, id: cid, "_token": token},
            success: function (resp) {
                if (resp.success == true) {
                    $(".video").hide();
                    $(".deletevideo").hide();
                }
            }
        });
    });

    /** Common Delete Form **/
    $(".deleteForm").submit(function () {
        return confirm("Are you sure you want to delete this?");
    });

    /** Select2 **/
    $('.select2-single').select2();
    $('.select2-multiple').select2({
        tag: true
    });
});
<?php
/**
 * @author tmtuan
 * created Date: 11/30/2021
 * project: yamaha-revzone-website
 *
 * Template Name: cusProfile
 *
 */

get_header();

if (!is_user_logged_in()) {
    wp_redirect(get_bloginfo('home'));
    exit;
}

global $wpdb;
$table = $wpdb->prefix.'customer';

$current_user = wp_get_current_user();
$current_user_profile = $wpdb->get_row ( "SELECT * FROM $table WHERE user_id = {$current_user->ID}");
//print_r($current_user_profile); exit();

//get province
$dtTable = $wpdb->prefix.'province';
$province = $wpdb->get_results ( "SELECT * FROM $dtTable ");

echo get_template_part('includes/header/header-toolbar');
?>

<section class="categories-block">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="form">
                    <form method="post" >
                        <div class="note">
                            <p>User Profile Form</p>
                        </div>

                        <div class="form-content">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="fullname" value="<?=$current_user_profile->full_name?>"/>
                                    </div>
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="phone" value="<?=$current_user_profile->phone?>"/>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="email" value="<?=$current_user->user_email ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" name="address" value="<?=$current_user_profile->address?>"/>
                                    </div>
                                    <div class="form-group">
                                        <select class="form-control" name="gender">
                                            <option value="1" <?=$current_user_profile->gender==1?'selected':''?> >Nam</option>
                                            <option value="0" <?=$current_user_profile->gender==0?'selected':''?> >Nữ</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <select class="form-control" name="province_id" id="tmtProvince" >
                                            <option selected=""> Select City</option>
                                            <?php foreach( $province as $item ) : ?>
                                                <option value="<?=$item->province_id?>"> <?=$item->province_name?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div> <!-- form-group end.// -->

                                    <div class="form-group">
                                        <select class="form-control" name="district_id" id="tmtDistrict">
                                            <option selected=""> Select District</option>
                                        </select>
                                    </div> <!-- form-group end.// -->

                                    <div class="form-group">
                                        <select class="form-control" name="ward_id" id="tmtWard">
                                            <option selected=""> Select Ward</option>
                                        </select>
                                    </div> <!-- form-group end.// -->

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Current Password *" value=""/>
                                    </div>

                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Your Password *" value=""/>
                                    </div>
                                    <div class="form-group">
                                        <input type="text" class="form-control" placeholder="Confirm Password *" value=""/>
                                    </div>
                                </div>
                            </div>
                            <button type="button" class="btnSubmit">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<script type="text/javascript">
$(document).ready(function() {
    //get district
	$('#tmtProvince').on('change', function() {
        $.ajax({
            data: {
                action: 'get_district',
                province_id: $('#tmtProvince').val(),
            },
            type: 'post',
            url: ajaxurl,
            dataType: "json",
            success: function(response) {
                $('#tmtDistrict').find('option')
                    .remove();
                $.each(response.data,function(index, item)
                { console.log(item);
                    $("#tmtDistrict").append('<option value=' + item.district_id + '>' + item.type_name + ' ' + item.district_name + '</option>');
                });
            }
        });
	});

	//get wards
    $('#tmtDistrict').on('change', function() {
        $.ajax({
            data: {
                action: 'get_ward',
                district_id: $('#tmtDistrict').val(),
            },
            type: 'post',
            url: ajaxurl,
            dataType: "json",
            success: function(response) {
                $('#tmtWard').find('option')
                    .remove();
                $.each(response.data,function(index, item)
                {
                    $("#tmtWard").append('<option value=' + item.ward_id + '>' + item.type_name + ' ' + item.ward_name + '</option>');
                });
            }
        });
    });

});
</script>
<?php
get_footer();
?>
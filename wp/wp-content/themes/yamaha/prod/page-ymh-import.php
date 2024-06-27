<?php
/**
 * created Date: 07/03/2022
 * project: yamaha-revzone-website
 *
 * Template Name: Import Data
 *
 */
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php wp_title(''); ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1,user-scalable=no">
    <link rel="icon" type="image/x-icon" href="<?php echo get_template_directory_uri() ?>/img/favicon.ico" />
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/styles.min.css?v=<?php echo time() ?>">
    <script src="<?php echo get_template_directory_uri() ?>/js/vendor/jquery-3.5.1.min.js"></script>
    <style>
        .form-control {
            height: 100%;
        }
    </style>

</head>

<body>
    <?php
    // get_header();
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    require "wp-content/plugins/cbxphpspreadsheet-master/lib/vendor/autoload.php";

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Reader\Csv;
    use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

    $error = 0;

    if (isset($_POST['submit'])) {


        $file_mimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');

        if (isset($_FILES['file']['name']) && in_array($_FILES['file']['type'], $file_mimes)) {

            $arr_file = explode('.', $_FILES['file']['name']);
            $extension = end($arr_file);

            if ('csv' == $extension) {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }



            $spreadsheet = $reader->load($_FILES['file']['tmp_name']);

            $sheetCount = $spreadsheet->getSheetCount();
            $sheetDatas = [];
            //print_r($sheetCount);die;
            for ($i = 0; $i < $sheetCount; $i++) {
                $sheet = $spreadsheet->getSheet($i);
                $sheetDatas[$i] = $sheet->toArray();
            }


            $data = [];
            foreach ($sheetDatas as $t => $sheetData) {

                foreach ($sheetData  as $i => $sheets) {

                    if ($i == 0)
                        continue;
                    //print_r($sheets);die;

                    foreach ($sheets  as $k => $sheet) {
                        if ($k == 0 && $sheet == '')
                            break;
                        $key = $sheetData[0][$k];
                        $data[$t][$i][$key] =  $sheet;
                    }
                }
            }

            if ($_POST['type'] == 'bike') {

                $fields = $data[0];
                $feature_benefits =  $data[1];
                $specification_details =  $data[2];
                //$list_colors = $data[2];
                $specifications = $data[3];



                foreach ($fields as $field) {
                    if (!$field['title'])
                        break;

                    $args = array(
                        'post_type'     => 'product',
                        'post_title'    => $field['title'], //$order['name'],
                        'post_status'   => 'draft',
                        'post_author'   => 1,
                    );

                    $result = wp_insert_post($args);

                    if ($result && !is_wp_error($result)) {
                        $post_id = $result;
                        // Do something else
                    }

                    $term_id = term_exists($field['category'], 'products');
                    $term_id = is_array($term_id) ?  $term_id['term_id'] : $term_id;
                    wp_set_post_terms($post_id, array($term_id), 'products');

                    update_field('featured_bike', $field['featured_bike'], $post_id);
                    update_field('sku', $field['sku'], $post_id);

                    // feature group field
                    // $feature_img = get_attachment_id($field['feature_product[feature_img]']);
                    $feature = array(
                        'feature_title'    =>    $field['feature_product[feature_title]'],
                        'feature_type'    =>    $field['feature_product[feature_type]'],
                        // 'feature_img'    =>    $feature_img,
                        'feature_price'        =>    $field['feature_product[feature_price]']

                    );
                    update_field('feature_product', $feature, $post_id);

                    // background_banner group field
                    // $background = get_attachment_id($field['background_banner[background]']);
                    // $background_model = get_attachment_id($field['background_banner[background_model]']);
                    $background_banner = array(
                        'headline'    =>    $field['background_banner[headline]'],
                        // 'background'    =>    $background,
                        // 'background_model'    =>    $background_model,
                    );
                    update_field('background_banner', $background_banner, $post_id);

                    // overview group field
                    $colors = [];
                    $list_colors = explode(";", $field['overview[list_colors]']);

                    if ($list_colors) {


                        $colors['name_color'] = $list_colors[0];
                        $colors['price_color'] = $list_colors[1];
                        $colors['color_show_mobile'] = $list_colors[2];
                        $list_colors = $colors;
                        unset($colors);
                    }
                    // foreach ($list_colors as $list_color) {
                    //     if ($list_color['id'] != $field['overview[list_colors]']) {
                    //         continue;
                    //     }
                    //     //$list_color['image_color'] = get_attachment_id($list_color['image_color']);
                    //     // $colors[] = $list_color;
                    // }

                    $overview = array(
                        'overview_description'    =>   html_entity_decode('<p>' . $field['overview[overview_description]'] . '</p>'),

                        'list_colors' => [$list_colors]
                        // list color
                    );



                    //update_field('overview', $overview, $post_id);
                    update_field('field_61110d81fb562', $overview, $post_id);
                    //update_field('field_61110dcefb564', '11122', $post_id);




                    // feature_benefits repeater field


                    foreach ($feature_benefits as $feature_benefit) {
                        if ($feature_benefit['id'] != $field['feature_benefits']) {
                            continue;
                        }

                        // $image = get_attachment_id($feature_benefit['feature_benefits[image]']);
                        $featurebenefits = array(
                            'title'    =>    $feature_benefit['feature_benefits[title]'],
                            'description'    =>    $feature_benefit['feature_benefits[description]'],
                            // 'image' => $image

                        );

                        add_row('feature_benefits', $featurebenefits, $post_id);
                        //print_r($featurebenefits);die;
                    }

                    // specification_overview group field
                    // $e_brochure = get_attachment_id($field['specification_overview[e-brochure]']);
                    $specification_overview = array(
                        'video'    =>    $field['specification_overview[video]'],
                        'engine'    =>    $field['specification_overview[engine]'],
                        'hp_peak_power'    =>    $field['specification_overview[hp_peak_power]'],
                        'imu'    =>    $field['specification_overview[imu]'],
                        'wet_weight'    =>    $field['specification_overview[wet_weight]'],
                        'video'    =>    $field['specification_overview[video]'],
                        // 'e-brochure'    =>    $e_brochure,

                    );
                    update_field('specification_overview', $specification_overview, $post_id);

                    // feature_benefits repeater field

                    foreach ($specification_details as $specification_detail) {

                        if ($specification_detail['id'] != $field['specification_detail']) {
                            continue;
                        }

                        $_specifications = [];
                        foreach ($specifications as $_specification) {
                            if ($_specification['id'] != $specification_detail['specification']) {
                                continue;
                            }
                            //$list_colors['image_color'] = get_attachment_id($list_colors['image_color']);
                            $_specifications[] = $_specification;
                        }


                        //$image = get_attachment_id($specification_detail['image']);
                        $specificationdetails = array(
                            'headline'    =>    $specification_detail['headline'],
                            'specification' => $_specifications

                        );

                        add_row('specification_detail', $specificationdetails, $post_id);
                    }

                    // dealers

                    $dealers = $field['dealers'];
                    $dealers = explode(",", $dealers);
                    $data_dealers = [];
                    foreach ($dealers as $dealer) {

                        $data_dealers[] = get_page_by_title(trim($dealer), OBJECT, 'dealer')->ID;
                    }

                    update_field('dealers', $data_dealers, $post_id);
                }
            }

            if ($_POST['type'] == 'service') {

                $fields = $data[0];




                foreach ($fields as $field) {
                    if (!$field['title'])
                        break;

                    $args = array(
                        'post_type'     => 'package',
                        'post_title'    => $field['title'], //$order['name'],
                        'post_status'   => 'draft',
                        'post_author'   => 1,
                    );

                    $result = wp_insert_post($args);

                    if ($result && !is_wp_error($result)) {
                        $post_id = $result;
                        // Do something else
                    }

                    $term_id = term_exists(trim($field['category']), 'products');
                    $term_id = is_array($term_id) ?  $term_id['term_id'] : $term_id;

                    wp_set_post_terms($post_id, array($term_id), 'products');

                    $term_id = term_exists(trim($field['type_services']), 'type_services');
                    $term_id = is_array($term_id) ?  $term_id['term_id'] : $term_id;

                    wp_set_post_terms($post_id, array($term_id), 'type_services');

                    update_field('name_bike', $field['name_bike'], $post_id);
                    update_field('price', $field['price'], $post_id);
                    update_field('number_service', $field['number_service'], $post_id);
                    update_field('month', $field['month'], $post_id);
                    update_field('short_content', $field['short_content'], $post_id);

                    // $image = get_attachment_id($field['image']);
                    // update_field('image', $image, $post_id);


                    update_field('content', $field['content'], $post_id);

                    $bikes = $field['list_service_bike'];
                    $bikes = explode(",", $bikes);
                    $data_bikes = [];
                    foreach ($bikes as $bike) {
                        $data_bikes[] = get_page_by_title(trim($bike), OBJECT, 'product')->ID;
                    }

                    update_field('list_service_bike', $data_bikes, $post_id);
                }
            }

            if ($_POST['type'] == 'apparel') {


                $fields = $data[0];

                $list_images = $data[1];
                $sizes = ['XS', 'S', 'M', 'L', 'XL', 'XXL'];


                foreach ($fields as $field) {
                    if (!$field['title'])
                        break;

                    $args = array(
                        'post_type'     => 'item',
                        'post_title'    => $field['title'], //$order['name'],
                        'post_status'   => 'draft',
                        'post_author'   => 1,
                    );

                    $result = wp_insert_post($args);

                    if ($result && !is_wp_error($result)) {
                        $post_id = $result;
                        // Do something else
                    }

                    $term_id = term_exists(trim($field['apparels']), 'apparels');
                    $term_id = is_array($term_id) ?  $term_id['term_id'] : $term_id;

                    wp_set_post_terms($post_id, array($term_id), 'apparels');

                    $term_id = term_exists(trim($field['tag']), 'tag');
                    $term_id = is_array($term_id) ?  $term_id['term_id'] : $term_id;

                    wp_set_post_terms($post_id, array($term_id), 'tag');

                    update_field('price', $field['price'], $post_id);
                    // Size checkbox field
                    $_sizes = $field['size'];
                    $_sizes = explode(",", $_sizes);

                    update_field('field_6149bad740ea2', $_sizes, $post_id);
                    update_field('sku', $field['sku'], $post_id);
                    update_field('description', $field['description'], $post_id);
                    update_field('guide', '<img src="' . $field['guide'] . '">', $post_id);

                    // list_image repeater field

                    $list_images = explode(',', $field['list_image']);
                    foreach ($list_images as $list_image) {

                        // $image = get_attachment_id($list_image['image']);
                        $listimages = array(
                            // 'image' => $image,
                            'field_6149b70340e9f'    =>   $list_image
                        );

                        //update_field('field_6149b3e340e9d', $listimages, $post_id);
                        add_row('field_6149b3e340e9d', $listimages, $post_id);

                        //print_r($featurebenefits);die;
                    }

                    // dealers

                    $dealers = $field['dealers'];
                    $dealers = explode(",", $dealers);
                    $data_dealers = [];
                    foreach ($dealers as $dealer) {

                        $data_dealers[] = get_page_by_title(trim($dealer), OBJECT, 'dealer')->ID;
                    }

                    update_field('dealers', $data_dealers, $post_id);



                    // list_apparel
                    $list_apparels = $field['list_apparel'];
                    $list_apparels = explode(",", $list_apparels);
                    $data_apparels = [];
                    foreach ($list_apparels as $list_apparel) {
                        $data_apparels[] = get_page_by_title(trim($list_apparel), OBJECT, 'item')->ID;
                    }

                    update_field('list_apparel', $data_apparels, $post_id);
                }
            }

            $error = 1;

            // echo "Records inserted successfully.";
        } else {
            $error = 2;
            // echo "Upload only CSV or Excel file.";
        }
    }

    // Insert Bike
    ?>




    <div class="container">
        <div style="height: 80px;"></div>

        <?php if ($error == 1 && $error > 0) { ?>
            <div class="alert alert-success" role="alert">
                Records inserted successfully.
            </div>
        <?php }
        if ($error == 2 && $error > 0) {  ?>
            <div class="alert alert-danger" role="alert">
                Upload only CSV or Excel file.
            </div>
        <?php } ?>
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <a class="nav-link colorDark bold text-uppercase active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Import BIKE</a>
                <a class="nav-link colorDark bold text-uppercase" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Import SERVICE</a>
                <a class="nav-link colorDark bold text-uppercase" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Import APPAREL</a>
            </div>
        </nav>
        <div class="tab-content" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                <form enctype="multipart/form-data" method="post" class="form-service">
                    <div style="height: 40px;"></div>
                    <label class="fz14 colorDark bold text-uppercase">Import BIKE</label>
                    <div style="height: 20px;"></div>
                    <div class="row">
                        <div class="col-8">
                            <input type="file" name="file" class="form-control" />
                            <input type="hidden" name="type" value="bike" />
                        </div>
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn-clip btn-red">Import</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form enctype="multipart/form-data" method="post" class="form-service">
                    <div style="height: 40px;"></div>
                    <label class="fz14 colorDark bold text-uppercase">Import SERVICE</label>
                    <div style="height: 20px;"></div>
                    <div class="row">
                        <div class="col-8">
                            <input type="file" name="file" class="form-control" />
                            <input type="hidden" name="type" value="service" />
                        </div>
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn-clip btn-red">Import</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
                <form enctype="multipart/form-data" method="post" class="form-service">
                    <div style="height: 40px;"></div>
                    <label class="fz14 colorDark bold text-uppercase">Import APPAREL</label>
                    <div style="height: 20px;"></div>
                    <div class="row">
                        <div class="col-8">
                            <input type="file" name="file" class="form-control" />
                            <input type="hidden" name="type" value="apparel" />
                        </div>
                        <div class="col-4">
                            <button type="submit" name="submit" class="btn-clip btn-red">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>


        <div style="height: 80px;"></div>
    </div>

    <script src="<?php echo get_template_directory_uri() ?>/js/vendor/bootstrap.bundle.min.js"></script>
</body>

</html>


<?php
// get_footer();

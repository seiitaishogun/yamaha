<?php
get_header();
$page_id = get_queried_object_id();

?>

<div class="banner-single-full bg" style="background-image: url('<?php echo get_template_directory_uri() ?>/img/dealers/img-banner-dealers.jpg')">
    <div class="container-fluid">
        <div class="content-banner">
            <h1 class="title ff-1">LIÊN HỆ CHÚNG TÔI</h1>
        </div>
    </div>
</div>

<div class="contact-us">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <h2 class="title ff-1">LIÊN HỆ CHÚNG TÔI</h2>
                <div class="description">
                    <p><?php the_field('content', $page_id); ?></p>

                </div>

                <?php if(get_field('hotline', $page_id) !=='') : ?>
                <p><a href="tel:<?php the_field('hotline', $page_id); ?>" class="hotline"><img src="<?php echo get_template_directory_uri() ?>/img/contact/ic-phone.svg" alt="icon">Hotline: <?php the_field('hotline', $page_id); ?> </a></p>
                <?php endif; ?>

                <p><strong><img src="<?php echo get_template_directory_uri() ?>/img/contact/ic-email.svg" alt="icon">Email:</strong><a href="mailto:<?php the_field('email', $page_id); ?>"><?php the_field('email', $page_id); ?></a></p>
                <p><strong><img src="<?php echo get_template_directory_uri() ?>/img/contact/ic-location.svg" alt="icon">Địa chỉ:</strong><?php the_field('address', $page_id); ?></p>
            </div>
            <div class="col-md-7">
                <div class="map">
                    <iframe id="map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3919.617590807014!2d106.69003061526028!3d10.763926662366563!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752f16ea640001%3A0x18b87973a7a113f0!2sSunny%20Tower!5e0!3m2!1sen!2s!4v1631115155416!5m2!1sen!2s" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>

    </div>
</div>

<script type="text/javascript">
    let address = '<?php the_field('address', $page_id); ?>';
    $(document).ready(function() {

        let urlIframe = "https://maps.google.com/maps?width=600&amp;height=750&amp;hl=en&amp;q=" + address + "&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed";
        $('.map').html('<iframe id="map" width="100%" height="750px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' + urlIframe + '"></iframe>');

        $('.item-address').click(function() {
            $('.item-address').removeClass('active');
            $(this).addClass('active');
            let address = $(this).attr('data-address');

            //alert(address);

            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
                window.open("https://www.google.com/maps/place/" + address);
            } else {
                let urlIframe = "https://maps.google.com/maps?width=600&amp;height=750&amp;hl=en&amp;q=" + address + "&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed";
                $('.map').html('<iframe class="gmap_iframe" width="100%" height="750px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' + urlIframe + '"></iframe>');
            }
        });
    });
</script>

<?php
get_footer();
?>
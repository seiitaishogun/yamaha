<div class="f__block-social d-block d-lg-none d-xl-none">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center">
            <span class="colorLine">Kết nối với chúng tôi</span>
            <ul class="f__social">
                <li><a href="https://www.facebook.com/RevzoneYamahaMotor/" target="_blank" class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_fb.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_fb.svg)" class="icon"></span></a></li>
                <li><a href="https://www.instagram.com/revzoneyamahamotor_official/" target="_blank" class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ins.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ins.svg)" class="icon"></span></a></li>
                <!-- <li><a href="#." class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_tiktok.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_tiktok.svg)" class="icon"></span></a></li> -->
                <li><a href="https://www.youtube.com/channel/UCGo72CN4KLuO1nEd46cAL5g" target="_blank" class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ytb.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ytb.svg)" class="icon"></span></a></li>
            </ul>
        </div>
    </div>
</div>
<footer class="bgDark">
    <div class="container-fluid">
        <div class="row footer-pc">
            <div class="col-lg-4 col">
                <!-- <div class="company-info">
                    <div>CÔNG TY TNHH YAMAHA MOTOR VIỆT NAM</div>
                    <div>Số GCNĐKDN: XXXXXX</div>
                    <div>Cấp lần đầu: Ngày XXXXX</div>
                    <div>Đăng ký thay đổi lần thứ 10: Ngày XXXXX</div>
                    <div>Cơ quan cấp: Sở kế hoạch và Đầu tư TP Hà Nội</div>
                    <div>Trụ sở chính: Thôn Bình An, Xã Trung Giã, Huyện Sóc Sơn, TP Hà Nội</div>
                </div> -->
                <p class="text-operator">Revzone Yamaha Motor được tổ chức và vận hành chính thức bởi</p>
                <a href="<?php echo get_permalink(1364) ?>" class="f__logo">
                    <img src="<?php echo get_template_directory_uri() ?>/img/logo-footer.svg" alt="">
                </a>
                <div class="copyright">© 2022 Yamaha Motor Viet Nam</div>
            </div>
            <div class="col-lg-8 col">

                <div class="f__row">
                    <?php
                    $footer = wp_get_nav_menu_object(20);
                    $footer = wp_get_nav_menu_items('20');

                    $_footer = [];

                    foreach ($footer as $m) {
                        $_footer[$m->menu_item_parent][] = $m;
                    }

                    ?>
                    <?php foreach ($_footer[0] as $v) : ?>

                        <?php if (isset($_footer[$v->ID])) : ?>
                            <?php if (!in_array("last-column", $v->classes)) : ?>
                                <div class="f__col">
                                    <ul class="f__list">
                                        <li>
                                            <h6 class="bold ff-1 text-uppercase"><?php echo $v->title; ?></h6>
                                        </li>
                                        <?php foreach ($_footer[$v->ID] as $key => $_m) : ?>
                                            <li><a href="<?php echo $_m->url ?>" class=""><?php echo $_m->title; ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                </div>
                            <?php else : ?>
                                <div class="f__col">
                                    <ul class="f__list">
                                        <li>
                                            <h6 class="bold ff-1 text-uppercase"><?php echo $v->title; ?></h6>
                                        </li>
                                        <?php foreach ($_footer[$v->ID] as $key => $_m) : ?>
                                            <li><a href="<?php echo $_m->url ?>" class=""><?php echo $_m->title; ?></a></li>
                                        <?php endforeach ?>
                                    </ul>
                                    <div style="height: 30px;"></div>
                                    <ul class="f__list">
                                        <li>
                                            <h6 class="bold ff-1">Kết nối với chúng tôi</h6>
                                        </li>
                                        <ul class="f__social">
                                            <li><a href="https://www.facebook.com/RevzoneYamahaMotor/" target="_blank" class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_fb.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_fb.svg)" class="icon"></span></a></li>
                                            <li><a href="https://www.instagram.com/revzoneyamahamotor_official/" target="_blank" class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ins.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ins.svg)" class="icon"></span></a></li>
                                            <!-- <li><a href="#." class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_tiktok.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_tiktok.svg)" class="icon"></span></a></li> -->
                                            <li><a href="https://www.youtube.com/channel/UCGo72CN4KLuO1nEd46cAL5g" target="_blank" class=""><span style="mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ytb.svg); -webkit-mask-image: url(<?php echo get_template_directory_uri() ?>/img/ic_ytb.svg)" class="icon"></span></a></li>
                                        </ul>
                                    </ul>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endforeach ?>

                </div>
            </div>
        </div>
        <div class="footer-logo-mb d-lg-none">
            <!-- <div class="company-info">
                <div>CÔNG TY TNHH YAMAHA MOTOR VIỆT NAM</div>
                <div>Số GCNĐKDN: XXXXXX</div>
                <div>Cấp lần đầu: Ngày XXXXX</div>
                <div>Đăng ký thay đổi lần thứ 10: Ngày XXXXX</div>
                <div>Cơ quan cấp: Sở kế hoạch và Đầu tư TP Hà Nội</div>
                <div>Trụ sở chính: Thôn Bình An, Xã Trung Giã, Huyện Sóc Sơn, TP Hà Nội</div>
            </div> -->
            <p class="text-operator">Revzone Yamaha Motor được tổ chức và vận hành chính thức bởi</p>

            <a href="index.php" class="f__logo">
                <img src="<?php echo get_template_directory_uri() ?>/img/logo-footer.svg" alt="">
            </a>
        </div>
        <div class="accordion d-block d-lg-none d-xl-none pl-5 pr-5" id="f-accordion">
            <?php foreach ($_footer[0] as $k => $v) : ?>
                <?php if (isset($_footer[$v->ID])) : ?>
                    <div class="f__accordion mb-3">
                        <div class="f__accordion-item" id="heading1">
                            <button class="btn btn__f-accordion <?php echo $k != 0 ? 'collapsed' : '' ?>" type="button" data-toggle="collapse" data-target="#collapse-<?php echo $v->ID ?>" aria-expanded="true" aria-controls="collapse-<?php echo $v->ID ?>">
                                <?php echo $v->title; ?> <span class="cavet"></span>
                            </button>
                        </div>

                        <div id="collapse-<?php echo $v->ID; ?>" class="collapse <?php echo $k == 0 ? 'show' : '' ?>" aria-labelledby="heading1">
                            <ul class="f__list">
                                <?php foreach ($_footer[$v->ID] as $key => $_m) : ?>
                                    <li><a href="<?php echo $_m->url ?>" class=""><?php echo $_m->title; ?></a></li>
                                <?php endforeach ?>
                            </ul>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endforeach ?>
        </div>
    </div>
</footer>
<!-- <div class="container-fluid">
    <div class="f__end">
        <span class="colorDark fz12">© 2022 Yamaha Motor Viet Nam</span>
        <div class="dropdown">
            <button class="btn btn--flag dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img src="<?php echo get_template_directory_uri() ?>/img/flag_vn.png" alt=""> Vietnam
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="#." data-src="<?php echo get_template_directory_uri() ?>/img/flag_vn.png">Vietnam</a>
                <a class="dropdown-item" href="#." data-src="<?php echo get_template_directory_uri() ?>/img/flag_vn.png">English</a>
            </div>
        </div>

    </div>
</div> -->

    

</div>
<style type='text/css'>
    .embeddedServiceHelpButton .helpButton .uiButton {
        background-color: #005290;
        font-family: "Arial", sans-serif;
    }

    .embeddedServiceHelpButton .helpButton .uiButton:focus {
        outline: 1px solid #005290;
    }

    .embeddedServiceHelpButton {
        display: none;
    }
</style>

<script type='text/javascript' src='https://service.force.com/embeddedservice/5.0/esw.min.js'></script>
<script type='text/javascript'>
    var initESW = function(gslbBaseURL) {
        embedded_svc.settings.displayHelpButton = true; //Or false
        embedded_svc.settings.language = ''; //For example, enter 'en' or 'en-US'

        //embedded_svc.settings.defaultMinimizedText = '...'; //(Defaults to Chat with an Expert)
        //embedded_svc.settings.disabledMinimizedText = '...'; //(Defaults to Agent Offline)

        //embedded_svc.settings.loadingText = ''; //(Defaults to Loading)
        //embedded_svc.settings.storageDomain = 'yourdomain.com'; //(Sets the domain for your deployment so that visitors can navigate subdomains during a chat session)

        // Settings for Chat
        //embedded_svc.settings.directToButtonRouting = function(prechatFormData) {
        // Dynamically changes the button ID based on what the visitor enters in the pre-chat form.
        // Returns a valid button ID.
        //};
        //embedded_svc.settings.prepopulatedPrechatFields = {}; //Sets the auto-population of pre-chat form fields
        //embedded_svc.settings.fallbackRouting = []; //An array of button IDs, user IDs, or userId_buttonId
        //embedded_svc.settings.offlineSupportMinimizedText = '...'; //(Defaults to Contact Us)

        embedded_svc.settings.enabledFeatures = ['LiveAgent'];
        embedded_svc.settings.entryFeature = 'LiveAgent';

        embedded_svc.init(
            'https://yamahamotorsvietnam--dev.my.salesforce.com',
            'https://dev-yamahamotorsvietnam.cs5.force.com',
            gslbBaseURL,
            '00DO00000053w4k',
            'LiveChatGroup', {
                baseLiveAgentContentURL: 'https://c.la1-c1cs-ukb.salesforceliveagent.com/content',
                deploymentId: '572O000000000bf',
                buttonId: '573O000000000db',
                baseLiveAgentURL: 'https://d.la1-c1cs-ukb.salesforceliveagent.com/chat',
                eswLiveAgentDevName: 'LiveChatGroup',
                isOfflineSupportEnabled: true
            }
        );
    };

    if (!window.embedded_svc) {
        var s = document.createElement('script');
        s.setAttribute('src', 'https://yamahamotorsvietnam--dev.my.salesforce.com/embeddedservice/5.0/esw.min.js');
        s.onload = function() {
            initESW(null);
        };
        document.body.appendChild(s);
    } else {
        initESW('https://service.force.com');
    }
</script>
<script src="<?php echo get_template_directory_uri() ?>/js/vendor/bootstrap.bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/vendor/swiper-bundle.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/vendor/isotope.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/vendor/imagesloaded.pkgd.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/plugins.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@fancyapps/ui/dist/fancybox.umd.js"></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery-circle-progress/1.2.0/circle-progress.min.js'></script>
<script type="text/javascript" src="https://www.elevateweb.co.uk/wp-content/themes/radial/jquery.elevatezoom.min.js"></script>
<script src="<?php echo get_template_directory_uri() ?>/js/main.js?v=<?php echo time(); ?>"></script>
<!-- <script>
	showPopup('<div class="pt40 pb40"><div class="colorDark fnt-16 text-center pb20"><h4 class="colorDark fnt-oswald fnt-22 pb20">Thông báo:</h4><p>Website đang trong quá trình chạy thử nghiệm, tất cả những thông tin và hình ảnh chỉ mang tính chất minh họa.</p></div> <button type="button" id="btnContinue" class="btn-clip btn-border-red btn-small">Tiếp tục</button></div>', el=$('.popup_content'));
	$('#btnContinue').click(function(){hidePopup(); return false; });
</script> -->
</body>

</html>
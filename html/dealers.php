<?php include "includes/header.php" ?>

    <div class="banner-single-full bg" style="background-image: url('./img/dealers/img-banner-dealers.jpg')">
        <div class="container-fluid">
            <div class="content-banner">
                <h1 class="title ff-1">FIND A DEALER NEAR YOU</h1>
            </div>
        </div>
    </div>

    <div class="dealers-address">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-5">
                    <h2 class="title ff-1">DEALERS</h2>
                    <div class="group-dropdown">
                        <div class="dropdown dropdown--selected">
                            <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="label">PROVINCE <sup>*</sup></div>
                                <div class="title">Ho Chi Minh</div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="">
                                <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="Another action">Another
                                    action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="Something else here"></a>
                            </div>
                        </div>
                        <div style="width: 8px"></div>
                        <div class="dropdown dropdown--selected">
                            <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true"
                               aria-expanded="false">
                                <div class="label">DISTRICT <sup>*</sup></div>
                                <div class="title">District 4</div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="action">Another action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="action">Something else
                                    here</a>
                            </div>
                        </div>
                    </div>
                    <p class="text-result">12 results</p>
                    <div class="list-address">
                        <div class="item-address active" data-address="627 Cách mạng tháng 8, Phường 15, Quận 10, Tp Hồ Chí Minh">
                            <p><strong>Service Centers - Parts Yamaha</strong></p>
                            <p><img src="./img/dealers/icon-pin.svg" alt="icon">627 Cách mạng tháng 8, Phường 15, Quận 10, Tp Hồ Chí Minh</p>
                            <p><img src="./img/dealers/icon-phone.svg" alt="icon"><a href="tel:02839770730">028 39770730</a></p>
                        </div>

                        <div class="item-address" data-address="91B Nguyễn Văn Tạo, ấp 2, xã Long Thới, huyện Nhà Bè, thành phố Hồ Chí Minh">
                            <p><strong>YAMAHA 2S HIỆP PHƯỚC</strong></p>
                            <p><img src="./img/dealers/icon-pin.svg" alt="icon">91B Nguyễn Văn Tạo, ấp 2, xã Long Thới, huyện Nhà Bè, thành phố Hồ Chí Minh</p>
                            <p><img src="./img/dealers/icon-phone.svg" alt="icon"><a href="tel:02839770730">0286 2711335</a></p>
                        </div>

                        <div class="item-address" data-address="117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM">
                            <p><strong>YAMAHA YFS TP. HỒ CHÍ MINH</strong></p>
                            <p><img src="./img/dealers/icon-pin.svg" alt="icon">117A Lê Văn Khương, Phường Hiệp Thành, Quận 12, TP.HCM (Cách cầu vượt Tân Thới Hiệp 500m)</p>
                            <p><img src="./img/dealers/icon-phone.svg" alt="icon"><a href="tel:02839770730">0933.739.112</a></p>
                        </div>

                        <div class="item-address" data-address="290B/44A Dương Bá Trạc, Phường 1, Q8, TPHCM">
                            <p><strong>VẠN PHONG SÀI GÒN</strong></p>
                            <p><img src="./img/dealers/icon-pin.svg" alt="icon">290B/44A Dương Bá Trạc, Phường 1, Q8, TPHCM</p>
                            <p><img src="./img/dealers/icon-phone.svg" alt="icon"><a href="tel:02839770730">0933.739.112</a></p>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 d-md-block d-none mt-2">
                    <div class="map">
                        <iframe class="gmap_iframe" width="100%" height="750px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=600&amp;height=750&amp;hl=en&amp;q=627 Cach Mang Thang Tam, Ward 15, District 10, Ho Chi Minh City&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                    </div>
                </div>
            </div>
            <div class="bottom-link d-md-none text-center">
                <button type="button" class="btn-clip btn-red w-auto btn-viewall">VIEW ALL</button>
            </div>

        </div>
    </div>

    <script type="text/javascript">
        $(document).ready(function () {
            $(".h-box.gradient").css({background: '#1D1F21'});

            $('.item-address').click(function(){
                $('.item-address').removeClass('active');
                $(this).addClass('active');
                let address = $(this).attr('data-address');

                //alert(address);

                if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0,4))) { 
                    window.open("https://www.google.com/maps/place/" + address);
                }else{
                    let urlIframe = "https://maps.google.com/maps?width=600&amp;height=750&amp;hl=en&amp;q="+address+"&amp;t=p&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed";
                    $('.map').html('<iframe class="gmap_iframe" width="100%" height="750px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="' + urlIframe +'"></iframe>');
                }             
            });
        });
    </script>

<?php include "includes/footer.php" ?>
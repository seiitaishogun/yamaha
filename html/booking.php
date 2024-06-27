<?php include "includes/header_no_toolbar.php" ?>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<div class="bgGray">
    <div class="container-fluid">
        <div class="wrapper-container wrapper-container--sm">
            <div style="height: 16px;"></div>
            <h5 class="ff-1 colorDark text-uppercase">BOOKING</h5>
            <div style="height: 16px;"></div>
            <form action="" method="post">
                <div class="box-white">
                    <div class="booking__info">
                        <img src="img/moto.png" alt="">
                        <div class="group-dropdown">
                            <div class="dropdown dropdown--selected">
                                <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">type <sup>*</sup></div>
                                    <div class="title">Hyper Naked</div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="Another action">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="Something else here"></a>
                                </div>
                            </div>
                            <div style="width: 8px"></div>
                            <div class="dropdown dropdown--selected">
                                <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <div class="label">model <sup>*</sup></div>
                                    <div class="title">MT 09</div>
                                </a>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Another action</a>
                                    <a class="dropdown-item" href="javascript:void(0)" data-val="action">Something else here</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div style="height: 16px;"></div>

                <div class="box-white customer-info">
                    <div style="height: 24px;"></div>
                    <label for="" class="fz14 colorDark bold">YOUR INFORMATION</label>
                    <div style="height: 16px;"></div>
                    <div class="form-group form-ani">
                        <input type="text" name="name" />
                        <label for="">Name <span>*</span></label>
                    </div>
                    <div class="wrap-form d-flex">
                        <div class="form-group form-ani split">
                            <input type="text" name="phone_number" />
                            <label for="">Phone number <span>*</span></label>
                        </div>
                        <div class="form-group form-ani split">
                            <input type="text" name="email_address" />
                            <label for="">Email address <span>*</span></label>
                        </div>
                    </div>

                    <div class="form-group form-ani">
                        <input type="text" name="your_address" />
                        <label for="">YOUR ADDRESS <span>*</span></label>
                    </div>

                    <div class="form-group-important">
                        <label for="">FIND DEALER</label>
                        <div class="dropdown dropdown--selected">
                            <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="title">Yamaha 3S Hanh Lam <span class="tag">In stock</span></div>
                                <div class="label">143C Khánh Hội, Phường 3, Quận 4, TP. Hồ Chí Minh</div>

                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="javascript:void(0)" data-val="action">Action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="Another action">Another action</a>
                                <a class="dropdown-item" href="javascript:void(0)" data-val="Something else here"></a>
                            </div>
                        </div>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="form-group-important hide">
                        <label for="">DATE</label>
                        <div class="dropdown dropdown--selected dropdown--selected-date">
                            <a href="javascript:void(0)" class="btn" aria-haspopup="true" aria-expanded="false">
                                <div class="label">DATE <sup>*</sup></div>
                                <div class="title" id="title-date">&nbsp;</div>
                            </a>
                            <?php $date = date('Y-m-d'); ?>
                            <input class="datepicker">
                        </div>

                        <div style="height: 11px;"></div>

                        <label for="">TIME / SECTION OF DAY</label>
                        <div class="form-row">
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="time1" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="time1">
                                        <strong class="fz14">Morning</strong>
                                        <p class="fz12 colorLGray normal mb-0">08:00 AM - 11:00 AM</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="time2" name="customRadio" class="custom-control-input">
                                    <label class="custom-control-label" for="time2">
                                        <strong class="fz14">Afternoon</strong>
                                        <p class="fz12 colorLGray normal mb-0">01:00 PM - 09:00 PM</p>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="form-group">
                        <label for="">Message <strong class="fz12 colorLine">(OPTIONAL)</strong></label>
                        <textarea class="form-control" id="" rows="3" placeholder="Message"></textarea>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="row align-items-center">
                        <div class="col-md-6 capcha">
                            <img src="./img/service/img-capcha.jpg" alt="img-capcha">
                            <div class="d-lg-none" style="height: 32px;"></div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="message.php" class="btn-clip btn-red" style="min-width: 140px"> Submit</a>
                        </div>
                    </div>

                    <div style="height: 32px;"></div>

                </div>
            </form>
            <div style="height: 40px;"></div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $(".h-box.gradient").css({
            background: '#1D1F21'
        });
        
        PageFunction.booking();

        $('.datepicker').datepicker({
            format: 'M ,dd ,yyyy'
        }).on('changeDate', function(ev) {
            var text = $('.datepicker').val();

            $("#title-date").text(text);

        });

    });
</script>

<?php include "includes/footer.php" ?>
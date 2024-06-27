<?php include "includes/header_no_toolbar.php" ?>

<style type="text/css">
    @import url(https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css);
</style>

<div class="bgGray">
    <div class="container-fluid">
        <div class="wrapper-container wrapper-container--sm">
            <div style="height: 16px;"></div>
            <h5 class="ff-1 colorDark text-uppercase">TEST DRIVE REGISTRATION</h5>
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
                        <label for="">DATE</label>
                        <div class="dropdown dropdown--selected dropdown--selected-date">
                            <a href="javascript:void(0)" class="btn" aria-haspopup="true" aria-expanded="false">
                                <div class="label">DATE <sup>*</sup></div>
                                <div class="title" id="title-date"></div>
                            </a>
                            <?php $date = date('Y-m-d'); ?>
                            <input class="datepicker" value="">
                        </div>

                        <div style="height: 11px;"></div>

                        <label for="">TIME / SECTION OF DAY</label>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="time1" name="customRadio" class="custom-control-input" checked>
                                    <label class="custom-control-label" for="time1">
                                        <strong class="fz14">Morning</strong>
                                        <p class="fz12 colorLGray normal mb-0">08:00 AM - 11:00 AM</p>
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
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

                    <div class="form-group-important">
                        <label for="">FIND DEALER</label>
                        <div class="dropdown dropdown--selected">
                            <a href="javascript:void(0)" class="btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <div class="title">Yamaha 3S Hanh Lam</div>
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

                    <div class="form-group form-radio">
                        <label for="">Have you had the A2 license yet? <sup>*</sup></label>
                        <div class="group-radio">
                            <div class="custom-control custom-radio">
                                <input type="radio" id="yes" name="customRadio1" class="custom-control-input" checked>
                                <label class="custom-control-label" for="yes">Yes</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input type="radio" id="no" name="customRadio1" class="custom-control-input">
                                <label class="custom-control-label" for="no">No</label>
                            </div>
                        </div>
                    </div>

                    <div style="height: 8px;"></div>

                    <div class="row align-items-center">
                        <div class="col-md-6 capcha">
                            <img src="./img/service/img-capcha.jpg" alt="img-capcha">
                            <div class="d-lg-none" style="height: 32px;"></div>
                        </div>
                        <div class="col-md-6 text-right">
                            <a href="javascript:void(0);" class="btn-clip btn-red btn-buy-now" data-toggle="modal" data-target="#staticBackdrop">PREVIEW & SUBMIT</a>
                        </div>
                    </div>

                    <div style="height: 32px;"></div>

                </div>
            </form>
            <div style="height: 40px;"></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade confirm-modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">PREVIEW</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="title">TEST DRIVE BIKE</div>
                <div class="product-summary">
                    <div class="product-summary__img">
                        <img src="./img/moto-3.png" alt="" />
                    </div>
                    <div class="product-summary__content">
                        <div class="name-p">MT - 10</div>
                        <p class="cat-p">Hyper Naked</p>
                    </div>
                </div>
                <div class="customer-info">
                    <h5>YOUR INFORMATION</h5>
                    <div class="info-item">
                        <img src="./img/buy-apparel/user.svg" alt="" />
                        <div class="info-item__content">
                            <label>Name</label>
                            <p>Nguyen Van An</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="./img/buy-apparel/phone.svg" alt="" />
                        <div class="info-item__content">
                            <label>Phone number</label>
                            <p>0985123456</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="./img/buy-apparel/email.svg" alt="" />
                        <div class="info-item__content">
                            <label>Email address</label>
                            <p>an.nguyen@email.com</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="./img/buy-apparel/location.svg" alt="" />
                        <div class="info-item__content">
                            <label>Your address</label>
                            <p>123 Vo Thi Sau, Ben Nghe Ward, District 1, Ho Chi Minh city</p>
                        </div>
                    </div>
                </div>
                <div class="customer-info">
                    <h5>DATE / TIME</h5>
                    <div class="info-item">
                        <img src="./img/buy-apparel/date.svg" alt="" />
                        <div class="info-item__content">
                            <label>Date</label>
                            <p>Nov 18, 2021</p>
                        </div>
                    </div>
                    <div class="info-item">
                        <img src="./img/buy-apparel/time.svg" alt="" />
                        <div class="info-item__content">
                            <label>Time</label>
                            <p>Morning (08:00 AM - 11:00 AM)</p>
                        </div>
                    </div>
                </div>
                <div class="customer-info">
                    <h5>DEALER</h5>
                    <div class="info-item">
                        <img src="./img/buy-apparel/location.svg" alt="" />
                        <div class="info-item__content">
                            <label>Yamaha 3S Hanh Lam</label>
                            <p>143C Khánh Hội, P.3, Q.1, TP.HCM</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a href="javascript: void(0);" class="btn btn-link btn-link-red" data-dismiss="modal">CANCEL</a>
                    <a href="message.php" class="btn-clip btn-red btn-buy-now">SUBMIT</a>
                </div>
            </div>
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
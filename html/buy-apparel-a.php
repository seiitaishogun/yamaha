<?php include "includes/header_no_toolbar.php" ?>

    <section class="buy-apparel">
        <div class="buy-apparel__wrapper mt-0">
            <div class="buy-apparel__title">
                <img class="arrow-left" src="./img/buy-apparel/arrow-left.svg" alt=""/>
                <h3>BUY APPAREL</h3>
            </div>
            <div class="product-summary">
                <div class="product-summary__img">
                    <img src="./img/buy-apparel/product.jpg" alt=""/>
                </div>
                <div class="product-summary__content d-md-flex">
                    <div class="product-summary__name">
                        <h5>YAMAHA PADDOCK FACTORY RACING MONTER POLO</h5>
                        <div class="d-flex align-items-center list-option">
                            <div class="p-size">
                                <span>Size</span>
                                <div class="dropdown">
                                    <button type="button" class="btn btn-dropdown dropdown-toggle"
                                            id="dropdownMenuOffset" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                        XL
                                    </button>
                                    <div class="dropdown-menu dropdown-red" aria-labelledby="dropdownMenuOffset">
                                        <a class="dropdown-item" href="#">S</a>
                                        <a class="dropdown-item" href="#">M</a>
                                        <a class="dropdown-item" href="#">L</a>
                                        <a class="dropdown-item" href="#">XL</a>
                                    </div>
                                </div>
                            </div>
                            <div class="p-color">
                                <span>Color</span>
                                <span class="color color-red"></span>
                            </div>
                        </div>
                    </div>
                    <div class="product-summary__price">
                        <div class="input-group number-comp" data-price="450000">
                            <div class="input-group-prepend">
                                <button class="btn btn-minus" type="button">-</button>
                            </div>
                            <input type="number" value="1" maxlength="2" size="2" class="form-control" placeholder=""
                                   aria-label="" aria-describedby="basic-addon1">
                            <div class="input-group-append">
                                <button class="btn btn-plus" type="button">+</button>
                            </div>
                        </div>
                        <h5 class="price">450.000đ</h5>
                    </div>
                </div>
            </div>
            <div class="customer-info">
                <h5>YOUR INFORMATION</h5>
                <div class="form-group form-ani">
                    <input type="text" name="name"/>
                    <label for="">Name <span>*</span></label>
                </div>
                <div class="wrap-form d-flex">
                    <div class="form-group form-ani split">
                        <input type="text" name="phone_number"/>
                        <label for="">Phone number <span>*</span></label>
                    </div>
                    <div class="form-group form-ani split">
                        <input type="text" name="email_address"/>
                        <label for="">Email address <span>*</span></label>
                    </div>
                </div>
                <div class="form-group form-ani">
                    <input type="text" name="your_address"/>
                    <label for="">YOUR ADDRESS <span>*</span></label>
                </div>
                <div class="find-dealer">
                    <h5>FIND A DEALER</h5>
                    <div class="dropdown">
                        <button type="button" class="btn btn-dropdown dropdown-dealer dropdown-toggle"
                                id="dropdownDealer" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="dealer-info">
                                <p class="no-select">DEALER <span>*</span></p>
                            </div>
                        </button>

                        <div class="dropdown-menu" aria-labelledby="dropdownDealer">
                            <a class="dropdown-item" href="#">
                                <div class="dealer-info">
                                    <p class="dealer-name">Yamaha 3S Hanh Lam <span class="in-stock">In stock</span></p>
                                    <p class="dealer-address">143C Khánh Hội, Phường 3, Quận 4, TP. Hồ Chí Minh</p>
                                </div>
                            </a>
                            <a class="dropdown-item" href="#">
                                <div class="dealer-info">
                                    <p class="dealer-name">Yamaha Long Thanh Dat Store <span
                                                class="pre-order">Pre-order</span></p>
                                    <p class="dealer-address">143C Khánh Hội, P.3, Q.1, TP.HCM</p>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="form-group text-area">
                    <label for="">Message <span class="optional">(OPTIONAL)</span></label>
                    <textarea class="form-control" rows="4"></textarea>
                </div>
                <div class="footer-form">
                    <div></div>
                    <a href="javascript:void(0);" class="btn-clip btn-red btn-buy-now" data-toggle="modal"
                       data-target="#staticBackdrop">PREVIEW & SUBMIT</a>
                </div>
            </div>
        </div>
    </section>


    <!-- Modal -->
    <div class="modal fade confirm-modal" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
         aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">PREVIEW</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="title">PRODUCT</div>
                    <div class="product-summary">
                        <div class="product-summary__img">
                            <img src="./img/buy-apparel/product.jpg" alt=""/>
                        </div>
                        <div class="product-summary__content">
                            <h5>YAMAHA PADDOCK FACTORY RACING MONTER POLO</h5>
                            <div class="p-size">
                                <span>Size: <strong>XL</strong></span>
                                <span class="slash">|</span>
                                <span>Color: <strong class="color color-red"></strong></span>
                                <span>Quantity: <strong>2</strong></span>
                            </div>
                            <div class="price">900.000đ</div>
                        </div>
                    </div>
                    <div class="customer-info">
                        <h5>YOUR INFORMATION</h5>
                        <div class="info-item">
                            <img src="./img/buy-apparel/user.svg" alt=""/>
                            <div class="info-item__content">
                                <label>Name</label>
                                <p>Nguyen Van An</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <img src="./img/buy-apparel/phone.svg" alt=""/>
                            <div class="info-item__content">
                                <label>Phone number</label>
                                <p>0985123456</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <img src="./img/buy-apparel/email.svg" alt=""/>
                            <div class="info-item__content">
                                <label>Email address</label>
                                <p>an.nguyen@email.com</p>
                            </div>
                        </div>
                        <div class="info-item">
                            <img src="./img/buy-apparel/location.svg" alt=""/>
                            <div class="info-item__content">
                                <label>Your address</label>
                                <p>123 Vo Thi Sau, Ben Nghe Ward, District 1, Ho Chi Minh city</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <a href="javascript: void(0);" class="btn btn-link btn-link-red" data-dismiss="modal">CANCEL</a>
                        <a href="buy-apparel-c.php" class="btn-clip btn-red btn-buy-now">SUBMIT</a>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(".h-box.gradient").css({
            background: 'black'
        });

        let formInputList = document.querySelectorAll(".form-group input");
        formInputList.forEach(input => {
            input.addEventListener("change", function () {
                console.log('ss')
                let parentNode = this.parentElement;
                if (this.value.length > 0) {
                    parentNode.classList.add("not-empty");
                } else {
                    parentNode.classList.remove("not-empty");
                }
            });
        })


        //---------------
        let dropdownList = document.querySelectorAll(".dropdown");
        dropdownList.forEach(d => {
            let dropdownItems = d.querySelectorAll(".dropdown-item")

            dropdownItems.forEach(item => {
                item.addEventListener("click", function (e) {
                    e.preventDefault()

                    console.info(item, item.childNodes)

                    d.querySelector(".btn-dropdown").innerHTML = item.innerHTML
                })
            })
        })


        //---------------
        let inputNumber = document.querySelectorAll('.number-comp')

        function updatePrice(elem, amount) {
            let price = elem.dataset.price ? elem.dataset.price : 0
            let strPrice = new Intl.NumberFormat().format(price * amount)

            elem.parentElement.querySelector(".price").innerHTML = strPrice + "đ"
        }

        inputNumber.forEach(elem => {
            let inputNum = elem.querySelector("input")
            elem.querySelector(".btn-minus").addEventListener("click", () => {
                if (inputNum.value - 1 > 0) {
                    inputNum.value = parseInt(inputNum.value) - 1
                } else {
                    inputNum.value = 1
                }

                updatePrice(elem, parseInt(inputNum.value))
            })
            elem.querySelector(".btn-plus").addEventListener("click", () => {
                inputNum.value = parseInt(inputNum.value) + 1

                updatePrice(elem, parseInt(inputNum.value))
            })
        })
    </script>


<?php include "includes/footer.php" ?>
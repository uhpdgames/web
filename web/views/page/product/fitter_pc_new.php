<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }

        /* The Modal (background) */
        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 1; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            position: relative;
            top: 213px;
            background-color: #fefefe;
            margin: auto;
            padding: 0;
            border: 1px solid #888;
            width: 60% !important;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            -webkit-animation-name: animatetop;
            -webkit-animation-duration: 0.4s;
            animation-name: animatetop;
            animation-duration: 0.4s;
        }

        /* Add Animation */
        @-webkit-keyframes animatetop {
            from {
                top: -300px;
                opacity: 0;
            }
            to {
                top: 0;
                opacity: 1;
            }
        }

        @keyframes animatetop {
            from {
                top: -300px;
                opacity: 0;
            }
            to {
                top: 0;
                opacity: 1;
            }
        }

        /* The Close Button */
        .close {
            color: white;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

        .modal-header {
            padding: 2px 16px;
            color: white;
        }

        .modal-body {
            padding: 2px 16px;
        }

        .modal-footer {
            padding: 2px 16px;
            color: white;
        }
        .form-check{
          padding: 2px 2px 2px 2px;
        }
    </style>
</head>

<div class="row pt-2">
    <div class="col-8">
        <!-- <div class="container">
            <div class="row">
                <div class="col">
                    <button class="btn btn-outline-success">Tất cả</button>
                </div>
                <div class="col">
                    <button class="btn btn-outline-success">Mới</button>
                </div>
                <div class="col">
                    <button class="btn btn-outline-success">Bán chạy</button>
                </div>
            </div>
        </div> -->
    </div>
    <div class="col-4 d-flex justify-content-end pb-2">
        <button  id="myBtn" class="btn btn-outline-success">
            Lọc
            <i class="fa fa-filter"></i>
        </button>
        <div id="myModal" class="modal">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="font-color-fitter">Bộ lọc sản phẩm</h2>
                    <span class="close">&times;</span>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col">
                            Loại sản phẩm
                        </div>
                        <div class="col">
                            Thương hiệu
                        </div>
                        <div class="col">
                            Theo dòng CKD
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="ProductType" id="inlineRadio1" value="option1" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio1">Làm sạch</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="Brand" id="brand" value="option1" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio4">CKD</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio3">Keo ong xanh</label>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="ProductType" id="inlineRadio2" value="option2" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio2">Chăm sóc da</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="Brand" id="brand" value="option2" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio5">Bellasoo</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="option1" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio1">Retinol-Collagen</label>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="ProductType" id="inlineRadio3" value="option3" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio3">Mặt nạ</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="Brand" id="brand" value="option3" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio6">Lactor-Derm</label>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="option2" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio2">Vita C Teca</label>
                            </div>
                        </div>
                        <div class="w-100"></div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="ProductType" id="inlineRadio3" value="option3" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio3">Chống nắng</label>
                            </div>
                        </div>
                        <div class="col"></div>
                        <div class="col">
                            <div class="form-check form-check-inline cover-font-radio">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="option3" />
                                <label class="form-check-label font-lable-fitter" for="inlineRadio3">Amino Biotin</label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-outline-success">
                        Áp dụng
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

            <div class="row" 
            style="justify-content: center;text-align: center;"
            >
                <div class="col mb-1">
                    <button class="btn btn-outline-success" 
                    style="width: 200px;"
                    >Tất cả</button>
                </div>
                <div class="col mb-1">
                    <button class="btn btn-outline-success"
                    style="width: 200px;"
                    >Mới</button>
                </div>
                <div class="col mb-1">
                    <button class="btn btn-outline-success"
                    style="width: 200px;"
                    >Bán chạy</button>
                </div>
                <div class="col mb-1">
                    <button class="btn btn-outline-success"
                    style="width: 200px;"
                    >Giá từ cao đến thấp</button>
                </div>
                <div class="col mb-1">
                    <button class="btn btn-outline-success"
                    style="width: 200px;"
                    >Giá từ thấp đến cao</button>
                </div>
            </div>

<script>
    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks the button, open the modal
    btn.onclick = function () {
        modal.style.display = "block";
    };

    // When the user clicks on <span> (x), close the modal
    span.onclick = function () {
        modal.style.display = "none";
    };

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    };
</script>

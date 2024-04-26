<!-- Start Content Page -->
<div class="container-fluid bg-light py-5">
    <div class="col-md-6 m-auto text-center">
        <h1 class="h1">Liên hệ</h1>
        <p>
            Hãy liên hệ với chúng tôi nếu bạn có thắc mắc, chúng tôi sẽ phản hồi sớm nhất có thể.
        </p>
    </div>
</div>

<!-- Start Contact -->
<div class="container py-5">
    <div class="row py-5">
        <form class="col-md-9 m-auto" id="Form_Contact">
            <div class="row">
                <div class="form-group col-md-6 mb-3">
                    <label for="inputname">Tên của bạn</label>
                    <input type="text" class="form-control mt-1" id="fullname" name="fullname" placeholder="Nhập họ tên của bạn">
                </div>
                <div class="form-group col-md-6 mb-3">
                    <label for="inputemail">Email</label>
                    <input type="text" class="form-control mt-1" id="email" name="email" placeholder="Nhập email của bạn">
                    <small id="email_error" class="text-danger"></small>
                </div>
            </div>
            <div class="mb-3">
                <label for="inputsubject">Số điện thoại</label>
                <input type="text" class="form-control mt-1" id="number_phone" name="number_phone" placeholder="Nhập số điện thoại">
                <small id="numberphone_error" class="text-danger"></small>
            </div>
            <div class="mb-3">
                <label for="inputmessage">Nội dung</label>
                <textarea class="form-control mt-1" id="content" name="content" placeholder="Nhập nội dung"
                    rows="8"></textarea>
            </div>
            <div class="row">
                <div class="col text-end mt-2">
                    <button type="submit" class="btn btn-success btn-lg px-3">GỬI</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- End Contact -->
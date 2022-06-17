<?php
  require_once('admin/connect.php');
  include('includes/head.php');
  include('includes/headerPage.php');

?>
<div id="main_form" class="container mb-5 mt-5">
    <div class="row">
        <div class="col-md-6">
            <div id="result" class="an alert alert-success col-md-4" role="alert"></div>
            <form id="myForm" method="POST">
                <h1>Liên hệ </h1>
                <div class="form-group">
                    <label for="exampleInputEmail1">Họ tên</label>
                    <input type="text" class="form-control col-md-5" id="name" aria-describedby="emailHelp" placeholder="Nhập họ tên" value="<?php if(isset($_SESSION['hoten'])) echo $_SESSION['hoten']; else echo '';?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email</label>
                    <input type="email" class="form-control col-md-5" id="email" aria-describedby="emailHelp" placeholder="Nhập email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; else echo '';?>">
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Chủ đề</label>
                    <input type="text" class="form-control col-md-8" id="subject" aria-describedby="emailHelp" placeholder="Nhập chủ đề">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Nội dung</label>
                    <textarea class="form-control" id="content" rows="3" placeholder="Nhập nội dung"></textarea>
                </div>
                <button type="button" class="btn btn-success" onclick="sendMail()">Gửi</button>
            </form>        
        </div>
        <div class="col-md-6">
            <div class="mb-5 mt-5">
                <p><strong>SĐT:</strong> 0808.1508.2508</p>
                <p><strong>Zalo:</strong> 0808.1508.2508</p>
                <p><strong>Facebook:</strong> https://www.facebook.com/profile.php?id=100074428522322</p>
            </div>
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3826.2614517681122!2d107.58949651429234!3d16.46229378863916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3141a13932355015%3A0xc6a71ed147f95215!2zMTEgTMO9IFRoxrDhu51uZyBLaeG7h3QsIFBow7ogTmh14bqtbiwgVGjDoG5oIHBo4buRIEh14bq_LCBUaOG7q2EgVGhpw6puIEh14bq_LCBWaeG7h3QgTmFt!5e0!3m2!1svi!2s!4v1638706319542!5m2!1svi!2s" width="600" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
        </div>
    </div>
</div>
<?php include('includes/footer.php'); ?>
        <!-- partial:partials/_footer.html -->
            <footer>
                <div class="footer-top">
                    <div class="container">
                        <div class="row">
                        <div class="col-sm-5">
                            <!-- <img src="assets/images/logo.svg" class="footer-logo" alt="" /> -->
                            <h1>NewsFirst</h1>
                            <h5 class="font-weight-normal mt-4 mb-5">
                            Báo là trang web thời trang tin tức, giải trí, âm nhạc của bạn. chúng tôi
                            cung cấp cho bạn những tin tức nóng hổi và video mới nhất trực tiếp từ
                            ngành công nghiệp giải trí.
                            </h5>
                            <ul class="social-media mb-3">
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <i class="mdi mdi-facebook"></i>
                                </a>
                                </li>
                                <li>
                                <a href="https://www.youtube.com/" target="_blank">
                                    <i class="mdi mdi-youtube"></i>
                                </a>
                                </li>
                                <li>
                                <a href="https://www.twitter.com/" target="_blank">
                                    <i class="mdi mdi-twitter"></i>
                                </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-4">
                            <h3 class="font-weight-bold">BÀI ĐĂNG MỚI NHẤT</h3>
                            <div class="mt-4">
                                <?php tinMoiFooter($conn); ?>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <h3 class="font-weight-bold mb-3">CATEGORIES</h3>
                            <?php footerCategory($conn);?>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="footer-bottom">
                    <div class="container">
                        <div class="row">
                        <div class="col-sm-12">
                            <div class="d-sm-flex justify-content-between align-items-center">
                            <div class="fs-14 font-weight-600">
                                © 2020 @ <a href="https://www.bootstrapdash.com/" target="_blank" class="text-white"> BootstrapDash</a>. All rights reserved.
                            </div>
                            <div class="fs-14 font-weight-600">
                                Thiết kế bởi <a href="https://www.bootstrapdash.com/" target="_blank" class="text-white">Đức Minh</a>
                            </div>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </footer>
        <!-- partial -->
        </div>
    </div>
    <?php include('script.php'); ?>
  </body>
</html>
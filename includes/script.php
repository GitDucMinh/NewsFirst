<!-- inject:js -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="assets/vendors/js/vendor.bundle.base.js"></script>
<!-- endinject -->
<!-- plugin js for this page -->
<script src="assets/vendors/aos/dist/aos.js/aos.js"></script>
<!-- End plugin js for this page -->
<!-- Custom js for this page-->
<script src="./assets/js/demo.js"></script>
<script src="./assets/js/jquery.easeScroll.js"></script>

<!-- End custom js for this page-->
<script type="text/javascript">
    function sendMail() {
        var name = $('#name');
        var email = $('#email');
        var subject = $('#subject');
        var content = $('#content');

        // if(isNotEmpty(name) && isNotEmpty(email) && isNotEmpty(subject) && isNotEmpty(content)) {
            $.ajax({
                url: 'sendMail.php',
                method: 'POST',
                dataType: 'text',
                data: {
                    name: name.val(),
                    email: email.val(),
                    subject: subject.val(),
                    content: content.val()
                }, success : function (response){
                    let obj = JSON.parse(response);
                    $('#myForm')[0].reset();
                    $('#result').css('display','block');
                    $('#result').text(obj.response);
                }
            });
        // }
    }
    function isNotEmpty(caller) {
        if(caller.val() === "") {
            caller.css('border', '1px solid red');
            return false;
        } else {
            caller.css('boder', '');
            return true;
        }
    }
</script>
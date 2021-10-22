<?php 
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/inc/header.php';
?>
    <!-- Kết thúc header -->
    <!-- Content -->
    <div class="container1">
      <span class="big-circle"></span>
      <img src="img/shape.png" class="square" alt="" />
      <div class="form1">
        <div class="contact-info">
          <h3 class="title1">Let's get in touch</h3>
          <p class="text">
            Chúng tôi với khát khao đem đến cho đọc giả những cuốn sách ý nghĩa, bổ ích.
          </p>

          <div class="info">
            <div class="information">
              <img src="img/location.png" class="icon1" alt="" />
              <p>69/96 Trần Duy Hưng, Hồ Chí Minh</p>
            </div>
            <div class="information">
              <img src="img/email.png" class="icon1" alt="" />
              <p>tranvuluan069@gmail.com</p>
            </div>
            <div class="information">
              <img src="img/phone.png" class="icon1" alt="" />
              <p>(+84) 868486575</p>
            </div>
          </div>

          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="https://fb.com/luan.luan23082001">
                <i class="fa fa-facebook-f"></i>
              </a>
              <a href="#">
                <i class="fa fa-twitter"></i>
              </a>
              <a href="#">
                <i class="fa fa-instagram"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="contact-form">
          <form action="index.html" autocomplete="off">
            <h3 class="title1">Contact us</h3>
            <div class="input-container">
              <input type="text" name="name" class="input1" />
              <label for="">Username</label>
              <span>Username</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input1" />
              <label for="">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input1" />
              <label for="">Phone</label>
              <span>Phone</span>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input1"></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <input type="submit" value="Send" class="btn1" />
          </form>
        </div>
      </div>
    </div>

    <script >
        $(document).ready(function() {
            const inputs = document.querySelectorAll(".input1");

            function focusFunc() {
            let parent = this.parentNode;
            parent.classList.add("focus");
            }

            function blurFunc() {
            let parent = this.parentNode;
            if (this.value == "") {
                parent.classList.remove("focus");
            }
            }

            inputs.forEach((input) => {
            input.addEventListener("focus", focusFunc);
            input.addEventListener("blur", blurFunc);
            });
        })

    </script>

<?php 
$filepath = realpath(dirname(__FILE__));
include_once $filepath.'/inc/footer.php';
?>
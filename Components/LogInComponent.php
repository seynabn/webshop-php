<?php

function LogInComponent($message = "")
{
  ?>

  <div class="row">

    <?php echo $message; ?>

    <div class="row">
      <div class="col-md-12">
        <div class="newsletter">

          <p>User <strong>&nbsp;LOGIN</strong></p>

          <form method="POST">

            <input name="email" class="input" type="email" placeholder="Enter Your Email">

            <br><br>

            <input name="password" class="input" type="password" placeholder="Enter Your Password">

            <br><br>

            <button class="newsletter-btn">
              Login
            </button>

          </form>

        </div>
      </div>
    </div>

  </div>

  <?php
}
?>
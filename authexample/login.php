<?php
require_once __DIR__ . '/core/core.php';

?>
<html>
    <head>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    </head>
    <body>
        <?php if ($_SESSION && $_SESSION['userid']): ?>
            <div> Welcome <?php echo $_SESSION['userid']; ?> </div>
            <form id="logout_1" method="post">
                <input class="btn btn-default icon-btn save" type="submit" type="submit" name="logout" value="Logout" />
            </form>
            <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('submit', '[id^=logout_]', function (e) {
                    e.preventDefault();
                    var data = $(this).serialize()
                    $.ajax({
                      type: 'POST',
                      url: 'http://localhost/users/logout.php',
                      data: data,
                      dataType: 'json',
                      success: function (data) {
                          if (data.error) {
                              swal({
                                  title: 'Error!',
                                  text: data.error,
                                  timer: 1200,
                                  type: 'error',
                                  showCancelButton: false,
                                  showConfirmButton: false
                              })
                          } else {
                            swal({
                                title: 'Logged Out!',
                                text: data.success,
                                timer: 1200,
                                type: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        }
                      },
                      error: function (data) {
                        swal("ERR!", "Something blew up.", "error")
                      }
                    })
                    return false
                })
            })
            </script>

        <?php else: ?>
            <div> Login </div>
            <form id="login_1" method="post">
                <input type="username" name="username" placeholder="Enter Username"><br>
                <input type="password" name="password" placeholder="Enter Password"><br>
                <input class="btn btn-default icon-btn save" type="submit" type="submit" name="login" value="Login" />
            </form>

        </br>
            <div> Register </div>
            <form id="register_1" method="post">
                <input type="username" name="username" placeholder="Enter Username"><br>
                <input type="email" name="email" placeholder="Enter Email"><br>
                <input type="password" name="password" placeholder="Enter Password"><br>
                <input class="btn btn-default icon-btn save" type="submit" type="submit" name="login" value="Login" />
            </form>

            <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('submit', '[id^=login_]', function (e) {
                    e.preventDefault();
                    var data = $(this).serialize()
                    $.ajax({
                      type: 'POST',
                      url: 'http://localhost/users/login.php',
                      data: data,
                      dataType: 'json',
                      success: function (data) {
                          if (data.error) {
                              swal({
                                  title: 'Error!',
                                  text: data.error,
                                  timer: 1200,
                                  type: 'error',
                                  showCancelButton: false,
                                  showConfirmButton: false
                              })
                          } else {
                            swal({
                                title: 'Logged In!',
                                text: data.success,
                                timer: 1200,
                                type: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        }
                      },
                      error: function (data) {
                        swal("ERR!", "Something blew up.", "error")
                      }
                    })
                    return false
                })
            })
            </script>

            <script type="text/javascript">
            $(document).ready(function() {
                $(document).on('submit', '[id^=register_]', function (e) {
                    e.preventDefault();
                    var data = $(this).serialize()
                    $.ajax({
                      type: 'POST',
                      url: 'http://localhost/users/register.php',
                      data: data,
                      dataType: 'json',
                      success: function (data) {
                          if (data.error) {
                              swal({
                                  title: 'Error!',
                                  text: data.error,
                                  timer: 1200,
                                  type: 'error',
                                  showCancelButton: false,
                                  showConfirmButton: false
                              })
                          } else {
                            swal({
                                title: 'Registered!',
                                text: data.success,
                                timer: 1200,
                                type: 'success',
                                showCancelButton: false,
                                showConfirmButton: false
                            })
                        }
                      },
                      error: function (data) {
                        swal("ERR!", "Something blew up.", "error")
                      }
                    })
                    return false
                })
            })
            </script>
        <?php endif; ?>
    </body>
</html>

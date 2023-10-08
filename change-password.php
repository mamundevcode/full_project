<?php
require_once("function/function.php");
needLogged();
if ($_SESSION['role'] == '1') {
  get_header();
  get_sidebar();

  $id = $_GET['p'];
  $sel = "SELECT * FROM users NATURAL JOIN roles WHERE user_id='$id'";
  $Q = mysqli_query($con, $sel);
  $data = mysqli_fetch_assoc($Q);
  $pw = $data['user_password'];

  if ($_POST) {
    $opw = md5($_POST['old_pass']);
    $npw = md5($_POST['new_pass']);
    $rpw = md5($_POST['repass']);

    $update = "UPDATE * users SET user_password='$npw' WHERE user_id='$id'";
    if (!empty($opw)) {
      if (!empty($npw)) {
        if (!empty($rpw)) {
          if (!empty($npw === $rpw)) {
            if (!empty($opw === $pw)) {
              if (mysqli_query($con, $update)) {
                header('Location: logout.php');
              } else {
                echo "Opps !!! Password changed failed.";
              }
            } else {
              echo "Old password did not match.";
            }
          } else {
            echo "Password and confirm password did not match.";
          }
        } else {
          echo "Please Enter Confirm Password.";
        }
      } else {
        echo "Please Enter New Password.";
      }
    } else {
      echo "Please Enter Old Password.";
    }
  }

?>
  <div class="row">
    <div class="col-md-12 ">
      <form method="post" action="" enctype="multipart/form-data">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-8 card_title_part">
                <i class="fab fa-gg-circle"></i>Change Password
              </div>
              <div class="col-md-4 card_button_part">
                <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Old Password<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="password" class="form-control form_control" id="" name="old_pass">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">New Password<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="password" class="form-control form_control" id="" name="new_pass">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Confirm-Password<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="password" class="form-control form_control" id="" name="repass">
              </div>
            </div>
          </div>
          <div class="card-footer text-center">
            <button type="submit" class="btn btn-sm btn-dark">UPDATE</button>
          </div>
        </div>
      </form>
    </div>
  </div>
<?php
  get_footer();
} else {
  // ECHO "Accesss Denied! You have no permission to visit the page";
  header('Location: login.php');
}
?>
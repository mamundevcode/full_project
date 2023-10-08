<?php
require_once("function/function.php");
needLogged();
if ($_SESSION['role'] == '1') {
  get_header();
  get_sidebar();

  $id = $_GET['ec'];
  $sel = "SELECT * FROM contact WHERE con_id='$id'";
  $Q = mysqli_query($con, $sel);
  $data = mysqli_fetch_assoc($Q);

  if (!empty($_POST)) {
    $name = $_POST["contact_name"];
    $email = $_POST["contact_email"];
    $subject = $_POST["contact_subject"];
    $message = $_POST["contact_message"];

  

    $update = "UPDATE `contact` SET `con_name`='$name',`con_email`='$email',`con_subject`='$subject',`con_message`='$message' WHERE `con_id` = '$id'";

    if (mysqli_query($con, $update)) {
      header('Location: view-contact.php?vc=' . $id);
    }else {
      echo "Ops! Message information update failed.";
      
    } 
  }

?>
  <div class="row">
    <div class="col-md-12 ">
      <form method="post" action="">
        <div class="card mb-3">
          <div class="card-header">
            <div class="row">
              <div class="col-md-8 card_title_part">
                <i class="fab fa-gg-circle"></i>Update Contact Information
              </div>
              <div class="col-md-4 card_button_part">
                <a href="all-message.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All Contacts</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Name:<span class="req_star"></span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="contact_name" value="<?= $data['con_name']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Email:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="contact_email" value="<?= $data['con_email']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Subject<span class="req_star"></span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="contact_subject" value="<?= $data['con_subject']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Message<span class="req_star"></span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="contact_message" value="<?= $data['con_message']; ?>">
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
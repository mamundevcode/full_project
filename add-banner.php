<?php
require_once("function/function.php");
needLogged();
if ($_SESSION['role'] == '1') {
  get_header();
  get_sidebar();

  if (!empty($_POST)) {
    $title = $_POST["title"];
    $subtitle = $_POST["subtitle"];
    $button = $_POST["btn"];
    $url = $_POST["url"];
    $image = $_FILES['pic'];
    $imageName = "";

    if ($image['name'] != '') {
      $imageName = 'banner_' . time() . '_' . rand(10000, 1000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
    }

    $insert = "INSERT INTO banners(ban_title,ban_subtitle,ban_button,ban_url,ban_image)
      VALUES('$title','$subtitle','$button','$url','$imageName')";

    if (!empty($title)) {
      if (mysqli_query($con, $insert)) {
        move_uploaded_file($image['tmp_name'], 'uploads/' . $imageName);
        echo "Banner upload successful";
      } else {
        echo "Banner upload failed";
      }
    } else {
      echo "Please enter banner title";
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
                <i class="fab fa-gg-circle"></i>Add Banner Information
              </div>
              <div class="col-md-4 card_button_part">
                <a href="all-banner.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>ALL BANNER</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Title<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="title">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Subtitle:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="subtitle">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Button<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="btn">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Button URL<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="url">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Image:</label>
              <div class="col-sm-4">
                <input type="file" class="form-control form_control" id="" name="pic">
              </div>
            </div>
          </div>
          <div class="card-footer text-center">
            <button type="submit" class="btn btn-sm btn-dark">UPLOAD</button>
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
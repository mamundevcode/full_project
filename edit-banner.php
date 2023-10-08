<?php
require_once("function/function.php");
needLogged();
if ($_SESSION['role'] == '1') {
  get_header();
  get_sidebar();

  $id = $_GET['be'];
  $sel = "SELECT * FROM banners WHERE ban_id='$id'";
  $Q = mysqli_query($con, $sel);
  $data = mysqli_fetch_assoc($Q);

  if (!empty($_POST)) {
    $title = $_POST["ban_title"];
    $subtitle = $_POST["ban_subtitle"];
    $button = $_POST["ban_button"];
    // $url = $_POST["	ban_url"];
    $image = $_FILES['ban_image'];
    $imageName = "";

    
    if ($image['name'] != '') {
      $imageName = 'banner_' . time() . '_' . rand(10000, 1000000) . '.' . pathinfo($image['name'], PATHINFO_EXTENSION);
    }
    $update = "UPDATE banners SET ban_title='$title', ban_subtitle='$subtitle', 
    ban_button='$button', ban_url='$url' WHERE ban_id='$id'";

    //--------Validation part--------------  strtolower(str_replace(' ', '_', $_POST['ban_image'])) .

    if (mysqli_query($con, $update)) {

      // echo "Successfully update user information.";
      if ($image['name'] != '') {
        // $imageName = 'banner_' .  time() . '_' . rand(10000, 1000000) . '.' . pathinfo($image['ban_image'], PATHINFO_EXTENSION);
        $update = "UPDATE banners SET ban_image='$imageName' WHERE ban_id='$id'";
        if (mysqli_query($con, $update)) {
          move_uploaded_file($image['tmp_name'], 'uploads/' . $imageName);
          header('Location: view-banner.php?vb=' . $id);
        } else {
          echo "Banner image update failed";
        }
      }
      header('Location: view-banner.php?vb=' . $id);
    } else {
      echo "Ops! banner information update failed.";
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
                <i class="fab fa-gg-circle"></i>Update User Information
              </div>
              <div class="col-md-4 card_button_part">
                <a href="all-user.php" class="btn btn-sm btn-dark"><i class="fas fa-th"></i>All User</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Title<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="ban_title" value="<?= $data['ban_title']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Subtitle:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="ban_subtitle" value="<?= $data['ban_subtitle']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Button<span class="req_star">*</span>:</label>
              <div class="col-sm-7">
                <input type="text" class="form-control form_control" id="" name="ban_button" value="<?= $data['ban_button']; ?>">
              </div>
            </div>
            <div class="row mb-3">
              <label class="col-sm-3 col-form-label col_form_label">Banner Image:</label>
              <div class="col-sm-4">
                <input type="file" class="form-control form_control" id="" name="ban_image">
              </div>
              <div class="col-md-2">
                <?php if ($data['ban_image'] != '') { ?>
                  <img height="200" class="img200" src="uploads/<?= $data['ban_image']; ?>" alt="Banner" />
                <?php } else { ?>
                  <img height="200" src="images/avatar.jpg" alt="Banner" />
                <?php } ?>
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
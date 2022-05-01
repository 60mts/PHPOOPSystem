<?php include 'header.php';
?>
<!-- Content Wrapper. Contains page content -->
<section class="content">

  <?php
  if (isset($_GET['addMenus'])) { ?>


    <div class="content-header" align="center">

      <h5>EKLEME MENUSU </h5>
      <hr>

      <div class="content">


        <?php

        if (isset($_POST['admins_add'])) {

          $sonuc = $db->AdminAdd($_POST['admins_name_surname'], $_POST['admins_username'], $_POST['admins_pass'], $_POST['admin_status']);

          if ($sonuc['status']) { ?>

            <div class="alert alert-success">

              Kayıt başarılı

              <i class="fa fa-check"></i>

            </div>

          <?php } else { ?>

            <div class="alert alert-danger">

              Kayıt başarısız <i class="fa fa-exclamation"></i>

            </div>


        <?php }
        }
        ?>


        <form method="POST">

          <div class="form-group">

            <label> Administration Added Window </label>

            <div class="row">

              <div class="col-xs-12" style="margin-left:350px;">

                <input type="text" name="admins_username" required="" class="form-control" placeholder="Kullanıcı adı" style="width:300px; padding:30px;">
                <input type="text" name="admins_name_surname" required="" class="form-control" placeholder="Adı ve Soyadı" style="width:300px; padding:30px;">
                <input type="password" name="admins_pass" required="" class="form-control" placeholder="Şifre" style="width:300px; padding:30px;">                <select required="" class="form-control" name="admin_status">
                  <option> Lütfen Değer seçiniz !</option>
                  <option value="1"> Aktif </option>
                  <option value="0"> Pasiff </option>
                </select>
                <hr>

                <button type="submit" class="btn btn-success" name="admins_add"><i class="fa fa-check"></i></button>
              </div>
            </div>
          </div>
      </div>
      </form>
    </div>
    </div>
  <?php  } ?>
</section>
<div class="content" align="right" style="margin-left:-25px;">
  <hr>
  <a href="?addMenus=true"><button type="button" class="btn btn-danger">
      <i class="fa fa-plus"> EKLE</i>
    </button>
  </a>
</div>
<div class="callout">
  <div class="content-wrapper">
    <table class="table table-success table-striped">
      <thead>
        <tr>
          <th><i class="fa fa-arrow-down"> </i> ID</th>
          <th><i class="fa fa-face-meh"> </i> Authority</th>
          <th><i class="fa fa-user"> </i> User Name</th>
          <th><i class="fa fa-face-party"> </i> Name Lastname</th>
          <th><i class="fa fa-disguise"> </i> User Photo</th>
          <th><i class="fa fa-arrow-down-to-arc"> </i> Process</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <?php
          $sql = $db->Read("admins");
          $say = 1;
          while ($row = $sql->Fetch(PDO::FETCH_ASSOC)) { ?>
            <td> <?php echo $say++ ?></td>
            <td>
              <?php if ($row['admin_status'] == 0) {
                echo "Pasif";
              } else if ($row['admin_status'] == 1) {
                echo "Aktif";
              }
              ?>
            </td>
            <td> <?php echo $row['admins_username']; ?></td>
            <td> <?php echo $row['admins_name_surname']; ?></td>
            <td> <?php echo $row['admins_file']; ?></td>
            </td>
            <td>
              <a href="#.php">
                <button type="button" class="btn btn-danger">
                  <i class="fa fa-trash"></a></i></button>
              <button type="button" class="btn btn-secondary">
                <i class="fa fa-pen"></i>
              </button>
              <button type="button" class="btn btn-success" title="Yetki ver">
                <i class="fa fa-address-card"></i>
              </button>
              <button type="button" class="btn btn-danger" title="Yetki al">
                <i class="fa fa-address-card"></i>
              </button>
            </td>
        </tr>
      <?php }
      ?>
      </tbody>
    </table>
  </div>
</div>
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
<?php require_once 'sidebar.php' ?>
<?php include 'footer.php'; ?>

<?php include'header.php';
?>
  <!-- Content Wrapper. Contains page content -->
  <div align="center" style="margin-top:20px">  <b><p> Administration List</p></b></div>
  <div class="callout">
       <div class="content-wrapper">
    
  <table class="table table-success table-striped">
    <tr>
        <th> <i class="fa fa-align-left"></i>  #</th>
        <th><i class="fa fa-arrow-down"> </i> ID</th>
        <th><i class="fa fa-face-meh"> </i>  Authority</th>
        <th><i class="fa fa-user"> </i> User Name</th>
        <th><i class="fa fa-face-party"> </i> Name Lastname</th>
        <th><i class="fa fa-disguise"> </i> User Photo</th>
        <th><i class="fa fa-arrow-down-to-arc"> </i> Process</th>
    </tr>
<tr>
  <?php 

      $sql=$db->Read("admins");
      while($row=$sql->Fetch(PDO::FETCH_ASSOC)){?>
         <td> <?php  echo $row['admins_id']?> </td>
         <td> 2013456</td>
         <td>  
           <?php  if ($row['admin_status']==0) {
           echo "Pasif";
         }
         else if ($row['admin_status']==1) {
           echo "Aktif";
         }
         ?>
         </td>
         <td>  <?php  echo $row['admins_username']?></td>
         <td> <?php  echo $row['admins_name_surname']?></td>
         <td> <?php echo $row['admins_file']?></td></td>
         <td> 
         <button type="button" class="btn btn-danger">
         <i class="fa fa-trash"></i>
         </button>
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
     <?php }
?>
</table>
    </div>
  </div>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->

  </aside>
  <!-- /.control-sidebar -->
<?php require_once 'sidebar.php' ?>
<?php include 'footer.php'; ?>
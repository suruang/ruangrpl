<?php
//panggil file koneksi
require 'koneksi/koneksi.php';


//tangkap id_siswa yg dikirim melalui URL
$id_siswa = $_GET["id_siswa"];

//Query Data Siswa di tabel siswa

$data = mysqli_query($koneksi, "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'");


//cek apakah tombol ubah sudah di klik / belum

if(isset($_POST["ubah"])) {

    //tangkap nilai /data yang ingin diubah melalui variabel $_POST

    $nis = htmlspecialchars($_POST["nis"]);
    $nama = htmlspecialchars($_POST["nama"]);
    $tanggal_lahir = htmlspecialchars($_POST["tanggal_lahir"]);
    $jurusan = htmlspecialchars($_POST["jurusan"]);
    $alamat = htmlspecialchars($_POST["alamat"]);
    $status = htmlspecialchars($_POST["status"]);


    //fungsi update/ubah gambar

    $queryShow = "SELECT * FROM siswa WHERE id_siswa = '$id_siswa'";
    $sqlShow = mysqli_query($koneksi, $queryShow);
    $result = mysqli_fetch_assoc($sqlShow);

    //cek kondisi

    if($_FILES["gambar"]["name"] == "") {
        $gambar = $result["gambar"];
    }else {
       $gambar = $_FILES["gambar"]["name"];
       unlink("gambar/".$result["gambar"]);
       move_uploaded_file($_FILES["gambar"]["tmp_name"], "gambar/".$_FILES["gambar"]["name"]);
    }

    // die();

//jalan proses Ubah
$ubah = mysqli_query($koneksi, "UPDATE siswa SET 

    nis = '$nis',
    nama = '$nama',
    tanggal_lahir = '$tanggal_lahir',
    jurusan = '$jurusan',
    alamat = '$alamat',
    status = '$status',
    gambar = '$gambar'

    WHERE id_siswa = '$id_siswa'

");

//cek apakah berhasil ubah data / tidak
if($ubah){
    echo "<script>
    alert('Data Berhasil Diubah');
    document.location.href='siswa.php';
    </script>";
}else {
    echo"<script>
    alert('Data Gagal diubah');
    document.location.href='ubah.php';
    </script>";
}

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link href="img/logo/logo.png" rel="icon">
  <title>RuangRPL - DataTables</title>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
  <link href="css/ruang-admin.min.css" rel="stylesheet">
  <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>

<body id="page-top">
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav sidebar sidebar-light accordion" id="accordionSidebar">
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon">
          <img src="img/logo/logo2.png">
        </div>
        <div class="sidebar-brand-text mx-3">RuangRPL</div>
      </a>
      <hr class="sidebar-divider my-0">
      <li class="nav-item">
        <a class="nav-link" href="index.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard</span></a>
      </li>
      <hr class="sidebar-divider">
      <div class="sidebar-heading">
        Features
      </div>
      

      <li class="nav-item active">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTable" aria-expanded="true"
          aria-controls="collapseTable">
          <i class="fas f/a-fw fa-table"></i>
          <span>Data Siswa<span>
        </a>
        <div id="collapseTable" class="collapse show" aria-labelledby="headingTable" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <h6 class="collapse-header">Tables</h6>
            <a class="collapse-item active" href="siswa.php">Siswa</a>
          </div>
        </div>
      </li> 
     
      <hr class="sidebar-divider">
      <div class="version" id="version-ruangadmin"></div>
    </ul>
    <!-- Sidebar -->
    <div id="content-wrapper" class="d-flex flex-column">
      <div id="content">
        <!-- TopBar -->
        <nav class="navbar navbar-expand navbar-light bg-navbar topbar mb-4 static-top">
          <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
            <i class="fa fa-bars"></i>
          </button>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-search fa-fw"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                aria-labelledby="searchDropdown">
                <form class="navbar-search">
                  <div class="input-group">
                    <input type="text" class="form-control bg-light border-1 small" placeholder="What do you want to look for?"
                      aria-label="Search" aria-describedby="basic-addon2" style="border-color: #3f51b5;">
                    <div class="input-group-append">
                      <button class="btn btn-primary" type="button">
                        <i class="fas fa-search fa-sm"></i>
                      </button>
                    </div>
                  </div>
                </form>
              </div>
            </li>
           
            <div class="topbar-divider d-none d-sm-block"></div>
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <img class="img-profile rounded-circle" src="img/boy.png" style="max-width: 60px">
                <span class="ml-2 d-none d-lg-inline text-white small">Abdul Wahab</span>
              </a>
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                  <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                  Profile
                </a>
              
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- Topbar -->
        <!-- Container Fluid-->
        <div class="container-fluid" id="container-wrapper">
          
          <!-- Row -->
          <div class="row">
           
            <!-- DataTable with Hover -->
            <div class="col-lg-12">
             <!-- Form Basic -->
              <div class="card mb-2">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Form Ubah Data Siswa</h6>
                </div>
                <div class="card-body">
                <?php while($row=mysqli_fetch_assoc($data)) :?>
                  <form action="" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="exampleInputEmail1">Nis</label>
                      <input type="text" name="nis" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                        placeholder="Enter nis" required value="<?=$row["nis"];?>" >
                
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Nama</label>
                      <input type="text" name="nama" class="form-control" id="exampleInputPassword1" 
                      placeholder="Nama" required value="<?=$row["nama"];?>">
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Tanggal Lahir</label>
                      <input type="date" name="tanggal_lahir" class="form-control" id="exampleInputPassword1" 
                      placeholder="Nama" required value="<?=$row["tanggal_lahir"];?>">
                    </div>
                    <div class="form-group">
                      <label for="exampleInputPassword1">Jurusan</label>
                    <input class=" form-control" name="jurusan" id="select2Single" required value="<?=$row["jurusan"];?>">
                     <!-- <option value="">Select</option>
                      <option value="RPL">RPL</option>
                      <option value="TKJ">TKJ</option>
                      <option value="MM">MM</option>
                      <option value="TAV">TAV</option>
                      <option value="TKR">TKR</option>
                      <option value="TBSM">TBSM</option> -->
                    </input>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Alamat</label>
                      <textarea class="form-control" name="alamat" required><?= $row["alamat"];?></textarea>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Status</label>
                    <select class="form-control" name="status" id="select2Single">
              
                      <option <?php if($row["status"] == 1) {echo "selected";} ?> value="1">Aktif</option>
                      <option <?php if($row["status"] == 2) {echo "selected";} ?> value="2">Tidak Aktif</option>
                      <option <?php if($row["status"] == 3) {echo "selected";} ?> value="3">Lulus</option>
                     


                    </select>
                    </div>

                    <div class="form-group">
                      <label for="exampleInputPassword1">Gambar</label>
                      <input  type="file" name="gambar" class="form-control" id="exampleInputPassword1" 
                      placeholder="Gambar" accept="image/*" >
                    </div>
                    
                    <!-- <div class="form-group">
                      <div class="custom-file">
                        <input type="text" class="custom-file-input" id="customFile">
                        <label class="custom-file-label" for="customFile">Choose file</label>
                      </div>
                    </div> -->
                    
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                  </form>
                  <?php endwhile;?>
                </div>
              </div>
            </div>
          </div>
          <!--Row-->


          <!-- Modal Logout -->
          <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabelLogout"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabelLogout">Ohh No!</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <p>Are you sure you want to logout?</p>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button>
                  <a href="login.html" class="btn btn-primary">Logout</a>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!---Container Fluid-->
      </div>

      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>copyright &copy; <script> document.write(new Date().getFullYear()); </script> -
              <b><a href="" target="_blank">Abdul Wahab, All rights reserved.</a></b>
            </span>
          </div>
        </div>
      </footer>
      <!-- Footer -->
    </div>
  </div>

  <!-- Scroll to top -->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/ruang-admin.min.js"></script>
  <!-- Page level plugins -->
  <script src="vendor/datatables/jquery.dataTables.min.js"></script>
  <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

  <!-- Page level custom scripts -->
  <script>
    $(document).ready(function () {
      $('#dataTable').DataTable(); // ID From dataTable 
      $('#dataTableHover').DataTable(); // ID From dataTable with Hover
    });
  </script>

</body>

</html>
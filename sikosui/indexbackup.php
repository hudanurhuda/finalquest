<?php
session_start();
error_reporting(E_ALL ^ (E_NOTICE | E_WARNING | E_DEPRECATED ));
if (isset($_SESSION['auth_username']))
{include "koneksi.php";

$auth_username=$_SESSION['auth_username'];
$auth_hak_akses=$_SESSION['auth_hak_akses'];

?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Kost Wisma UI</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="icon" type="image/png" sizes="16x16" href="favicon.ico">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="bootstrap/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="bootstrap/css/ionicons.min.css">
    <!-- Select2 -->
    <link rel="stylesheet" href="plugins/select2/select2.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables/dataTables.bootstrap.css">
    <!-- datepicker -->
    <link rel="stylesheet" href="plugins/datepicker/datepicker3.css">
    <!-- Morris charts -->
    <link rel="stylesheet" href="plugins/morris/morris.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/AdminLTE.min.css">

    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect.
    -->
    <link rel="stylesheet" href="dist/css/skins/skin-green.min.css">

    <style type="text/css">
    /*Bootstrap 3*/
    .modalpdf .modal-dialog{
         width: 80%;
    }
    </style>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">

      <!-- Main Header -->
      <header class="main-header">

        <!-- Logo -->
        <a href="index.php" class="logo">
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><img src="dist/img/logo.png" width="40px"><b>SIPDUKOP</b></span>
        </a>

        <!-- Header Navbar -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- User Account Menu -->
              <li class="dropdown user user-menu">
                <!-- Menu Toggle Button -->
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!-- The user image in the navbar-->
                  <?php
                    if ($auth_hak_akses=='Koperasi') {
                      echo "<i class='fa fa-building fa-lg'></i>";
                    }
                    elseif ($auth_hak_akses=='UMKM') {
                      echo "<i class='fa fa-briefcase fa-lg'></i>";
                    }
                    else {
                      echo "<i class='fa fa-user fa-lg'></i>";
                    }
                  ?>
                  <!-- hidden-xs hides the username on small devices so only the image appears. -->
                  <span class="hidden-xs">
                  <?php

                  if ($auth_hak_akses=='UMKM'){
                      $status=mysqli_query($koneksi,"select * from umkm where email_umkm='$auth_username'");
                      $stat=mysqli_fetch_assoc($status);
                      $nama=$stat['nama_umkm'];
                      echo $nama;
                  }
                  elseif ($auth_hak_akses=='Koperasi'){
                      $status=mysqli_query($koneksi,"select * from koperasi where email_koperasi='$auth_username'");
                      $stat=mysqli_fetch_assoc($status);
                      $nama=$stat['nama_koperasi'];
                      echo $nama;
                  }
                  else {
                      $status=mysqli_query($koneksi,"select * from penghuni where email_penghuni='$auth_username'");
                      $stat=mysqli_fetch_assoc($status);
                      $nama=$stat['nama_penghuni'];
                      echo $nama;
                  }
                  ?>
                  </span>
                  <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu">
                  <!-- The user image in the menu -->
                  <li class="user-header">
                    <?php
                      if ($auth_hak_akses=='Koperasi') {
                        echo "<i class='fa fa-building fa-5x'></i>";
                      }
                      elseif ($auth_hak_akses=='UMKM') {
                        echo "<i class='fa fa-briefcase fa-5x'></i>";
                      }
                      else {
                        echo "<i class='fa fa-user fa-5x'></i>";
                      }
                    ?>
                    <p>
                      <?php
                        echo $nama;
                      ?>
                      <small>
                        <?php
                          echo $auth_hak_akses;
                        ?>
                      </small>
                    </p>
                  </li>
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    <div class="pull-left">
                      <?php
                        if ($auth_hak_akses=='Koperasi') {
                          echo "<a href='?page=profilkoperasi' class='btn btn-success btn-flat'>Profil</a>";
                        }
                        elseif ($auth_hak_akses=='UMKM') {
                          echo "<a href='?page=profilumkm' class='btn btn-success btn-flat'>Profil</a>";
                        }
                        else {
                          echo "<a href='?page=profiladmin' class='btn btn-success btn-flat'>Profil</a>";
                        }
                      ?>
                    </div>
                    <div class="pull-right">
                      <a href="keluar.php" class="btn btn-success btn-flat">Keluar</a>
                    </div>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">

        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">

          <!-- Sidebar Menu -->
          <ul class="sidebar-menu">
            <li class="header">MAIN MENU</li>
            <!-- Optionally, you can add icons to the links -->
            <li <?php if (isset($_GET['page'])=='') { echo "class='active'"; }?> ><a href='index.php'><i class='fa fa-home text-success'></i> <span>Beranda</span></a></li>
            <?php

            if ($auth_hak_akses=="Admin" or $auth_hak_akses=="admin") {
              echo "
                <li class='treeview";?> <?php if (isset($_GET['page'])&&(($_GET['page'])=='umkm')||(($_GET['page'])=='pengusaha')||(($_GET['page'])=='jenisbadanusaha')
                  ||(($_GET['page'])=='kegiatanumkm')||(($_GET['page'])=='satuan')||(($_GET['page'])=='bahanbaku')||(($_GET['page'])=='produk')||(($_GET['page'])=='umkmperiode')) { echo "active"; }?> <?php echo " '>
                  <a href='#'><i class='fa fa-briefcase text-success'></i> <span>Data Keuangan</span> <i class='fa fa-angle-down pull-right'></i></a>
                  <ul class='treeview-menu'>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='umkm') { echo "class='active'"; }?> <?php echo "><a href='?page=umkm'><i class='fa fa-circle-o'></i> Data UMKM</a></li> ";

                      echo "
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='pengusaha') { echo "class='active'"; }?> <?php echo "><a href='?page=pengusaha'><i class='fa fa-circle-o'></i> Biaya</a></li>
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='jenisbadanusaha') { echo "class='active'"; }?> <?php echo "><a href='?page=jenisbadanusaha'><i class='fa fa-circle-o'></i> Pembayaran</a></li>
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='kegiatanumkm') { echo "class='active'"; }?> <?php echo "><a href='?page=kegiatanumkm'><i class='fa fa-circle-o'></i> Pengeluaran</a></li>
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='satuan') { echo "class='active'"; }?> <?php echo "><a href='?page=satuan'><i class='fa fa-circle-o'></i> Satuan Produksi</a></li>
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='bahanbaku') { echo "class='active'"; }?> <?php echo "><a href='?page=bahanbaku'><i class='fa fa-circle-o'></i> Bahanbaku Produksi</a></li>
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='produk') { echo "class='active'"; }?> <?php echo "><a href='?page=produk'><i class='fa fa-circle-o'></i> Produk</a></li>
                      ";

                    echo "<li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='umkmperiode') { echo "class='active'"; }?> <?php echo "><a href='?page=umkmperiode'><i class='fa fa-circle-o'></i> Data Produksi UMKM</a></li>
                  </ul>
                </li>
              ";
            }
            if ($auth_hak_akses=="admin" or $auth_hak_akses=="Admin Bidang Koperasi") {
              echo "
                <li class='treeview";?> <?php if (isset($_GET['page'])&&(($_GET['page'])=='koperasi')||(($_GET['page'])=='jeniskoperasi')||(($_GET['page'])=='kegiatankoperasi')
                  ||(($_GET['page'])=='pengurus')||(($_GET['page'])=='laporanratall')||(($_GET['page'])=='koperasiperiode')) { echo "active"; }?> <?php echo " '>
                  <a href='#'><i class='fa fa-building text-success'></i> <span>Koperasi</span> <i class='fa fa-angle-down pull-right'></i></a>
                  <ul class='treeview-menu'>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='koperasi') { echo "class='active'"; }?> <?php echo "><a href='?page=koperasi'><i class='fa fa-circle-o'></i> Data Koperasi</a></li> ";

                      echo "
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='jeniskoperasi') { echo "class='active'"; }?> <?php echo "><a href='?page=jeniskoperasi'><i class='fa fa-circle-o'></i> Jenis Koperasi</a></li>
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='kegiatankoperasi') { echo "class='active'"; }?> <?php echo "><a href='?page=kegiatankoperasi'><i class='fa fa-circle-o'></i> Kegiatan Koperasi</a></li>
                        <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='pengurus') { echo "class='active'"; }?> <?php echo "><a href='?page=pengurus'><i class='fa fa-circle-o'></i> Pengurus Koperasi</a></li>
                      ";

                    echo "
                      <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='laporanratall') { echo "class='active'"; }?> <?php echo "><a href='?page=laporanratall'><i class='fa fa-circle-o'></i> Laporan RAT</a></li>
                      <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='koperasiperiode') { echo "class='active'"; }?> <?php echo "><a href='?page=koperasiperiode'><i class='fa fa-circle-o'></i> Data Keanggotaan Koperasi</a></li>
                  </ul>
                </li>
              ";
            }
            if ($auth_hak_akses=="admin") {
              echo "
                <li class='treeview";?> <?php if (isset($_GET['page'])&&(($_GET['page'])=='desa')||(($_GET['page'])=='kecamatan')) { echo "active"; }?> <?php echo " '>
                  <a href='#'><i class='fa fa-globe text-success'></i> <span>Data Lokasi</span> <i class='fa fa-angle-down pull-right'></i></a>
                  <ul class='treeview-menu'>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='desa') { echo "class='active'"; }?> <?php echo "><a href='?page=desa'><i class='fa fa-circle-o'></i> Desa</a></li>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='kecamatan') { echo "class='active'"; }?> <?php echo "><a href='?page=kecamatan'><i class='fa fa-circle-o'></i> Kecamatan</a></li>
                  </ul>
                </li>
                <li class='treeview";?> <?php if (isset($_GET['page'])&&(($_GET['page'])=='penghuni')||(($_GET['page'])=='jabatan')) { echo "active"; }?> <?php echo " '>
                  <a href='#'><i class='fa fa-users text-success'></i> <span>Data penghuni</span> <i class='fa fa-angle-down pull-right'></i></a>
                  <ul class='treeview-menu'>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='penghuni') { echo "class='active'"; }?> <?php echo "><a href='?page=penghuni'><i class='fa fa-circle-o'></i> penghuni</a></li>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='jabatan') { echo "class='active'"; }?> <?php echo "><a href='?page=jabatan'><i class='fa fa-circle-o'></i> Jabatan</a></li>
                  </ul>
                </li>
                <li class='treeview";?> <?php if (isset($_GET['page'])&&(($_GET['page'])=='akunadmin')||(($_GET['page'])=='akunumkm')||(($_GET['page'])=='akunkoperasi')) { echo "active"; }?> <?php echo " '>
                  <a href='#'><i class='fa fa-user text-success'></i> <span>Data Akun</span> <i class='fa fa-angle-down pull-right'></i></a>
                  <ul class='treeview-menu'>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='akunadmin') { echo "class='active'"; }?> <?php echo "><a href='?page=akunadmin'><i class='fa fa-circle-o'></i> Akun Admin</a></li>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='akunumkm') { echo "class='active'"; }?> <?php echo "><a href='?page=akunumkm'><i class='fa fa-circle-o'></i> Akun UMKM</a></li>
                    <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='akunkoperasi') { echo "class='active'"; }?> <?php echo "><a href='?page=akunkoperasi'><i class='fa fa-circle-o'></i> Akun Koperasi</a></li>
                  </ul>
                </li>
              ";
            }
            if ($auth_hak_akses=="Koperasi") {
              echo "
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='datakopper') { echo "class='active'"; }?> <?php echo "><a href='?page=datakopper'><i class='fa fa-table text-success'></i> <span>Data Keanggotaan</span></a></li>
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='kepengurusan_koperasi') { echo "class='active'"; }?> <?php echo "><a href='?page=kepengurusan_koperasi'><i class='fa fa-users text-success'></i> <span>Data Kepengurusan</span></a></li>
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='laporanrat') { echo "class='active'"; }?> <?php echo "><a href='?page=laporanrat'><i class='fa fa-book text-success'></i> <span>Laporan RAT</span></a></li>
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='statkopper') { echo "class='active'"; }?> <?php echo "><a href='?page=statkopper'><i class='fa fa-bar-chart text-success'></i> <span>Statistik Koperasi</span></a></li>
              ";
            }
            if ($auth_hak_akses=="UMKM") {
              echo "
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='datauper') { echo "class='active'"; }?> <?php echo "><a href='?page=datauper'><i class='fa fa-table text-success'></i> <span>Data Produksi</span></a></li>
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='datapengusahaumkm') { echo "class='active'"; }?> <?php echo "><a href='?page=datapengusahaumkm'><i class='fa fa-users text-success'></i> <span>Data Pengusaha</span></a></li>
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='databahanbakuumkm') { echo "class='active'"; }?> <?php echo "><a href='?page=databahanbakuumkm'><i class='fa fa-flask text-success'></i> <span>Data Bahanbaku</span></a></li>
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='dataprodukumkm') { echo "class='active'"; }?> <?php echo "><a href='?page=dataprodukumkm'><i class='fa fa-cubes text-success'></i> <span>Data Produk</span></a></li>
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='statuper') { echo "class='active'"; }?> <?php echo "><a href='?page=statuper'><i class='fa fa-bar-chart text-success'></i> <span>Statistik Produksi</span></a></li>
              ";
            }
            if ($auth_hak_akses=="admin") {
              echo "
                <li";?> <?php if (isset($_GET['page'])&&($_GET['page'])=='backup') { echo "class='active'"; }?> <?php echo "><a href='?page=backup'><i class='fa fa-gears text-success'></i> <span>Backup dan Restore</span></a></li>
              ";
            }
            ?>
          </ul><!-- /.sidebar-menu -->
        </section>
        <!-- /.sidebar -->
      </aside>

      <!-- Content Wrapper. Contains page content -->
      <?php
        $page=$_GET['page'];
        if (empty($page))
        {
      ?>

      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Sistem Informasi Pengelolaan Data UMKM dan Koperasi (SIPDUKOP)
          </h1>
          <ol class="breadcrumb">
            <li><i class="fa fa-home"></i> Beranda </li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">

          <div class="row">
            <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Dinas Perindustrian Perdagangan dan Koperasi</h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p align="justify">Dinas Perindustrian, Perdagangan Dan Koperasi Kabupaten Purbalingga yang beralamat dijalan Mayor jendral Sungkono No. 24 Purbalingga, adalah salah satu perangkat daerah Kabupaten Purbalingga yang dibentuk pada tahun 2000.</p>
                  <p align="justify">Pembentukan Dinas Perindustrian, Perdagangan dan Koperasi Kabupaten Purbalingga ditetapkan dengan peraturan daerah (PERDA) Kabupaten Purbalingga No.15 Tahun 2008 tentang Organisasi Dan Tata Kerja Dinas Daerah Kabupaten.</p>
                  <p align="justify">Dinas Perindustrian, Perdagangan Dan Koperasi merupakan unsur pelaksanaan Pemerintah Daerah yang melaksanakan tugas di bidang Perindustrian, Perdagangan, Koperasi, Usaha Mikro kecil dan menengah yang dipimpin oleh seorang Kepala Dinas yang berada dibawah dan bertanggung jawab kepada Bupati melalui SEKDA.</p>
                  <p align="justify">Dinas Perindustrian, Perdagangan dan Koperasi mempunyai tugas pokok melaksanakan penyelenggaraan urusan Pemerintah Daerah di bidang Perindustrian, Perdagangan, Koperasi, Usaha mikro kecil dan menengah berdasarkan kebijakan yang di tetapkan oleh Bupati.</p>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
            <div class="col-md-6">
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Statistik UMKM dan Koperasi</h3>
                  <?php
                  $umkm=mysqli_query($koneksi,"select * from umkm");
                  $umkm1=mysqli_num_rows($umkm);
                  $koperasi=mysqli_query($koneksi,"select * from koperasi");
                  $koperasi1=mysqli_num_rows($koperasi);
                  ?>
                </div><!-- /.box-header -->
                <div class="box-body">
                  <p>Jumlah keseluruhan UMKM (Usaha Mikro Kecil dan Menengah) dan Koperasi yang ada di Kabupaten Purbalingga.</p>
                  <br>
                  <!-- Small boxes (Stat box) -->
                  <div class="row">
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-red">
                        <div class="inner">
                          <h3><?php echo "$umkm1" ?></h3>
                          <p>UMKM</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-briefcase"></i>
                        </div>
                        <a href="?page=statsemuaumkm" class="small-box-footer">
                          Lihat statistik <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div><!-- ./col -->
                    <div class="col-lg-6 col-xs-12">
                      <!-- small box -->
                      <div class="small-box bg-blue">
                        <div class="inner">
                          <h3><?php echo "$koperasi1" ?></h3>
                          <p>Koperasi</p>
                        </div>
                        <div class="icon">
                          <i class="fa fa-building"></i>
                        </div>
                        <a href="?page=statsemuakoperasi" class="small-box-footer">
                          Lihat statistik <i class="fa fa-arrow-circle-right"></i>
                        </a>
                      </div>
                    </div><!-- ./col -->
                  </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

          <!-- =========================================================== -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->

      <?php
        }
        else
        {
          include "$page.php";
        }
      ?>

      <!-- Main Footer -->
      <footer class="main-footer">
        <!-- Default to the left -->
        <strong>Copyright &copy; 2015 <a href="http://dinperindagkop.purbalinggakab.go.id/" target"_blank" >Disperindagkop Kabupaten Purbalingga</a>.</strong>
      </footer>
    </div><!-- ./wrapper -->

    <!-- REQUIRED JS SCRIPTS -->

    <!-- jQuery 2.1.4 -->
    <script src="plugins/jQuery/jQuery-2.1.4.min.js"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- Select2 -->
    <script src="plugins/select2/select2.full.min.js"></script>
    <!-- InputMask -->
    <script src="plugins/input-mask/jquery.inputmask.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
    <script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
    <!-- DataTables -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables/dataTables.bootstrap.min.js"></script>
    <!-- Datepicker -->
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
    <script src="plugins/datepicker/locales/bootstrap-datepicker.id.js"></script>
    <!-- Morris.js charts -->
    <script src="plugins/morris/raphael.min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <!-- AdminLTE App -->
    <script src="dist/js/app.min.js"></script>

  </body>
</html>

<?php
}
else
{

?>
<meta http-equiv=refresh content=0;url=login.php>

<?php
}
?>

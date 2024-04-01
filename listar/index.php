<?php
session_start();
include '../login/auth.php';
include '../core/conn.php';
include '../core/config.php';
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gestão de Encurtadores</title>

  <meta property="og:locale" content="pt_BR" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="Welcome - Mundo Ágil" />
	<meta property="og:url" content="http://www.mundoagil.com/" />
	<meta property="og:site_name" content="Mundo Ágil" />
	<meta property="article:publisher" content="https://www.facebook.com/agilmundo/" />
	<meta property="article:modified_time" content="2023-05-08T18:38:51+00:00" />
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="@mundo_agil" />
  
  <!-- Favicon -->
  <link rel="icon" href="http://www.mundoagil.com/wp-content/uploads/2020/09/favicom.png" type="image/png">
  
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="<?php echo BASE_PATH_LEVEL1; ?>plugins/summernote/summernote-bs4.min.css">
</head>
<body class="hold-transition sidebar-mini layout-footer-fixed">
<div class="wrapper">

  <!-- Preloader 
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="<?php echo BASE_PATH_LEVEL1; ?>dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>-->

  <!-- Navbar -->
  <?php include('../navbar.php') ?> 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php include('../sidebar.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Listar</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="">Gestão de Encurtadores</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-default">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <!-- Inserindo a tabela aqui -->
                            <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">
                            <!-- Tabela de links encurtados -->
                            <table class="table">
                              <thead>
                                  <tr>
                                      <th>Título do Código</th>
                                      <th>Descrição do Código</th>
                                      <th>Acessos</th>
                                      <th>Criado em</th>
                                      <th>Código</th>
                                      <th>Ações</th>
                                  </tr>
                              </thead>
                              <tbody>
                                  <?php
                                  // Verifica se existe uma mensagem de sucesso e a exibe
                                  if (isset($_SESSION['mensagem_sucesso'])) {
                                    // Utiliza o componente de alerta do Bootstrap
                                    echo '<div class="alert alert-success" role="alert">' .
                                         htmlspecialchars($_SESSION['mensagem_sucesso']) . 
                                         '</div>';
                                    unset($_SESSION['mensagem_sucesso']); // Remove a mensagem da sessão após exibi-la
                                  }

                                  if (isset($_SESSION['mensagem_sucesso'])) {
                                    echo '<div class="alert alert-success" role="alert">' .
                                         htmlspecialchars($_SESSION['mensagem_sucesso']) . 
                                         '</div>';
                                    unset($_SESSION['mensagem_sucesso']); // Remove a mensagem da sessão após exibi-la
                                }

                                
                                  include '../core/Encurtador.php'; // Ajuste o caminho conforme necessário
                                  // Inclua seu arquivo de conexão ao banco de dados

                                  $encurtador = new Encurtador($conn);
                                  $links = $encurtador->listar();

                                  foreach ($links as $link) {
                                      echo "<tr>";
                                      echo "<td>" . htmlspecialchars($link['titulo_codigo']) . "</td>";
                                      echo "<td>" . htmlspecialchars($link['desc_codigo']) . "</td>";
                                      echo "<td>" . htmlspecialchars($link['acessos']) . "</td>";
                                      echo "<td>" . htmlspecialchars($link['created']) . "</td>";
                                      // O código é um link clicável
                                      echo "<td><a href='http://zambon.ai/e/" . htmlspecialchars($link['codigo']) . "' target='_blank'>" . htmlspecialchars($link['codigo']) . "</a></td>";
                                      echo "<td><a href='deletar.php?id=" . htmlspecialchars($link['id']) . "' class='btn btn-danger' onclick='return confirm(\"Tem certeza que deseja deletar este link?\")'>Deletar</a></td>";
                                      echo "</tr>";
                                  }
                                  ?>
                              </tbody>
                          </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
  </div>
  <!-- /.content-wrapper -->
  <?php include('../footer.php') ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes 
<script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo BASE_PATH_LEVEL1; ?>dist/js/pages/dashboard.js"></script>
</body>
</html>

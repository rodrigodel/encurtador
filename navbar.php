<?php
//session_start();
?>
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/e/listar/" class="nav-link">Listar</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="/e/cadastrar/" class="nav-link">Cadastrar</a>
      </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
      <?php
        // Verifica se o usuário está autenticado
        if (isset($_SESSION['usuario'])):
          $nomeUsuario = $_SESSION['usuario']['nome'];
        ?>
             <li class="nav-item d-flex align-items-center">
            <!-- Nome do Usuário -->
            <span class="mr-2"><?php echo htmlspecialchars($nomeUsuario); ?></span>

            <!-- Ícone de Logout -->
            <a class="nav-link" href="/e/login/logout.php" role="button">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </li>
        <?php
        endif;
        ?>
      </li>
      <!-- Adicionando o botão de login -->
      <?php if (!isset($_SESSION['usuario'])): ?>
      <!-- Adicionando o botão de login -->
      <li class="nav-item">
          <a href="/e/login/login.php" class="nav-link">
            <i class="fas fa-sign-in-alt"></i> Login
          </a>
      </li>
      <?php endif; ?>
    </ul>
  </nav>
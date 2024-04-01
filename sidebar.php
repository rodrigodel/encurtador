<?php
//session_start();
include 'core/conn.php';

// Pega o endereço atual
$currentFile = basename($_SERVER['PHP_SELF']);
$currentDirectory = basename(dirname($_SERVER['PHP_SELF']));

// Pegando o Diretório E

// Primeiro, vamos obter o caminho completo da URL (excluindo o nome do domínio)
$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
// Em seguida, vamos dividir o caminho em suas partes
$pathParts = explode('/', trim($path, '/'));
// Agora, vamos pegar a penúltima parte do caminho, se houver
$penultimatePart = count($pathParts) > 1 ? $pathParts[count($pathParts) - 2] : '';
//echo $penultimatePart; // Isso deve imprimir 'e' para a URL http://zambon.ai/e/cadastrar/


//Gravatar

$email = "user@example.com"; // Substitua pelo email do usuário
$emailTrimmed = trim($email); // Remove espaços
$emailLowercase = strtolower($emailTrimmed); // Converte para minúsculas
$emailHash = md5($emailLowercase); // Gera o hash MD5

$gravatarUrl = "https://www.gravatar.com/avatar/" . $emailHash;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index.php" class="brand-link">
      <img src="http://zambon.ai/incidentes/images/quadrada_branca.png" alt="Mundo Ágil" class="brand-image img-circle elevation-1" style="opacity: 1">
      <span class="brand-text font-weight-light">Encurtadores</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <?php
          if (isset($_SESSION['usuario']['email'])) {
              $email = $_SESSION['usuario']['email']; // Usa o email da sessão

              $emailTrimmed = trim($email); // Remove espaços
              $emailLowercase = strtolower($emailTrimmed); // Converte para minúsculas
              $emailHash = md5($emailLowercase); // Gera o hash MD5

              $gravatarUrl = "https://www.gravatar.com/avatar/" . $emailHash . "?s=80&d=mp"; // URL do Gravatar

              echo '<img src="' . $gravatarUrl . '" alt="Avatar do Usuário" class="img-circle elevation-2">' ; // Exibe o avatar
          } else {
              echo "Email não encontrado na sessão.";
          }
          ?>
        </div>
        <div class="info">
        <?php
          if (isset($_SESSION['usuario']['nome'])) {
              $nomeUsuario = $_SESSION['usuario']['nome']; // Usa o nome do usuário da sessão

              echo '<a href="#" class="d-block">' . htmlspecialchars($nomeUsuario) . '</a>'; // Exibe o nome do usuário
          } else {
              echo "Nome de usuário não encontrado na sessão.";
          }
          ?>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               <li class="nav-item menu-<?php echo ($penultimatePart == 'e') ? 'open' : 'close'; ?>">
      <a href="/e/" class="nav-link <?php if ($penultimatePart == 'e') {echo 'active';} ?>">
      <i class="fas fa-link"></i>
        <p>
          Encurtadores
          <i class="right fas fa-angle-left"></i>
        </p>
      </a>
            <ul class="nav nav-treeview">
            <li class="nav-item">
                <a href="/e/listar/" class="nav-link <?php if ($currentDirectory == 'listar') {echo 'active';} ?>">
                <i class="fas fa-list"></i>
                    <p>Listar</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="/e/cadastrar/" class="nav-link <?php if ($currentDirectory == 'cadastrar') {echo 'active';} ?>"> 
                <i class="fas fa-plus-circle"></i>
                    <p>Cadastrar</p>
                </a>
            </li>
          </ul>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
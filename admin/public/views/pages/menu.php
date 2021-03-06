<aside class="main-sidebar elevation-4 sidebar-light-success">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="public/views/resources/img/refcon-logo.png" alt="MRMS-logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bolder">REFCON-Web</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="public/views/resources/img/sidebar-logo.jpg" class="img-circle elevation-2" alt="LOGIN MRMS">
            </div>
            <div class="info">
                <a href="dashboard" class="d-block font-weight-bolder">Hola! <br><?php echo $_SESSION["loginNombresRef"]; ?></a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="dashboard" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Panel
                        </p>
                    </a>
                </li>
                <?php
                if ($_SESSION["loginPerfilRef"] == 1) {
                    echo '<li class="nav-header">Administración</li>
                    <li class="nav-item">
                        <a href="usuarios" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Gestión</li>
                    <li class="nav-item">
                        <a href="referencias" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Referencias
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-header">Reportes</li>
                    <li class="nav-item">
                        <a href="reporte-general" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                General
                            </p>
                        </a>
                    </li>';
                } else if ($_SESSION["loginPerfilRef"] == 2) {
                    echo '
                    <li class="nav-header">Gestión</li>
                    <li class="nav-item">
                        <a href="referencias" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Referencias
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-header">Reportes</li>
                    <li class="nav-item">
                        <a href="reporte-general" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                General
                            </p>
                        </a>
                    </li>';
                } else if ($_SESSION["loginPerfilRef"] == 3) {
                    echo '<li class="nav-header">Gestión</li>
                    <li class="nav-item">
                        <a href="referencias" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Referencias
                            </p>
                        </a>
                    </li>';
                }
                ?>
                <!-- <li class="nav-header">Administración</li>
                <li class="nav-item">
                    <a href="usuarios" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>
                            Usuarios
                        </p>
                    </a>
                </li>
                <li class="nav-header">Gestión</li>
                <li class="nav-item">
                    <a href="referencias" class="nav-link">
                        <i class="nav-icon fas fa-file-invoice"></i>
                        <p>
                            Referencias
                        </p>
                    </a>
                </li>

                <li class="nav-header">Reportes</li>
                <li class="nav-item">
                    <a href="reporte-general" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            General
                        </p>
                    </a>
                </li> -->
            </ul>
        </nav>
    </div>
</aside>
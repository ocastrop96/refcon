<aside class="main-sidebar elevation-4 sidebar-light-success">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
        <img src="public/views/resources/img/mrms-logo.png" alt="MRMS-logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bolder">MRMS-Web</span>
    </a>

    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="public/views/resources/img/sidebar-logo.jpg" class="img-circle elevation-2" alt="LOGIN MRMS">
            </div>
            <div class="info">
                <a href="dashboard" class="d-block font-weight-bolder">Hola! <br><?php echo $_SESSION["loginNombresMR"]; ?></a>
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

                <!-- Bloque de opciones de menú por usuario -->
                <?php
                if ($_SESSION["loginPerfilMR"] == 1) {
                    echo '<li class="nav-header">Administración</li>
                    <li class="nav-item">
                        <a href="usuarios" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Usuarios
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Personal</li>
                    <li class="nav-item">
                        <a href="empleados" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>
                                Empleados
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="cargos" class="nav-link">
                            <i class="nav-icon fas fa-business-time"></i>
                            <p>
                                Cargos
                            </p>
                        </a>
                    </li>
    
                    <li class="nav-header">Gestión</li>
                    <li class="nav-item">
                        <a href="licencias" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Licencias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="salud-ocupacional" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Salud Ocupacional
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Reportes</li>
                    <li class="nav-item">
                        <a href="reporte-empleado" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Empleado
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reporte-coordinador" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Coordinador
                            </p>
                        </a>
                    </li>';
                } elseif ($_SESSION["loginPerfilMR"] == 2) {
                    echo '<li class="nav-header">Personal</li>
                    <li class="nav-item">
                        <a href="empleados" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>
                                Empleados
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Gestión</li>
                    <li class="nav-item">
                        <a href="licencias" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Licencias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="salud-ocupacional" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Salud Ocupacional
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Reportes</li>
                    <li class="nav-item">
                        <a href="reporte-empleado" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Empleado
                        </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reporte-coordinador" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Coordinador
                            </p>
                        </a>
                    </li>';
                } elseif ($_SESSION["loginPerfilMR"] == 4) {
                    echo '<li class="nav-header">Gestión</li>
                    <li class="nav-item">
                        <a href="licencias" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Licencias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="salud-ocupacional" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Salud Ocupacional
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Reportes</li>
                    <li class="nav-item">
                        <a href="reporte-empleado" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Empleado
                        </p>
                        </a>
                    </li>';
                } else {
                    echo '<li class="nav-header">Personal</li>
                    <li class="nav-item">
                        <a href="empleados" class="nav-link">
                            <i class="nav-icon fas fa-people-carry"></i>
                            <p>
                                Empleados
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Gestión</li>
                    <li class="nav-item">
                        <a href="licencias" class="nav-link">
                            <i class="nav-icon fas fa-file-invoice"></i>
                            <p>
                                Licencias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="salud-ocupacional" class="nav-link">
                            <i class="nav-icon fas fa-user-md"></i>
                            <p>
                                Salud Ocupacional
                            </p>
                        </a>
                    </li>
                    <li class="nav-header">Reportes</li>
                    <li class="nav-item">
                        <a href="reporte-empleado" class="nav-link">
                            <i class="nav-icon fas fa-chart-pie"></i>
                            <p>
                                Empleado
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="reporte-coordinador" class="nav-link">
                            <i class="nav-icon fas fa-chart-line"></i>
                            <p>
                                Coordinador
                            </p>
                        </a>
                    </li>';
                }

                ?>
                <!-- Bloque de opciones de menú por usuario -->
                <!-- <li class="nav-header">Reportes</li>
                <li class="nav-item">
                    <a href="reporte-coordinador" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Coordinador
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte-jefatura" class="nav-link">
                        <i class="nav-icon fas fa-chart-line"></i>
                        <p>
                            Jefatura
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="reporte-responsable" class="nav-link">
                        <i class="nav-icon fas fa-chart-bar"></i>
                        <p>
                            Responsable
                        </p>
                    </a>
                </li> -->
            </ul>
        </nav>
    </div>
</aside>
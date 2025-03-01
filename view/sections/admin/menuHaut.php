<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
  <!-- Navbar Brand (Logo)-->
  <a class="navbar-brand ps-3" href="index.html">StudentX Admin</a>

  <!-- Spacer between logo and user icon -->
  <div class="ms-auto"></div>

  <!-- Navbar Right Side (User Profile)-->
  <ul class="navbar-nav me-3 me-lg-4">
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-user fa-fw"></i>
      </a>
      <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
        <li><a class="dropdown-item" href="#!">Paramètres</a></li>
        <li><a class="dropdown-item" href="#!">Journal d'activité</a></li>
        <li><hr class="dropdown-divider" /></li>
        <li><a class="dropdown-item" href="#!">Se déconnecter</a></li>
      </ul>
    </li>
  </ul>
</nav>

<!-- Styles personnalisés -->
<style>
  .navbar-dark {
    background-color: #2c3e50; /* Couleur du fond du menu */
  }

  .navbar-nav .nav-item .nav-link {
    color: #ecf0f1; /* Couleur des liens */
    font-size: 1.1rem;
    transition: color 0.3s ease-in-out;
  }

  .navbar-nav .nav-item .nav-link:hover {
    color: #1abc9c; /* Effet de survol */
  }

  .navbar-nav .nav-item .dropdown-menu {
    background-color: #34495e;
  }

  .navbar-nav .nav-item .dropdown-menu .dropdown-item {
    color: #ecf0f1;
  }

  .navbar-nav .nav-item .dropdown-menu .dropdown-item:hover {
    background-color: #2c3e50;
  }

  .navbar-brand {
    font-weight: bold;
    color: #ecf0f1;
    font-size: 1.5rem;
  }

  .navbar-brand:hover {
    color: #1abc9c;
  }

  .navbar-nav .nav-item .nav-link i {
    font-size: 1.2rem;
  }
</style>

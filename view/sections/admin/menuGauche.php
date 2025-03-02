<div id="layoutSidenav_nav">
  <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
    <div class="sb-sidenav-menu">
      <div class="nav">
        
        <!-- Dashboard -->
        <a class="nav-link" href="admin">
          <div class="sb-nav-link-icon">
            <i class="fas fa-tachometer-alt"></i>
          </div>
          <span class="menu-item">Tableau de bord</span>
        </a>

        <!-- Gestion des Étudiants -->
        <a class="nav-link" href="listeEtudiants">
          <div class="sb-nav-link-icon">
            <i class="fas fa-users"></i>
          </div>
          <span class="menu-item">Gestion des étudiants</span>
        </a>

        <!-- Gestion des Évaluations -->
        <a class="nav-link" href="listeEvaluations">
          <div class="sb-nav-link-icon">
            <i class="fas fa-list"></i>
          </div>
          <span class="menu-item">Gestion des évaluations</span>
        </a>

        <!-- Gestion des Notes -->
        <a class="nav-link" href="listeNotes">
          <div class="sb-nav-link-icon">
            <i class="fas fa-file-alt"></i>
          </div>
          <span class="menu-item">Gestion des notes</span>
        </a>

        <!-- Paramètres -->
        <a class="nav-link" href="gestionUtilisateurs">
          <div class="sb-nav-link-icon">
            <i class="fas fa-cogs"></i>
          </div>
          <span class="menu-item">Gestion des utilisateurs</span>
        </a>
        <a class="nav-link" href="gestionMDP">
          <div class="sb-nav-link-icon">
            <i class="fas fa-lock"></i>
          </div>
          <span class="menu-item">Changer mot de passe</span>
        </a>
      </div>
    </div>
  </nav>
</div>

<!-- Styles personnalisés -->
<style>
  .sb-sidenav-menu {
    padding-left: 0;
    padding-right: 0;
  }

  /* Liens de navigation */
  .nav-link {
    display: flex;
    align-items: center;
    padding: 1rem 1.5rem;
    text-decoration: none;
    color: #ecf0f1; /* Liens en blanc */
    background-color: transparent; /* Pas de fond */
    border-radius: 5px;
    transition: background-color 0.3s ease-in-out, color 0.3s ease;
  }

  /* Effet de survol */
  .nav-link:hover {
    background-color: #2c3e50; /* Fond foncé au survol */
    color: #ecf0f1; /* Texte blanc au survol */
  }

  /* Icônes des liens */
  .sb-nav-link-icon {
    font-size: 1.2rem;
    margin-right: 12px;
  }

  /* Texte des liens */
  .menu-item {
    font-weight: 500;
    letter-spacing: 0.5px;
    font-size: 1rem;
  }

  .sb-sidenav-dark {
    background-color: #2c3e50; /* Fond sombre du menu */
  }

  /* Titre de section */
  .sb-sidenav-menu-heading {
    font-weight: bold;
    letter-spacing: 1px;
    font-size: 1.1rem;
    color: #ecf0f1;
    padding: 1rem 1.5rem;
    background-color: #34495e;
    margin-bottom: 5px;
    border-radius: 5px;
  }
</style>

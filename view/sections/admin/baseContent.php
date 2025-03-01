<main>
  <div class="container-fluid px-4">
    <!-- Content Header -->
    <h1 class="mt-4">Bienvenue, Administrateur</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item active">Que souhaitez-vous faire aujourd'hui ?</li>
    </ol>

    <!-- Section Cards -->
    <div class="row g-4">
      <div class="col-lg-3 col-md-6">
        <div class="card bg-primary text-white shadow-sm animate-hover h-100">
          <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
            <i class="fas fa-user-graduate fa-2x mb-2"></i>
            <h5>Gérer les étudiants</h5>
          </div>
          <div class="card-footer d-flex justify-content-between align-items-center">
            <a class="small text-white stretched-link" href="gestion_etudiants.php">Accéder</a>
            <i class="fas fa-angle-right"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card bg-warning text-white shadow-sm animate-hover h-100">
          <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
            <i class="fas fa-clipboard-list fa-2x mb-2"></i>
            <h5>Gérer les notes</h5>
          </div>
          <div class="card-footer d-flex justify-content-between align-items-center">
            <a class="small text-white stretched-link" href="#">Accéder</a>
            <i class="fas fa-angle-right"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card bg-success text-white shadow-sm animate-hover h-100">
          <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
            <i class="fas fa-file-alt fa-2x mb-2"></i>
            <h5>Gérer les évaluations</h5>
          </div>
          <div class="card-footer d-flex justify-content-between align-items-center">
            <a class="small text-white stretched-link" href="#">Accéder</a>
            <i class="fas fa-angle-right"></i>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6">
        <div class="card bg-danger text-white shadow-sm animate-hover h-100">
          <div class="card-body d-flex flex-column align-items-center justify-content-center text-center">
            <i class="fas fa-user-shield fa-2x mb-2"></i>
            <h5>Gestion des administrateurs</h5>
          </div>
          <div class="card-footer d-flex justify-content-between align-items-center">
            <a class="small text-white stretched-link" href="#">Accéder</a>
            <i class="fas fa-angle-right"></i>
          </div>
        </div>
      </div>
    </div>

    <!-- Section Charts -->
    <div class="row mt-4">
      <!-- Graphique des inscriptions -->
      <div class="col-lg-6">
        <div class="card mb-4 shadow-sm h-100">
          <div class="card-header">
            <i class="fas fa-chart-line me-1"></i> Statistiques des étudiants
          </div>
          <div class="card-body">
            <div id="chartInscriptions"></div>
          </div>
        </div>
      </div>
      
      <!-- Graphique des notes -->
      <div class="col-lg-6">
        <div class="card mb-4 shadow-sm h-100">
          <div class="card-header">
            <i class="fas fa-chart-bar me-1"></i> Répartition des notes
          </div>
          <div class="card-body">
            <div id="chartNotes"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Styles et animations -->
<style>
  .animate-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
  }
  .animate-hover:hover {
    transform: scale(1.05);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  }
</style>

<!-- Scripts ApexCharts -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
  // Graphique des inscriptions
  var optionsInscriptions = {
    chart: { type: "line", height: 300 },
    series: [{ name: "Inscriptions", data: [120, 150, 180, 200, 220, 250] }],
    xaxis: { categories: ["Jan", "Fév", "Mar", "Avr", "Mai", "Juin"] }
  };
  new ApexCharts(document.querySelector("#chartInscriptions"), optionsInscriptions).render();

  // Graphique des notes
  var optionsNotes = {
    chart: { type: "bar", height: 300 },
    series: [{ name: "Nombre d'étudiants", data: [5, 20, 35, 25, 15] }],
    xaxis: { categories: ["<10", "10-12", "12-14", "14-16", ">16"] }
  };
  new ApexCharts(document.querySelector("#chartNotes"), optionsNotes).render();
</script>

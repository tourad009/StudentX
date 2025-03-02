<div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Connexion</h3></div>
                                    <div class="card-body">
                                        <!-- Affichage des messages d'erreur -->
                                        <?php if (isset($_GET['error']) && $_GET['error'] == 1): ?>
                                            <div class="alert alert-danger">
                                                <?= htmlspecialchars($_GET['message'] ?? 'Une erreur est survenue.') ?>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Formulaire de connexion -->
                                        <form action="UserMainController" method="POST">
                                            <input type="hidden" name="formLogin" value="1">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputEmail" type="email" name="email" placeholder="name@example.com" required />
                                                <label for="inputEmail">Adresse email</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="inputPassword" type="password" name="password" placeholder="Mot de passe" required />
                                                <label for="inputPassword">Mot de passe</label>
                                            </div>
                                            <div class="form-check mb-3">
                                                <input class="form-check-input" id="inputRememberPassword" type="checkbox" value="" />
                                                <label class="form-check-label" for="inputRememberPassword">Se souvenir de moi</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <a class="small" href="password.html">Mot de passe oublié?</a>
                                                <button type="submit" class="btn btn-primary">Connexion</button>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="register.html">Besoin d'un compte? S'inscrire!</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
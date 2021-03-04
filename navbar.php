<nav class="navbar fixed-top navbar-expand-lg navbar-dark" style="font-weight: bold; background-color: #062c33;">
    <div class="container">
        <a class="navbar-dark h5 mb-0 mr-4" href="index.php"style="color: #007bff;"><img src="img/logo.png" class="mr-3" style="width: 12%;">Reconhecimento de Voz</a>
        <!--<a class="navbar-brand h1 mb-0" href="index.php"><img src="imagens/logo-sistema.png"></a>--> 

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSite">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSite">
            <ul class="navbar-nav ">

                <li class="nav-item">
                    <a class="nav-link <?php echo isset($active); ?>" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($active); ?>" href="palestra.php">Palestra</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($active); ?>" href="video.php">Vídeo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($active); ?>" href="depoimento.php">Depoimento</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($active); ?>" href="artigo.php">Artigo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php echo isset($active); ?>" href="comandos.php">Comandos</a>
                </li>


            </ul>

        </div>  

    </div>
</nav>
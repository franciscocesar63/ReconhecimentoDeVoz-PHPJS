<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Reconhecimento de Voz</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        
        <![endif]-->
        <script type="text/javascript" src="js/js.js"></script>
    </head>

    <body >
        <?php
        include_once './navbar.php';
        ?>
        <div class="container" style="margin-top: 75px;border: solid 3px; border-radius: 25px;">
            <center><h2>Questionário</h2></center>
            <form method="POST" action="#">
                    <label for="nome">Qual o seu nome?</label>
                    <input class="form-control" type="text" id="nome" name="nome">
 
                
                    <label for="idade">Qual a sua idade?</label>
                    <input class="form-control" type="text" id="idade" name="idade">
 
                
                    <label for="sexo">Qual o seu sexo?</label>
                    <input class="form-control" type="text" id="sexo" name="sexo">
 
                
                    <label for="deficiencia">Você poderia descrever a sua deficiência em poucas palavras?</label>
                    <input class="form-control" type="text" id="deficiencia" name="deficiencia">
 
                
                    <label for="opniao">Você poderia opinar sobre este projeto?</label>
                    <input class="form-control" type="text" id="opniao" name="opniao">
 
                
                    <label for="ideia">Você possuí alguma ideia para nós melhorarmos nosso projeto?</label>
                    <input class="form-control" type="text" id="ideia" name="ideia">
 
                
                    
            </form>


        </div>

    </body>
</html>
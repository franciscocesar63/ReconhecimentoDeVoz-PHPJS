<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Reconhecimento de Voz</title>

        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" >
        <link rel="stylesheet" href="css/styles.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://code.responsivevoice.org/responsivevoice.js"></script>

        <script type="text/javascript">
            // Fazemos que o código só funcione apos o carregamento completo da pagina


            window.addEventListener('DOMContentLoaded', function () {
                // Instanciamos o nosso botão
//        var btn_gravacao = document.querySelector('#btn_gravar_audio');
                // Crio a variavel que amarzenara a transcrição do audio
                var transcricao_audio = '';
                // Seto o valor false para a variavel esta_gravando para fazermos a validação se iniciou a gravação
                var esta_gravando = false;
                // Verificamos se o navegador tem suporte ao Speech API
                if (window.SpeechRecognition || window.webkitSpeechRecognition) {
                    // Como não sabemos qual biblioteca usada pelo navegador 
                    // Atribuimos a api retornada pelo navegador
                    var speech_api = window.SpeechRecognition || window.webkitSpeechRecognition;
                    // Criamos um novo objeto com a API Speech
                    var recebe_audio = new speech_api();
                    // Defino se a gravação sera continua ou não
                    // Caso deixamos ela definida como false a gravação tera um tempo estimado 
                    // de 4 a 5 segundos
                    recebe_audio.continuous = true;
                    // Especifico se o resultado final pode ser alterado ou não pela compreenção da api
                    recebe_audio.interimResults = true;
                    // Especifico o idioma utilizado pelo usuario
                    recebe_audio.lang = "pt-BR";
                    // uso o metodo onstart para setar a minha variavel esta_gravando como true
                    // e modificar o texto do botão
                    recebe_audio.onstart = function () {
//            esta_gravando = true;
//            btn_gravacao.innerHTML = 'Gravando! Parar gravação.';
                        recebe_audio.start();
                    };
                    // uso o metodo onend para setar a minha variavel esta_gravando como false
                    // e modificar o texto do botão
                    recebe_audio.onend = function () {
//            esta_gravando = false;
//            btn_gravacao.innerHTML = 'Iniciar Gravação';
                        recebe_audio.start();
                    };


                    recebe_audio.onerror = function (event) {
                        recebe_audio.start();
                        console.log(event.error);
                    };

                    // Com o metodo onresult posso capturar a transcrição do resultado 
                    recebe_audio.onresult = function (event) {
                        // Defino a minha variavel interim_transcript como vazia
                        var interim_transcript = '';
                        // Utilizo o for para contatenar os resultados da transcrição 
                        for (var i = event.resultIndex; i < event.results.length; i++) {
                            // verifico se o parametro isFinal esta setado como true com isso identico se é o final captura
                            if (event.results[i].isFinal) {
                                // Contateno o resultado final da transcrição
                                transcricao_audio = event.results[i][0].transcript;
                            } else {
                                // caso ainda não seja o resultado final vou contatenado os resultados obtidos
                                interim_transcript = event.results[i][0].transcript;
                            }
                            // Verifico qual das variaveis não esta vazia e atribuo ela no variavel resultado
                            var resultado = transcricao_audio || interim_transcript;
                            // Escrevo o resultado no campo da textarea
//                document.getElementById('campo_texto').innerHTML = resultado;

                            var final = trim(resultado);
//                alert('.' + final);
//                console.log(final);
                        }
                        if (final.toLowerCase() == "inicio" || final.toLowerCase() == "início") {
                            window.location.href = "index.php";
//                alert("funciona");
                        } else if (final.toLowerCase() == "video" || final.toLowerCase() == "vídeo") {
                            window.location.href = "video.php";
                        } else if (final.toLowerCase() == "palestra") {
                            window.location.href = "palestra.php";
                        } else if (final.toLowerCase() == "depoimento" || final.toLowerCase() == "depoimentos") {
                            window.location.href = "depoimento.php";
                        } else if (final.toLowerCase() == "artigo") {
                            window.location.href = "artigo.php";
                        } else if (final.toLowerCase() == "atualizar" || final.toLowerCase() == "atualizar página") {
                            location.reload();
//                            alert("teste");
                        } else if (final.toLowerCase() == "comandos" || final.toLowerCase() == "comando") {
                            window.location.href = "comandos.php";
                        }

                    };
                    // Capturamos a ação do click no botão e iniciamos a gravação ou a paramos
                    // dependendo da variavel de controle esta_gravando
//                    btn_gravacao.addEventListener('click', function (e) {
//                        // Verifico se esta gravando ou não
//                        if (esta_gravando) {
//                            // Se estiver gravando mando parar a gravação
//                            recebe_audio.stop();
//                            // Dou um retun para sair da função
//                            return;
//                        }
//                        // Caso não esteja capturando o audio inicio a transcrição
//                        recebe_audio.start();
//                    }, false);
                    recebe_audio.start();


                } else {
                    // Caso não o navegador não apresente suporte ao Speech API apresentamos a seguinte mensagem
                    console.log('navegador não apresenta suporte a web speech api');
                    // alert('Este navegador não apresenta suporte para essa funcionalidade ainda');
                }
            }, false);

            function trim(vlr) {
                return vlr.replace(" ", "");
            }


        </script>

    </head>

    <body >
        <div class="container">

            <?php
            include_once './navbar.php';
            ?>

            <center><h2 style="margin-top: 75px;">Comandos</h2></center>
            <h5>Gerais: </h5>
            <p>Para acesssar qualquer página basta falar o seu endereço, páginas disponíveis: <br><strong>Início, Palestra, Depoimento, Artigo e Comandos.</strong></p>
            <h5>Palestra: </h5>
            <p>A palestra é iniciada automaticamente, mas caso não inicie fale a palavra <strong>Palestra</strong> novamente.</p>
            <h5>Vídeo: </h5>
            <p>O vídeo é iniciado automaticamente, mas caso não inicie fale a palavra <strong>Vídeo</strong> novamente.</p>
            <h5>Depoimento: </h5>
            <p>O depoimento é iniciado automaticamente, mas caso não inicie fale a palavra <strong>Depoimento</strong> novamente.</p>
            <h5>Artigo: </h5>
            <p>Para navegar entre as páginas do artigo basta falar <strong>Próxima página</strong> ou <strong>Próxima</strong> para
                passar a página e <strong>Voltar</strong> ou <strong>Página anterior</strong> para voltar para a página anterior.</p>




            <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

            <script src="js/bootstrap.min.js"></script>
            <script src="js/main.js"></script>

            <script type="text/javascript">
                    var voice = 'Brazilian Portuguese Female';
                    responsiveVoice.speak('Olá, bem vindo à página de comandos do site. Nosso site se divide em 5 partes, em comandos Gerais, na qual basta você falar \n\
            a página que deseja navegar, exemplo: Início, Palestra, Depoimentos, Artigos ou Comandos. E Dentro dessa página também possuímos outros comandos.\n\
        Na Palestra e no Vídeo e no Depoimento, caso os vídeos não iniciem altomaticamente, basta falar novamente os respectivos nomes,\n\
        quanto ao artigo basta falar próxima página ou página anterior que automaticamente ele passará a página para você. Tenha um bom dia!', voice);
            </script>
        </div>
        <?php
        include_once("rodape.php");
        ?>
    </body>
</html>
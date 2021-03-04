<!DOCTYPE HTML>
<html lang="pt-BR">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        <title>Reconhecimento de Voz</title>
        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="css/bootstrap.css" type="text/css">
        <link rel="stylesheet" href="css/styles.css" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
        <script src="https://code.responsivevoice.org/responsivevoice.js"></script>

        <script src="js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
        <!--Script do reconhecimento abaixo.-->
        <script type="text/javascript" >
            // Fazemos que o código só funcione apos o carregamento completo da pagina
            window.addEventListener('DOMContentLoaded', function () {
                var nome = false;
                // Instanciamos o nosso botão
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
                        esta_gravando = true;
//            btn_gravacao.innerHTML = 'Gravando! Parar gravação.';
                    };
                    // uso o metodo onend para setar a minha variavel esta_gravando como false
                    // e modificar o texto do botão
                    recebe_audio.onend = function () {
                        esta_gravando = false;
//            btn_gravacao.innerHTML = 'Iniciar Gravação';
                    };


                    recebe_audio.onerror = function (event) {
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
                            var final = trim(resultado);
                            console.log(final);
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
//                             alert("teste");
                        } else if (final.toLowerCase() == "comandos" || final.toLowerCase() == "comando") {
                            window.location.href = "comandos.php";
                        }
                    };
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
            function validaNome(campo) {
                var regex = /^[a-zA-ZéúíóáÉÚÍÓÁèùìòàçÇÈÙÌÒÀõãñÕÃÑêûîôâÊÛÎÔÂëÿüïöäËYÜÏÖÄ\-\ \s]+$/;
                if (campo.match(regex)) {
                    return false;
                } else {
                    return true;
                }
            }
        </script>
    </head>
    <body>
        <?php
        include_once './navbar.php';
        ?>
        <div class="row"style="margin-top: 50px;">
            <div class="col-md-8">
                <img src="img/sem-bracos-sem-problema.jpg" width="105%" height="100%">

            </div>
            <div class="col-md-4" >
                <h2 style="color: #ffffff; margin-top: 65px; position: absolute;font-weight: bold;text-align: center; font-size: 55px;">Para saber os comandos do site 
                    fale: comandos.</h2>
                <img src="img/jovem-braco-mecanico.jpg" width="100%"/>
            </div>
        </div>
        <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

        <script src="js/bootstrap.min.js"></script>
        <script src="js/main.js"></script>

        <script type="text/javascript">
            var voice = 'Brazilian Portuguese Female';
            responsiveVoice.speak('Olá tudo bem? Para saber os comandos do site fale Comandos, lá você terá acesso a tudo o que necessita saber para navegar tranquilamente em nosso site.', voice);
        </script>

        <?php
        include_once("rodape.php");
        ?>
    </body>

</html>
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

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        
        <![endif]-->
        <script type="text/javascript">
            // Fazemos que o código só funcione apos o carregamento completo da pagina
            window.addEventListener('DOMContentLoaded', function () {
                // Instanciamos o nosso botão
                var btn_gravacao = document.querySelector('#btn_gravar_audio');
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
//                document.getElementById('campo_texto').innerHTML = resultado;

                            var final = trim(resultado);
//                alert('.' + final);

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
                        } else if (final.toLowerCase() == "próxima página" || final.toLowerCase() == "próximo" || final.toLowerCase() == "próxima") {
                            window.location.href = "artigo_pag11.php";
                        } else if (final.toLowerCase() == "página anterior" || final.toLowerCase() == "anterior" || final.toLowerCase() == "voltar") {
                            window.location.href = "artigo_pag9.php";
                        } else if (final.toLowerCase() == "comandos" || final.toLowerCase() == "comando") {
                            window.location.href = "comandos.php";
                        }

                    };
                    // Capturamos a ação do click no botão e iniciamos a gravação ou a paramos
                    // dependendo da variavel de controle esta_gravando
                    //        btn_gravacao.addEventListener('click', function (e) {
                    //            // Verifico se esta gravando ou não
                    //            if (esta_gravando) {
                    //                // Se estiver gravando mando parar a gravação
                    //                recebe_audio.stop();
                    //                // Dou um retun para sair da função
                    //                return;
                    //            }
                    //            // Caso não esteja capturando o audio inicio a transcrição
                    //            recebe_audio.start();
                    //        }, false);
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
            <!--<h3 style="margin-top: 75px;">Deficiência visual, auditiva e física: prevalência e fatores associados em estudo de base populacional</h3>-->

            <h5 style="margin-top: 75px;">DISCUSSÃO</h5>
            <div class="border-top-bottom">
                <p>A principal causa definida de deficiência visual no presente estudo foi atribuída à doença e, entre os sexos, as porcentagens foram 26,8 para os homens e 32,1 para as mulheres. Como segunda causa de deficiência visual foi relatado o envelhecimento, seguido pelas causas congênitas, em homens e mulheres. A respeito das causas da deficiência visual, os resultados encontrados são semelhantes aos de outros estudos, indicando as doenças como principal causa 25,33,34,42. Alguns autores ainda ressaltam que quase sempre essas doenças são preveníveis ou tratáveis, o que indica que com um melhor acesso aos serviços de saúde a freqüência dessa deficiência provavelmente diminuiria 43,44. Temporini & Kara-Jose 45 relatam que estratégias de prevenção da cegueira ou perda visual poderiam ser adotadas nas esferas de prevenção primária (identificação de grupos de risco e proposta de políticas de prevenção); secundária (diagnóstico precoce e atendimento imediato); e prevenção terciária (tratamento e reabilitação de moléstias como a catarata, tracoma, oncocercose, avitaminose A e erros de refração). A idade parece associada à deficiência visual por causa do caráter degenerativo de algumas moléstias advindas com o tempo. As causas congênitas são citadas em outras pesquisas 25,30,34 como causadoras de deficiência visual, porém não com a importância verificada no presente estudo. Nesse caso, cuidados em saúde deveriam ser direcionados às pessoas de grupos de risco para essa deficiência, ou seja, àquelas de idade avançada, com maior ênfase para as mulheres.</p>
                <p>A principal causa da deficiência auditiva foram as causas externas. Os deficientes do sexo masculino registraram maior prevalência de deficiências auditivas por causas externas que as mulheres. As doenças foram a segunda maior causa de acometimentos auditivos na presente pesquisa e são apontadas como principais causadoras das deficiências auditivas por alguns estudiosos 37,45,46. Hudspeth 46 ressalta a importância do fator ocupacional na etiologia da deficiência auditiva, assegurando que o processo de industrialização e a maior exposição a fatores de risco são importantes na determinação da deficiência auditiva. O fator idade é outro componente importante porque com o envelhecimento os pequenos vasos sanguíneos do ouvido sofrem a ação das placas de aterosclerose, prejudicando a irrigação sangüínea da área, levando a deterioração da audição 46. A prevenção da surdez ou da perda auditiva pode englobar fatores que vão desde a diminuição de tempo de exposição a ruídos, cuidados com medicações ototóxicas, passando por processos educativos voltados à detecção e tratamento das doenças que podem conduzir à perda auditiva 47.</p>
                <p></p>


            </div>

            <a href="artigo_pag9.php" style="float: left">Página anterior</a>
            <a href="artigo_pag11.php" style="float: right">Próxima página</a>



            <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
            <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

            <script src="js/bootstrap.min.js"></script>
            <script src="js/main.js"></script>
        </div>
        <?php
        include_once("rodape.php");
        ?>
    </body>
</html>
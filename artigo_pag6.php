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
                            window.location.href = "artigo_pag7.php";
                        } else if (final.toLowerCase() == "página anterior" || final.toLowerCase() == "anterior" || final.toLowerCase() == "voltar") {
                            window.location.href = "artigo_pag5.php";
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

            <h5 style="margin-top: 75px;">RESULTADOS</h5>

            <div class="border-top-bottom">
                <p>A prevalência de deficiência visual, ajustada por idade e sexo, foi menor entre as pessoas cujo chefe de família apresentava escolaridade de 4 a 7 anos e de 12 anos ou mais, já a deficiência auditiva mostrou-se menos prevalente no grupo cujo chefe de família apresentava escolaridade inferior a 4 anos. Não houve associação da escolaridade do chefe da família com deficiência física.</p>
                <p>As causas atribuídas para as deficiências variaram de acordo com a natureza do problema e com o sexo do entrevistado (Tabela 3). A principal causa atribuída de deficiência visual, em ambos os sexos, foi doença: 26,8% para os homens e 32,1% para as mulheres. A principal causa da deficiência auditiva foi o grupo das causas externas: 40,2% entre os homens e, entre as mulheres, 23,9%. A principal causa das deficiências físicas foram as doenças no sexo feminino (57,2%); e entre os homens predominaram as causas externas em 46,5% (p < 0,05). O envelhecimento, freqüentemente associado a estados incapacitantes 16,17,18, foi citado como causa das deficiências pelos entrevistados, uma vez que não era objeto deste estudo a confirmação clínica e sim a percepção de causa, sempre auto-referida.</p>
                <p>Quanto às limitações provocadas pelas deficiências, 33,9% (intervalo de 95% de confiança - IC95%: 27,0-1,5) dos deficientes visuais alegaram que a deficiência prejudicou as suas atividades no trabalho. Essa porcentagem foi de 24,5% (IC95%: 17,0-4,0) entre os deficientes auditivos e de 62% (IC95%: 41,0-79,3) entre os deficientes físicos (dados não apresentados em tabela).</p>
            </div>

            <a href="artigo_pag5.php" style="float: left">Página anterior</a>
            <a href="artigo_pag7.php" style="float: right">Próxima página</a>



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
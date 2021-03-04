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
                            window.location.href = "artigo_pag9.php";
                        } else if (final.toLowerCase() == "página anterior" || final.toLowerCase() == "anterior" || final.toLowerCase() == "voltar") {
                            window.location.href = "artigo_pag7.php";
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
        <div >
            <div class="container">

                <?php
                include_once './navbar.php';
                ?>
                <!--<h3 style="margin-top: 75px;">Deficiência visual, auditiva e física: prevalência e fatores associados em estudo de base populacional</h3>-->

                <h5 style="margin-top: 75px;">DISCUSSÃO</h5>
                <div class="border-top-bottom">
                    <p>As prevalências de deficiências visuais relatadas por diversos estudos com metodologias parecidas variam de 3 a mais de 300 em estudos internacionais 31,32,33,34 e de 7 a 382 em estudos brasileiros 14,35. Observando-se a RP entre os sexos, expressa-se a maior prevalência entre as mulheres do que nos homens. Picavet & Hoeymans 31 e Qiu 36 também encontraram maiores prevalências para as mulheres nesse tipo de deficiência. Quando se analisam as prevalências de deficiência visual segundo o nível de escolaridade do chefe da família, percebe-se maior prevalência no menor nível de escolaridade, o que coincide com dados de outro estudo 31. Esses dados endossam o que alguns estudos apontam: a prevalência de deficiências tem relação com fatores sociais nas coletividades 14,24,25.</p>
                    <p>Em relação à prevalência de deficiência auditiva, observa-se aumento com a idade. Na dificuldade auditiva, surdez unilateral e bilateral percebeu-se que os indivíduos do sexo masculino apresentaram as maiores prevalências quando comparados às mulheres em todas as faixas etárias, resultados semelhantes aos descritos na literatura 31,37.</p>
                    <p>Segundo um relatório divulgado pela Coordenadoria Nacional para Integração da Pessoa Portadora de Deficiência (CORDE) & Associação Fluminense de Reabilitação 14, os valores das prevalências de deficiência auditiva de algumas cidades brasileiras variam de 2 em Taguatinga (Distrito Federal, Brasil) a 30 em Porto Velho (Rondônia, Brasil). Em estudos internacionais são relatadas prevalências variáveis de 16 a 166 25,31,37. A distribuição da prevalência de deficiência auditiva segundo idade mostra que as maiores prevalências acontecem em grupos de idade avançada. Wilson et al. 38, Picavet & Hoeymans 31 e Cruickshanks et al. 39 também detectaram esse fato em seus estudos. Ao observar as razões de prevalências, revela-se que os indivíduos entre 20 a 39 anos; os com idade entre 40 e 59 anos e com 60 anos e mais têm mais deficiência auditiva quando comparados aos indivíduos com idade menor que 12 anos.</p>
                    <p>Conforme já citado, a prevalência de deficiência auditiva é maior no sexo masculino, corroborando Wilson et al. 38, Picavet & Hoeymans 31 e Cruickshanks et al. 39. Essa observação pode ser explicada por fatores ligados às categorias profissionais ou maior exposição a fatores de risco.</p>



                </div>

                <a href="artigo_pag7.php" style="float: left">Página anterior</a>
                <a href="artigo_pag9.php" style="float: right">Próxima página</a>



                <!-- /container -->        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
                <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.11.2.min.js"><\/script>')</script>

                <script src="js/bootstrap.min.js"></script>
                <script src="js/main.js"></script>
            </div>
            <?php
            include_once './rodape.php';
            ?>
        </div>
    </body>
</html>
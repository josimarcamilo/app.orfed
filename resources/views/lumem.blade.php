<!DOCTYPE html>
<html>
    <head>
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

        <!-- Compiled and minified CSS -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    </head>

    <body>
        <div style="width:95%; margin:auto;" class="">
            <div class="row">
                <div class="col s12 m12 l4">
                    <img class="materialboxed" height="100%" width="100%" src="https://lumemhair.com/wp-content/uploads/2023/06/Kit-3-frascos.png">
                </div>
                <div class="col s12 m12 l5">
                    <h4>Anaphase +, Shampoo Antiqueda, Ducray</h4>
                    <p>Mais de 50 compras no mês passado</p>
                    <div class="divider"></div>
                    <p class="flow-text">R$92,99</p>
                    <span>Em até 2x R$ 64,50 sem juros</span>
                    <p>Escolha uma opção abaixo:</p>
                    <p>
                        <label>
                            <input class="with-gap" name="opcao-escolhida" type="radio" value="opcao01" checked />
                            <span>1 frasco por 197,00 cada</span>
                        </label>
                    </p>
                    <p>
                        <label>
                            <input class="with-gap" name="opcao-escolhida" type="radio" value="opcao02" />
                            <span>3 frascos por 99,00 cada</span>
                        </label>
                    </p>
                    <table>
                        {{-- <thead>
                        <tr>
                            <th>Name</th>
                            <th>Item Name</th>
                            <th>Item Price</th>
                        </tr>
                        </thead> --}}

                        <tbody>
                            <tr>
                                <td>Marca</td>
                                <td>Lumem hair</td>
                            </tr>
                            <tr>
                                <td>Forma do produto</td>
                                <td>Cápsulas</td>
                            </tr>
                            <tr>
                                <td>Tipo de cabelo</td>
                                <td>Todos os tipos de cabelos</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col s12 m12 l3">
                    <p class="flow-text">R$92,99</p>
                    <p>Entrega GRÁTIS</p>
                    <p class="green-text">Em estoque</p>
                    <a style="width=100%;width: 100%;" class="waves-effect waves-light btn orange darken-1 black-text hoverable">Comprar agora</a>
                    <p>Devolução: Elegível para Devolução, Reembolso em até 90 dias após a compra</p>
                    <p>Enviado pelos Correios</p>
                    <p>Sua compra é segura: Utilizamos a plataforma mais segura do Brasil. Não salvamos os dados do seu cartão de crédito</p>
                </div>
            </div>
            <div>
                <div class="row">
                    <div class="col s12 m12 l4">
                        <h5>Descrição</h5>
                        <p>O shampoo anaphase + fortalecedor antiqueda é um shampoo dermocapilar com resultados comprovados na diminuição da queda capilar, crescimento dos fio e fortalecimento da haste. Com combinação exclusiva de ativos: Ruscus, Monolaurina, Biotina, Vitamina B6, D-Panthenol, atua direto no couro cabeludo aumentando a vasodilatação e área de penetração dos ativos, potencializando sua eficácia. O Anaphase + shampoo pode ser usado em monoterapia diminuindo 88% da queda¹ ou em terapia combinada com outros tratamentos, aumentando em até 6x a absorção do Minoxidil 5%². Desenvolvido na França. Testado e aprovado pelos dermatologistas. ¹Análise subjetiva de satisfação das voluntárias em uso regular de tratamento antiqueda e posterior associação de Anaphase+ Shampoo 3 vezes na semana por 3 semanas. ²Avaliação da ecácia de Anaphase+ shampoo como pré tratamento a aplicação de Minoxidil 5% H3 em explantes de couro cabeludo de voluntários portadores de AGA.</p>
                    </div>
                    <div class="col s12 m12 l4">
                        <h5>Este produto é para você que:</h5>
                        <p>Está com o cabelo caindo</p>
                        <p>Seu cabelo não cresce</p>
                        <p>Está com o cabelo caindo pós COVID</p>
                    </div>
                    <div class="col s12 m12 l4">
                        <h5>Modo de uso</h5>
                        <p>Ingerir duas cápsulas por dia durante o tratamento.</p>
                    </div>
                </div>
            </div>

        </div>
        <footer style="padding-top: 10px;" class="blue-grey lighten-5">
            <div class="center-align">
                <h5 class="">Ficou alguma dúvida?</h5>
                <a style="" class="flow-text waves-effect waves-light btn green darken-1 black-text hoverable">Falar com um atendente</a>
            </div>
            <div class="center-align">
                <p class="">
                    © 2024 JC Desenvolvimento de sistemas LTDA. | CNPJ 15.436.940/0001-03
                    {{-- <a class="grey-text text-lighten-4 right" href="#!">More Links</a> --}}
                </p>
                <p>
                    Formas de pagamento aceitas: cartões de crédito (Visa, MasterCard, Elo e American Express), Boleto e Pix.
                </p>
            </div>
        </footer>
        <!-- Compiled and minified JavaScript -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
        <script>
            const opcoes = {
                "opcao01": {
                    "preco": 197.00,
                    "parcelamento": "Em até 12x R$ 20,27",
                    "checkout": ""
                },
                "opcao02": {
                    "preco": 297.00,
                    "parcelamento": "Em até 12x R$ 30,55",
                    "checkout": ""
                }
            };
            document.addEventListener('DOMContentLoaded', function() {
                var elems = document.querySelectorAll('.materialboxed');
                var instances = M.Materialbox.init(elems);

                document.querySelectorAll("input[name='opcao-escolhida']")
                    .forEach(function (elemento){
                        elemento.addEventListener(
                            'change', function(event){
                                console.log('mudou', event.target.value, opcoes);
                            })
                    });

            });        
        </script>
    </body>
</html>
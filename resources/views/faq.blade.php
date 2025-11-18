@extends('layouts.app')

@section('content')
<div class="container my-5">
    <h1 class="text-center mb-5">Perguntas Frequentes</h1>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="accordion" id="faqAccordion">
                
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                            Como funciona o processo de adoção?
                        </button>
                    </h2>
                    <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>O processo de adoção na SAAU é simples e transparente:</p>
                            <ol>
                                <li>Navegue pelos animais disponíveis em nosso site</li>
                                <li>Escolha o animal que mais combina com você</li>
                                <li>Preencha o formulário de adoção com seus dados</li>
                                <li>Nossa equipe entrará em contato para uma entrevista</li>
                                <li>Realizamos uma visita ao local onde o animal viverá</li>
                                <li>Aprovado o pedido, você pode buscar seu novo amigo!</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                            Quais são os requisitos para adotar?
                        </button>
                    </h2>
                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>Para adotar um animal da SAAU, você precisa:</p>
                            <ul>
                                <li>Ser maior de 18 anos</li>
                                <li>Apresentar documento de identidade</li>
                                <li>Ter residência fixa</li>
                                <li>Ter condições de cuidar do animal</li>
                                <li>Concordar com visitas de acompanhamento</li>
                                <li>Assinar termo de responsabilidade</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                            A adoção tem algum custo?
                        </button>
                    </h2>
                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                        <div class="accordion-body">
                            <p>A adoção é <strong>gratuita</strong>! Todos os animais são entregues vacinados, vermifugados e castrados.</p>
                            <p>Solicitamos uma contribuição voluntária para ajudar nos custos veterinários.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection

@section('title', __("Make the payment") )

<x-frontend-layout>
    <section class="light-gray-bg py-4 clearfix">
        <div class="container">
            @include('frontend.the_project.shop.includes.alerts')

            <div class="row">
                <div class="col-lg-7">
{{--                    <fieldset>--}}
                    <div class="card border-0 bg-white py-4 px-5">
                        <div class="card-body p-0">
                            <h3 class="font-weight-bold">Informações de cobrança</h3>
                            <form action="{{ route('shop.checkout.store') }}" method="POST" id="payment-form" class="mb-0">
                                @csrf

                                <div class="form-group">
                                    <label for="email">E-mail<small class="text-default">*</small></label>
                                    @if (auth()->user())
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ auth()->user()->email }}" readonly>
                                    @else
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{ old('email') }}" required>
                                    @endif
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="name">Nome<small class="text-default">*</small></label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{ old('name') }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="phone">Telefone<small class="text-default">*</small></label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{ old('phone') }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="cep">CEP<small class="text-default">*</small></label>
                                        <input type="text" class="form-control" id="postalcode" name="postalcode"
                                               value="{{ old('postalcode') }}" required>
                                    </div>

                                    <div class="form-group col-lg-6">
                                        <label for="state">Estado<small class="text-default">*</small></label>
                                        <input type="text" class="form-control" id="province" name="province"
                                               value="{{ old('province') }}" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="address">Endereço<small class="text-default">*</small></label>
                                    <input type="text" class="form-control" id="address" name="address"
                                           value="{{ old('address') }}" required>
                                </div>
                                <div class="row">
                                    <div class="form-group col-lg-6">
                                        <label for="city">Cidade<small class="text-default">*</small></label>
                                        <input type="text" class="form-control" id="city" name="city"
                                               value="{{ old('city') }}" required>
                                    </div>
                                    <div class="form-group col-lg-6">
                                        <label for="complement">Complemento</label>
                                        <input type="text" class="form-control" id="complement" name="complement"
                                               value="{{ old('complement') }}" required>
                                    </div>
                                </div>

                                <div class="space-bottom"></div>

                                <h3 class="font-weight-bold">Informações de pagamento</h3>

                                <div class="form-group mb-3">
                                    <label for="name_on_card">Nome no cartão<small class="text-default">*</small></label>
                                    <input type="text" class="form-control" id="name_on_card" name="name_on_card" value="">
                                </div>
                                <div class="form-group">
                                    <label for="card-element">Cartão de crédito ou débito</label>
                                    <div id="card-element" class="form-control" aria-describedby="cardHelp"></div>
                                    <div id="card-errors" role="alert"></div>

                                    @if(App::environment('local'))
                                        <small id="cardHelp" class="form-text text-muted">
                                            Cartão sucesso: 4242424242424242
                                        </small>
                                        <small id="cardHelp" class="form-text text-muted">
                                            Cartão erro: 4000000000000069
                                        </small>
                                    @endif
                                </div>


                                <button id="complete-order" name="complete-order"
                                        class="btn btn-group btn-default btn-animated"
                                        type="submit">
                                    Finalizar Compra<i class="fas fa-check"></i>
                                </button>
                            </form>
                        </div>
                    </div>
{{--                    </fieldset>--}}
                </div>
                <div class="col-lg-5">
{{--                    <fieldset>--}}
                    <div class="card border-0 bg-white py-4 px-5">
                        <div class="card-body p-0">
                            <h3 class="font-weight-bold">Seu pedido</h3>
                            <div class="separator-2"></div>

                            <div class="row">
                                <div class="col-lg-12">
                                    @foreach(Cart::instance('default')->content() as $item)
                                        <div class="row">
                                            <div class="col">
                                                <div class="d-flex pr-2">
                                                    <div class="overlay-container">
                                                        <img src="{{ $item->model->imageUrl() }}" class="media-object"
                                                             alt="{{ $item->model->name }}">
                                                        <a class="overlay-link small"
                                                           href="{{ route('shop.products.show', $item->model->slug) }}">
                                                            <i class="fa fa-link"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <h6 class="media-heading">
                                                    <a href="{{ route('shop.products.show', $item->model->slug) }}">{{ $item->model->name }}</a>
                                                </h6>
                                                <p class="price">{{ $item->model->details }}</p>
                                                <p class="font-weight-bold text-dark">{{ presentPrice($item->qty * $item->model->price) }}</p>
                                            </div>
                                            <div class="col d-flex align-items-center">
                                                <input class="form-control" type="text" value="{{ $item->qty }}" readonly>
                                            </div>
                                        </div>
                                        <div class="separator-2 mt-2"></div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col">
                                            <p class="price">Subtotal</p>
                                        </div>
                                        <div class="col">
                                            <p class="price text-right">
                                                R${{ Cart::instance('default')->subtotal() }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            @if(session()->has('coupon'))

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-auto">
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <span class="price text-success mr-1">
                                                        Desconto
                                                    </span>
                                                    <div class="ml-auto">
                                                        <form action="{{ route('shop.coupon.destroy', 1) }}" method="POST"
                                                              class="margin-clear">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                    class="btn btn-sm btn-default-transparent">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col d-flex align-items-center justify-content-end">
                                                <span class="text-success">
                                                    - {{ presentPrice($discount) }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="separator-2 mt-2"></div>

                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col">
                                                <p class="price">Novo Subtotal</p>
                                            </div>
                                            <div class="col">
                                                <p class="price text-right">
                                                    {{ presentPrice($newSubtotal) }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col">
                                            <p class="price">Taxa ({{ config('cart.tax') }}%)</p>
                                        </div>
                                        <div class="col">
                                            <p class="price text-right">
                                                {{ presentPrice($newTax) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col">
                                            <p class="price font-weight-bold text-dark">
                                                Total {{ Cart::instance('default')->count() }} Itens
                                            </p>
                                        </div>
                                        <div class="col">
                                            <p class="price font-weight-bold text-dark text-right">
                                                {{ presentPrice($newTotal) }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
{{--                    </fieldset>--}}
                </div>
            </div>
        </div>
    </section>

    @push('styles')
        <style>
            .StripeElement--focus {
                color: #495057;
                background-color: #fff;
                border-color: #80bdff;
                outline: 0;
            }

            .StripeElement--invalid {
                border-color: #fa755a;
            }

            .StripeElement--webkit-autofill {
                background-color: #fefde5 !important;
            }

            #card-errors {
                color: #fa755a;
            }

            .disabled {
                cursor: not-allowed;
            }
        </style>
    @endpush

    @push('scripts')
        <script src="https://js.stripe.com/v3/"></script>

        <script>
            // Cria um cliente Stripe
            const stripe = Stripe("{{ config('cashier.key') }}");

            // Cria uma instância de Elements
            const elements = stripe.elements();

            // O estilo personalizado pode ser passado para opções ao criar um elemento.
            // (Observe que esta demonstração usa um conjunto mais amplo de estilos do que o guia abaixo.)
            const style = {
                base: {
                    color: '#777777',
                    fontWeight: 300,
                    lineHeight: '25px',
                    fontFamily: 'Roboto, "Helvetica Neue", Helvetica, sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '14px',
                    '::placeholder': {
                        color: '#aab7c4'
                    },
                    iconColor: '#666EE8',
                },
                invalid: {
                    color: '#fa755a',
                    iconColor: '#fa755a'
                }
            };

            const card = elements.create('card', {
                style: style,
                hidePostalCode: true
            });

            // Adiciona uma instância do elemento card no `card-element` <div>
            card.mount('#card-element');

            // Lida com erros de validação em tempo real do elemento do cartão.
            card.addEventListener('change', function (e) {
                const displayError = document.getElementById('card-errors');
                if (e.error) {
                    displayError.textContent = e.error.message;
                } else {
                    displayError.textContent = '';
                }
            });

            const form = document.getElementById('payment-form');
            const cardButton = document.getElementById('complete-order');

            form.addEventListener('submit', function (e) {
                e.preventDefault()

                // Desabilite o botão enviar para evitar cliques repetidos
                cardButton.disabled = true;
                cardButton.classList.add('disabled')

                const options = {
                    name: document.getElementById('name_on_card').value,
                    address_line1: document.getElementById('address').value,
                    address_city: document.getElementById('city').value,
                    address_state: document.getElementById('province').value,
                    address_zip: document.getElementById('postalcode').value
                };

                stripe.createToken(card, options).then(function (result) {
                    if (result.error) {
                        // Informa o usuário se houve um erro
                        var errorElement = document.getElementById('card-errors');
                        errorElement.textContent = result.error.message;
                        // Ativa o botão enviar
                        cardButton.disabled = false;
                        cardButton.classList.remove('disabled');
                    } else {
                        //Envia o token para o seu servidor
                        stripeTokenHandler(result.token);
                    }
                });
            });

            function stripeTokenHandler(token) {
                // Insira o ID do token no formulário para que ele seja enviado ao servidor
                const form = document.getElementById('payment-form');
                const hiddenInput = document.createElement('input');
                hiddenInput.setAttribute('type', 'hidden');
                hiddenInput.setAttribute('name', 'stripeToken');
                hiddenInput.setAttribute('value', token.id);
                form.appendChild(hiddenInput);

                // Envia o formulário
                form.submit();
            }
        </script>
    @endpush
</x-frontend-layout>

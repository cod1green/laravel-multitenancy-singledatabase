@section('title', __('Point of Sale'))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('Point of Sale') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('salesPDV') }}
            </div>
        </div>
    </x-slot>

    <div class="row" id="app">
        <div class="col-md-12">
            #sale
        </div>
    </div>

    <!-- Modal Products -->
{{-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Adicionar produto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <ul class="products-list product-list-in-card pl-2 pr-2">
                    <li class="item">
                        <div class="product-img m-2">
                            <img src="/imgs/hamburger.jpeg" alt='' style="width: 150px; height: 150px">
                        </div>
                        <div class="product-info">
                            <a href="#" class="product-title">
                                Hamburger Gourmet
                                <span class="badge badge-light float-right">
                                    R$ 15,99
                                </span>
                            </a>
                            <span class="product-description" style="white-space: normal">
                                Pão, carne de hamburger, salada e batata palha
                            </span>
                        </div>

                        <div class="row">
                            <label class="col-md-6">Quantidade</label>
                            <div class="input-group text-center col-md-6">
                                <div class="input-group-append">
                                    <span class="input-group-text"> - </span>
                                </div>
                                <input type="number" min="1" max="99" value="1" class="form-control">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> + </span>
                                </div>
                            </div>

                            <label class="col-md-6">Desconto</label>
                            <div class="input-group text-center col">
                                <div class="input-group-append">
                                    <span class="input-group-text"> R$ </span>
                                </div>
                                <input type="text" value="0,00" class="form-control">
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary">
                    Adicionar ao pedido
                </button>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal Client -->
{{-- <div class="modal fade" id="staticBackdropClient" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropClientLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropClientLabel">Adicionar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <input type="name" class="form-control" placeholder="Nome do cliente">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="phone" class="form-control" placeholder="Telefone do cliente">
                        </div>
                        <div class="form-group col-md-6">
                            <input type="email" class="form-control" placeholder="E-mail do cliente">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="nome da rua, numero">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input type="text" class="form-control" placeholder="Bairro">
                        </div>
                        <div class="form-group col-md-4">
                            <input type="text" class="form-control" placeholder="Código postal">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Complemento: Ponto de referencia, etc">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-8">
                            <input type="text" value="Feira de Santana" class="form-control" placeholder="Cidade">
                        </div>
                        <div class="form-group col-md-4">
                            <select class="form-control" aria-placeholder="Estado">
                                <option selected>Bahia</option>
                            </select>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Cancelar
                </button>
                <button type="button" class="btn btn-primary">
                    Salvar
                </button>
            </div>
        </div>
    </div>
</div> --}}

<!-- Modal Sale -->
    {{-- <div class="modal fade" id="staticBackdropSale" data-backdrop="static" data-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropSaleLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropSaleLabel">Finalizar venda</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6 border-right-light">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Pagamento</strong>
                                </div>
                                <div class="card-body">
                                    <div class="input-group col-md-12 mb-3">
                                        <select name="form_payment" class="col-md-12 custom-select input-group-prepend">
                                            <option selected>Forma de pagamento</option>
                                            <option value="in_cash">À vista</option>
                                            <option value="debit_card">Cartão de Débito</option>
                                            <option value="credit_card">Cartão de Crédito</option>
                                            <option value="food_card">Cartão Alimentação</option>
                                            <option value="pay_later">Fiado</option>
                                            <option value="free">Grátis</option>
                                        </select>

                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Desconto</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Percentagem</a>
                                                    <a class="dropdown-item" href="#">Valor</a>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"
                                                aria-label="Text input with dropdown button">
                                            <div class="input-group-append">
                                                <span class="input-group-text"> R$ </span>
                                            </div>
                                        </div>

                                        <div class="input-group mt-3">
                                            <div class="input-group-prepend">
                                                <button class="btn btn-outline-secondary dropdown-toggle" type="button"
                                                    data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">Entrega</button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item" href="#">Percentagem</a>
                                                    <a class="dropdown-item" href="#">Valor</a>
                                                </div>
                                            </div>
                                            <input type="text" class="form-control"
                                                aria-label="Text input with dropdown button">
                                            <div class="input-group-append">
                                                <span class="input-group-text"> R$ </span>
                                            </div>
                                        </div>

                                        <div class="input-group col-12 mt-md-3">
                                            <label class="col-4">TOTAL PAGO</label>
                                            <div class="input-group-append">
                                                <span class="input-group-text"> R$ </span>
                                            </div>
                                            <input type="text" value="0,00" class="form-control col-8 input-group-append">
                                            <div class="input-group-append">
                                                <button class="btn btn-success">Confirmar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header">
                                            <strong>Itens do pedido</strong>
                                        </div>
                                        <div style="height: 200px;" class="card-body table-responsive">
                                            <table
                                                class="table table-condensed table-striped table-hover table-borderless align-middle table-head-fixed">
                                                <thead>
                                                    <tr>
                                                        <th>Produtos</th>
                                                        <th>Preço</th>
                                                        <th>Quantidade</th>
                                                        <th>Subtotal</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr data-toggle="modal" data-target="#staticBackdrop">
                                                        <td>Hamburger Gourmet</td>
                                                        <td>R$ 15,99</td>
                                                        <td>2</td>
                                                        <td>R$ 31,98</td>
                                                    </tr>
                                                    <tr data-toggle="modal" data-target="#staticBackdrop">
                                                        <td>Coca-cola 1L</td>
                                                        <td>R$ 8,00</td>
                                                        <td>1</td>
                                                        <td>R$ 8,00</td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <strong>Cliente</strong>
                                </div>
                                <div class="card-body row">
                                    <address>
                                        <strong>Maria Amaro</strong><br>
                                        Rua das Flores, 600<br>
                                        San Francisco, CEP 44099-6635<br>
                                        Celular: (75) 99539-1037<br>
                                        E-mail: mariamo@example.com
                                      </address>
                                </div>
                            </div>

                            <div class="col-12 float-right">
                                <p class="lead">Resumo</p>

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td><span class="float-right">R$ 36,00</span></td>
                                        </tr>
                                        <tr>
                                            <th>Taxa (10%)</th>
                                            <td><span class="float-right">R$ 3,60</span></td>
                                        </tr>
                                        <tr>
                                            <th>Entrega:</th>
                                            <td><span class="float-right">R$ 0,00</span></td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td><span class="float-right">R$ 39,60</span></td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <div class="row justify-content-center">
                                <button type="button" class="col-md-3 btn btn-secondary mr-1" data-dismiss="modal">
                                    <i class="fas fa-ban"></i> Cancelar
                                </button>
                                <button type="button" class="col-md-8 btn btn-success btn-block float-right">
                                    <i class="far fa-credit-card"></i> Finalizar Venda
                                </button>
                            </div>

                        </div>
                    </div>
                </div>
             </div>
        </div>
    </div> --}}
</x-app-layout>

@component('mail::message')
# Pedido Recebido

Obrigado pelo seu pedido.

**Pedido:** {{ $order->uuid }} <br>
**E-mail de cobrança:** {{ $order->billing_email }}<br>
**Nome de cobrança:** {{ $order->billing_name }}<br>
**Total Pedido:** {{ presentPrice($order->billing_total) }}<br>

**Itens do pedido**

@foreach($order->products as $product)
Nome: {{ $product->name }} <br>
Preço: {{ presentPrice($product->pivot->price) }} <br>
Quantidade: {{ $product->pivot->quantity }} <br><br>
@endforeach
Você pode obter mais detalhes sobre seu pedido acessando nosso site.

@component('mail::button', ['url' => route('tenant:shop.home')])
    Ir para o site
@endcomponent

Obrigado,<br>
{{ config('app.name') }}
@endcomponent

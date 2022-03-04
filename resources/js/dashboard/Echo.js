import Vue from 'vue'
import Bus from './bus'

const tenantId = window.Laravel.tenantId;

window.Echo.channel(`laravel_jetlte_database_private-order-created.${tenantId}`)
.listen('OrderCreated', (e) => {
    Bus.$emit('order.created', e.order)
    Vue.$vToastify.success(`Novo pedido ${e.order.identify}`, 'Novo Pedido')
});

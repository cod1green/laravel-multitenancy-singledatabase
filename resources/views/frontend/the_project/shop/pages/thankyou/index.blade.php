<x-frontend-layout>
    <!-- section class start -->
    <!-- ================ -->
    <section id="class" class="light-gray-bg pv-30 clearfix">
        <div class="container">

            @include('frontend.the_project.shop.includes.alerts')

            <div class="row justify-content-md-center">
                <div class="col-lg-8">
                    <h2 class="text-center mt-4">Obrigado pelo seu pedido!</h2>
                    <div class="separator"></div>
                    <p class="large text-center">Um e-mail de confirmação foi enviado</p>


                    <div class="d-flex justify-content-center">
                        <a class="btn btn-group btn-default btn-animated"
                           href="{{ route('shop.products.index') }}">
                            Ir para Loja<i class="fas fa-store"></i>
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- section class end -->
</x-frontend-layout>

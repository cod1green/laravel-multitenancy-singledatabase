@section('title', 'Lista de Produtos')

<x-frontend-layout>
    <!-- section class start -->
    <!-- ================ -->
    <section class="light-gray-bg pv-30 clearfix">
        <div class="container">

            @include('frontend.the_project.shop.includes.alerts')

            <div class="row">
                @include('frontend.the_project.shop.pages.products._partials.aside')
                @include('frontend.the_project.shop.pages.products._partials.content')
            </div>
        </div>
    </section>
    <!-- section class end -->
</x-frontend-layout>

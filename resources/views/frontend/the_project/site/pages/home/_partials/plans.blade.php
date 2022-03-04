<!-- section start -->
<!-- ================ -->
<section id="plans" class="clearfix space-top">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <!-- page-title start -->
                <!-- ================ -->
                <h1 class="page-title text-center"><strong>Planos</strong></h1>
                <div class="separator"></div>
                <br>
                <!-- page-title end -->

                <!-- pricing tables start -->
                <!-- ================ -->
                <div class="pricing-tables hc-element-invisible" data-animation-effect="fadeInUpSmall"
                     data-effect-delay="0">
                    <div class="row justify-content-md-center">
                        @foreach ($plans as $plan)
                            <div class="col-md-3 plan {{ $plan->recommended ? 'best-value' : '' }}">
                                <div class="header {{ $plan->recommended ? 'default-bg' : 'dark-bg' }}">
                                    <h3>{{ $plan->name }}</h3>
                                    <div class="price"><span>R$ {{$plan->price_br}}</span> / {{__($plan->period)}}</div>
                                </div>
                                <ul class="hc-shadow light-gray-bg bordered">
                                    @foreach ($plan->details as $detail)
                                        <li>{{ $detail->name }}</li>
                                    @endforeach
                                    {{-- <li>--}}
                                    {{-- <a href="#" class="pt-popover" data-toggle="popover" data-placement="right"--}}
                                    {{-- data-content="Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum."--}}
                                    {{-- title="" data-original-title="Pricing table item">Pricing table item</a>--}}
                                    {{-- </li>--}}
                                    <li>
                                        <a
                                            href="{{ route('plan.subscription', $plan->url) }}"
                                            class="btn {{ $plan->recommended ? 'btn-default' : 'btn-dark' }} btn-animated btn-lg">
                                            Assinar <i class="fa fa-shopping-cart"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- pricing tables end -->

            </div>
        </div>
    </div>
</section>
<!-- section end -->

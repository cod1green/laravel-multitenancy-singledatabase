<!-- footer top end -->
<!-- footer start (Add "dark" class to #footer in order to enable dark footer) -->
<!-- ================ -->
<footer id="footer" class="clearfix dark">

    <!-- .footer start -->
    <!-- ================ -->
    <div class="footer pb-0">
        <div class="container">
            <div class="footer-inner">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="footer-content pt-0">
                            <div class="logo-footer d-flex justify-content-lg-center">
                                <img id="logo-footer" width="100"
                                     src="{{ asset('frontend/the_project/img/cod1green/logo_full_300x300.png')  }}"
                                     alt="">
                            </div>
                            <p>Atuamos na área de tecnologia e inovação com consultoria estratégica e desenvolvimento de
                                soluções personalizadas para empresas de todos os segmentos. Desenvolvemos aplicativos,
                                softwares e outras soluções sob medida para impulsionar o seu negócio, damos todo o
                                suporte e consultoria necessária para tirar
                                a sua ideia do papel e transformar em realidade.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="footer-content pt-0">
                            <h2 class="title">Siga nossas redes sociais e fique ligado em todas as novidades!</h2>
                            <div class="separator-2"></div>
                            <p>Você já conhece e segue nossas redes sociais? Seja no Instagram ou no Facebook não
                                perca tempo e fique por dentro de tudo que acontece dentro e fora do mundo da
                                Tecnologia, alem de dicas de desenvolvimento de software, eventos, etc.
                            <p>
                            <ul class="social-links circle animated-effect-1">
                                <li class="flickr">
                                    <a href="#">
                                        <i class="fab fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="facebook">
                                    <a href="#">
                                        <i class="fab fa-facebook"></i>
                                    </a>
                                </li>
                                <li class="xing">
                                    <a href="https://api.whatsapp.com/send?phone=5511948809185&text=Ol%C3%A1%2C%20quero%20fazer%20um%20or%C3%A7amento!"
                                       target="_blank"><i class="fab fa-whatsapp"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="clearfix hidden-sm-up"></div>
                    <div class="col-lg-4 col-xl-4 ml-xl-auto">
                        <div class="footer-content pt-0">
                            <h2 class="title">Contato</h2>
                            <contact-component></contact-component>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .footer end -->

    <!-- .subfooter start -->
    <!-- ================ -->
    <div class="subfooter default-bg">
        <div class="container">
            <div class="subfooter-inner">
                <div class="row">
                    <div class="col-md-12">
                        <p class="text-center">© {{ date('Y') }} Cod1green Tecnologia da Informação Ltda • Todos os
                            direitos reservados.</p>
                        <div class="text-center text-sm">
                            Produzido por <a href="https://cod1green.com" target="_blank"><b>Cod1green</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .subfooter end -->

    <!-- .whatsapp button start -->
    <!-- ================ -->
    <a href="https://api.whatsapp.com/send?phone=5511948809185&text=Ol%C3%A1%2C%20quero%20fazer%20um%20or%C3%A7amento!"
       class="footer-whatsapp" target="_blank">
        <svg enable-background="new 0 0 512 512" version="1.1" viewBox="0 0 512 512"
             xml:space="preserve" xmlns="http://www.w3.org/2000/svg"><path
                d="M256.064,0h-0.128l0,0C114.784,0,0,114.816,0,256c0,56,18.048,107.904,48.736,150.048l-31.904,95.104  l98.4-31.456C155.712,496.512,204,512,256.064,512C397.216,512,512,397.152,512,256S397.216,0,256.064,0z"
                fill="#4CAF50"/>
            <path
                d="m405.02 361.5c-6.176 17.44-30.688 31.904-50.24 36.128-13.376 2.848-30.848 5.12-89.664-19.264-75.232-31.168-123.68-107.62-127.46-112.58-3.616-4.96-30.4-40.48-30.4-77.216s18.656-54.624 26.176-62.304c6.176-6.304 16.384-9.184 26.176-9.184 3.168 0 6.016 0.16 8.576 0.288 7.52 0.32 11.296 0.768 16.256 12.64 6.176 14.88 21.216 51.616 23.008 55.392 1.824 3.776 3.648 8.896 1.088 13.856-2.4 5.12-4.512 7.392-8.288 11.744s-7.36 7.68-11.136 12.352c-3.456 4.064-7.36 8.416-3.008 15.936 4.352 7.36 19.392 31.904 41.536 51.616 28.576 25.44 51.744 33.568 60.032 37.024 6.176 2.56 13.536 1.952 18.048-2.848 5.728-6.176 12.8-16.416 20-26.496 5.12-7.232 11.584-8.128 18.368-5.568 6.912 2.4 43.488 20.48 51.008 24.224 7.52 3.776 12.48 5.568 14.304 8.736 1.792 3.168 1.792 18.048-4.384 35.52z"
                fill="#FAFAFA"/>
            </svg>
    </a>
    <!-- .whatsapp button end -->

</footer>
<!-- footer end -->

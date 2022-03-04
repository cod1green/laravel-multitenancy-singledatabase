<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    {{ $header }}
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    {{ $slot }}
                </div>

                @if (isset($aside))
                    <div class="col-lg-3">
                        {{ $aside }}
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- /.content -->
</div>

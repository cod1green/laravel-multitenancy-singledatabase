@section('title', __("My Invoices"))

<x-app-layout>
    <x-slot name="header">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="h4 font-weight-bold">
                    {{ __('My Invoices') }}
                </h2>
            </div>
            <div class="col-sm-6">
                {{ Breadcrumbs::render('usersInvoices') }}
            </div>
        </div>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card shadow bg-light">
                @include('admin.includes.alerts')

                <div class="div card-header">
                    @include('admin.includes.search', [
                        'route' => null,
                        'add' => null
                    ])

                    @if($subscription)
                        <h5 class="badge badge-light float-lg-right">
                            {{ __("You are signing") }}
                            : {{ $user->plan()->name }}
                        </h5>

                        @if($subscription->cancelled() && $subscription->onGracePeriod())
                            <a href="{{ route('subscriptions.resume') }}" class="btn btn-outline-info">
                                {{ __("Reactivate Subscription") }}
                            </a>
                            <span class="ml-2"> {{ __("Your access goes to") }}: {{ $user->access_end }}</span>
                        @elseif(!$subscription->cancelled())
                            <a href="{{ route('subscriptions.cancel') }}" class="btn btn-outline-danger">
                                {{ __("Unsubscribe") }}
                            </a>
                        @endif

                        @if ($subscription->ended())
                            {{ __("He finished") }}
                        @endif
                    @else
                        [{{ __("Non-subscriber") }}]
                    @endif
                </div>

                <div class="div card-body table-responsive">
                    <table class="table table-condensed table-striped table-hover table-borderless align-middle">
                        <thead>
                        <tr>
                            <th>{{ __("Date") }}</th>
                            <th>{{ __("Value") }}</th>
                            <th>{{ __("Actions") }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($invoices as $invoice)
                            <tr>
                                <td>{{ $invoice->date()->toFormattedDateString() }}</td>
                                <td>{{ $invoice->total() }}</td>
                                <td>
                                    @each('admin.includes.forms_actions', [
                                        'items' => [
                                            'route' => route('subscriptions.invoice.download', $invoice->id),
                                            'color' => 'info',
                                            'icon' => 'download',
                                            'label' => __("Download")
                                        ]
                                    ], 'item', 'admin.includes.forms_actions')
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center">
                                    {{ __('Invoices empty') }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>

                @if ($invoices->isNotEmpty())
                    <div class="card-footer">
                        @if (isset($filters))
                            {!! $invoices->appends($filters)->links() !!}
                        @else
                            {!! $invoices->links() !!}
                        @endif
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>

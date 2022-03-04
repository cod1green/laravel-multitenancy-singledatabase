@section('title', __("Make the payment") )

<x-app-layout>

    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Make the payment') }}
        </h2>
    </x-slot>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('subscriptions.store') }}" method="POST" id="form">
                <div class="card card-dark shadow">
                    <div class="card-header">
                        <h5>{{ __("You are signing") }}</h5>
                        <p>{{ $plan->name }}</p>
                    </div>
                    <div class="card-body">
                        <div id="show-errors" style="display: none;" class="my-2 text-sm text-red-dark"></div>

                        @csrf

                        <div class="input-group mb-3">
                            <input id="card-holder-name" type="text" class="form-control"
                                   placeholder="{{ __("Holder's name, as it is on the card") }}">
                        </div>

                        <div id="card-element" class="form-control"></div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <x-jet-button type="submit" id="card-buttom" data-secret="{{ $intent->client_secret }}">
                            {{ __('Confirm payment') }}
                        </x-jet-button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script src="https://js.stripe.com/v3/"></script>

<script>
    const stripe = Stripe("{{ config('cashier.key') }}");
    const elements = stripe.elements();
    const cardElement = elements.create('card', {
        style: {
            base: {
                iconColor: '#666EE8',
                lineHeight: '25px',
            },
        }
    });
    cardElement.mount('#card-element');

    const showErrors = document.getElementById('show-errors')

    // subscription payment
    const form = document.getElementById('form')
    const cardHolderName = document.getElementById('card-holder-name')
    const cardButton = document.getElementById('card-button')
    const clientSecret = cardButton.dataset.secret

    form.addEventListener('submit', async (e) => {
        e.preventDefault()

        // Disable button
        cardButton.classList.add('cursor-not-allowed')
        cardButton.firstChild.data = '{{ __("checking the data") }}'

        // reset errors
        showErrors.innerText = ''
        showErrors.style.display = 'none'

        const {setupIntent, error} = await stripe.confirmCardSetup(
            clientSecret, {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            }
        )

        if (error) {
            console.log(error)
            const errData = "{{__("Invalid data, please check and try again")}}"
            showErrors.style.display = 'block'
            showErrors.innerText = (error.type == 'validation_error') ? error.message : errData

            cardButton.classList.remove('cursor-not-allowed')
            return;
        }

        let token = document.createElement('input')
        token.setAttribute('type', 'hidden')
        token.setAttribute('name', 'token')
        token.setAttribute('value', setupIntent.payment_method)

        form.appendChild(token)
        form.submit()
    });
</script>

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
</style>

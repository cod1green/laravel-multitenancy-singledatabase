<template>
    <form action="#" class="margin-clear" role="form" @submit.prevent="sendContact">
        <div class="row">
            <div class="col-md-6 form-group has-feedback mb-10">
                <label class="sr-only" for="name">Nome</label>
                <input
                    id="name"
                    v-model="formData.name"
                    class="form-control"
                    minlength="4"
                    name="name"
                    placeholder="Nome"
                    required
                    type="text">
                <i class="fa fa-user form-control-feedback pr-4"></i>
            </div>
            <div class="col-md-6 form-group has-feedback mb-10">
                <label class="sr-only" for="email">E-mail</label>
                <input
                    id="email"
                    v-model="formData.email"
                    class="form-control"
                    name="email"
                    placeholder="E-mail"
                    required
                    type="email">
                <i class="fa fa-envelope form-control-feedback pr-4"></i>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12 form-group has-feedback mb-10">
                <label class="sr-only" for="subject">Assunto</label>
                <input
                    id="subject"
                    v-model="formData.subject"
                    class="form-control"
                    minlength="4"
                    name="subject"
                    placeholder="Assunto"
                    required
                    type="text">
                <i class="fas fa-heading form-control-feedback pr-4"></i>
                <div class="validate"></div>
            </div>
        </div>

        <div class="form-group has-feedback mb-10">
            <label class="sr-only" for="message">Mensagem</label>
            <textarea
                id="message"
                v-model="formData.message"
                class="form-control"
                name="message"
                placeholder="Mensagem"
                required
                rows="4"></textarea>
            <i class="fa fa-pencil form-control-feedback"></i>
            <div class="validate"></div>
        </div>

        <div class="mb-3">
            <div v-if="preloader" class="loading">Loading</div>
        </div>

        <button class="margin-clear submit-button radius-50 btn btn-default" type="submit">Enviar</button>
    </form>
</template>

<script>
export default {
    data() {
        return {
            preloader: false,
            formData: {
                name: '',
                email: '',
                subject: '',
                message: '',
            }
        }
    },

    methods: {
        sendContact () {
            this.preloader = true

            axios.post('/api/contact', this.formData, {
                'Accept': 'application/json',
            })
                .then(response => this.$vToastify.success('E-mail enviado com sucesso', 'Sucesso'))
                .catch(error => console.log(error))
                .finally(() => {
                    this.preloader = false
                    this.reset()
                });
        },
        reset () {
            this.formData = {
                name: '',
                email: '',
                subject: '',
                message: '',
            }
        }
    }
}
</script>

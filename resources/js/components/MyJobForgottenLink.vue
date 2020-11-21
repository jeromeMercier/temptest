<template>
    <v-layout row wrap>
        <v-flex xs12>
            <v-card
                class="text-xs-left ma-4 align-center text-xs-left epfl-card"
                flat
                tile
                max-width="550"
            >
                <v-card-title class="pb-2">
                    <h2>{{ $t("general.titles.forgotten-link") }}</h2>
                </v-card-title>
                <v-card-text>
                    {{ $t("general.texts.forgotten-link") }} <br />
                    <v-form ref="form" v-model="valid" lazy-validation>
                        <v-text-field
                            v-model="form.contact_email"
                            :label="
                                $t('general.placeholders.forgotten-link-mail') +
                                    '*'
                            "
                            :rules="emailRules"
                            required
                        ></v-text-field>
                        <v-btn
                            :disabled="!valid"
                            @click="validate"
                            color="secondary"
                            depressed
                            class="white-text ma-0"
                            >{{
                                $t("general.buttons.submit.send-short")
                            }}</v-btn
                        >
                    </v-form>
                </v-card-text>
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    props: ["options"],
    data() {
        return {
            valid:null,
            emailRules: [
                v => !!v || this.$t("validation.required"),
                v => /.+@.+/.test(v) || this.$t("validation.email_valid")
            ],
            form: {
                contact_email: null
            }
        };
    },
    created() {},
    methods: {
        validate() {
            if (this.$refs.form.validate() /*&& this.form.g_recaptcha_response != ''*/) {
                this.snackbar = true
                this.submit();
            }
            /* Uncomment for recaptcha activation
            else if(this.form.g_recaptcha_response == ''){
                this.captchaAlert=true;
            }*/
        },
        submit() {
            axios.post('/forgotten-link', this.form).then(response => {
                if(response.data == 'success'){
                    this.$root.showAlert = true;
                    this.$root.alertType = 'success';
                    this.$root.alertMessage = this.$t('general.texts.forgotten-link-success');
                    setTimeout(() => {  this.$root.redirect('/'); }, 4000);
                } else {
                    this.$root.alertType = 'error';
                    this.$root.alertMessage = this.$t('general.texts.forgotten-link-error', { email: response.data });
                    this.$root.showAlert = true;
                }
            }).catch(error => {
                this.$root.alertType = 'error';
                    this.$root.alertMessage = error;
                    this.$root.showAlert;
            });
        }
    }
};
</script>

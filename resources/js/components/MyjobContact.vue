<template>
<v-card class="text-xs-left ma-4 align-center text-xs-left epfl-card" flat tile>

    <v-card-title class="pb-2">
        <h2>{{ $t('general.titles.contact')}}</h2>
    </v-card-title>
    <v-card-text>{{ $t('general.texts.contact')}}
    </v-card-text>
    <v-form ref="form" v-model="valid" lazy-validation>
        <v-card-text class="px-3">
            <v-container fluid class="pa-0">
                <v-layout row wrap class="pa-0">
                    <v-flex xs12 md4 class="px-1">

                        <v-text-field v-model="form.first_name" :label="$t('contacts.placeholders.first_name')" required :rules="[v => !!v || 'Item is required']"></v-text-field>


                    </v-flex>
                    <v-flex xs12 md4 class="px-1">

                        <v-text-field v-model="form.last_name" :label="$t('contacts.placeholders.last_name')" required :rules="[v => !!v || 'Item is required']"></v-text-field>


                    </v-flex>
                    <v-flex xs12 md4 class="px-1">

                        <v-text-field v-model="form.email" :label="$t('contacts.placeholders.email')" required :rules="emailRules"></v-text-field>


                    </v-flex>
                    <v-flex xs12 class="px-1">
                      <v-textarea v-model="form.message" rows="4"  auto-grow required :rules="messageRules" :counter="500">
                          <template v-slot:label>
                              <div>
                                  {{$t('contacts.placeholders.message')}}
                              </div>
                          </template>
                      </v-textarea>
                    </v-flex>

                </v-layout>
            </v-container>
        </v-card-text>
    </v-form>
    <v-card-actions class="justify-center">
      <v-btn :disabled="!valid" flat @click="submit" :class="buttonColor" ><v-icon left dark>send</v-icon>{{ $t('general.buttons.submit.send') }}</v-btn>

    </v-card-actions>

</v-card>
</template>

<script>
export default {
    data() {
        return {
          valid:true,
          form: {
            first_name: '',
            last_name: '',
            email: '',
            message: '',
          },


            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            messageRules: [
                v => !!v || 'Message is required',
                v => (v && v.length <= 500) || 'Title must be less than 500 characters'
            ],
        };
    },
    computed: {
        buttonColor(){
          if(this.validate){
            return"btn-epfl white-text";
          }
        }
    },
    created() {

    },
    methods: {
      validate() {
          if (this.$refs.form.validate()) {
              this.snackbar = true
          }
          else{
            this.sumbit();
          }
      },
      submit() {
        console.log("submit");
          this.errors = {};
          axios.post('/help', this.form).then(response => {
            console.log(response)
              alert('Message sent!');
          }).catch(error => {
              console.log(error);
          });
      },
    }

}
</script>

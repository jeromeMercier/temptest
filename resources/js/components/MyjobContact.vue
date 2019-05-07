<template>
<v-card class="text-xs-left ma-4 align-center text-xs-left">

    <v-card-title class="pb-2">
        <h2>Formulaire de contact</h2>
    </v-card-title>
    <v-card-text>Pour toute·s question·s (après avoir lu attentivement la foire aux questions) et/ou suggestion·s, vous pouvez contacter rapidement l'équipe par ici.
    </v-card-text>
    <v-form ref="form" v-model="valid" lazy-validation>
        <v-card-text class="px-3">
            <v-container fluid class="pa-0">
                <v-layout row wrap class="pa-0">
                    <v-flex xs12 md4 class="px-1">

                        <v-text-field v-model="prenom" label="Prenom" required></v-text-field>


                    </v-flex>
                    <v-flex xs12 md4 class="px-1">

                        <v-text-field v-model="nom" label="Nom" required></v-text-field>


                    </v-flex>
                    <v-flex xs12 md4 class="px-1">

                        <v-text-field v-model="email" label="Email" required></v-text-field>


                    </v-flex>
                    <v-flex xs12 class="px-1">
                      <v-textarea v-model="message" rows="4"  auto-grow :rules="message.length<500" :counter="500">
                          <template v-slot:label>
                              <div>
                                  Message
                              </div>
                          </template>
                      </v-textarea>
                    </v-flex>

                </v-layout>
            </v-container>
        </v-card-text>
    </v-form>
    <v-card-actions class="justify-center">
        <v-btn class="epfl-bg-color" text-color="white" dark>
            <v-icon left dark>send</v-icon>Envoyer le message
        </v-btn>
    </v-card-actions>

</v-card>
</template>

<script>
export default {
    data() {
        return {
            prenom: '',
            nom: '',
            email: '',
            message: '',
        };
    },
    created() {

    },
    methods: {}

}
</script>

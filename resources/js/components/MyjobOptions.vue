<template>
<v-layout row wrap>
    <v-flex xs12>
        <v-card class="text-xs-left ma-4 align-center text-xs-left" max-width="550">
            <v-card-title class="pb-2">
                <h2>Options</h2>
            </v-card-title>
            <v-card-text>
                <v-switch v-model="arrayOptions.notifications_instant" label="Notification instantanée (dès la modération de l'annonce)" @change="submit()"></v-switch>
                <v-switch v-model="arrayOptions.notifications_day" label="Notification journalière (nouvelles annonces du jour)" @change="submit()"></v-switch>
                <v-switch v-model="arrayOptions.notifications_week" label="Notification hebdomadaire (nouvelles annonces de la semaine)" @change="submit()"></v-switch>
            </v-card-text>

        </v-card>

    </v-flex>

    <v-alert v-model="showAlert" color="success" icon="check_circle" dismissible class="myjob-alert elevation-24">
        Options updated
    </v-alert>
</v-layout>
</template>


<script>
export default {
    props: ['options'],
    data() {
        return {
            questions: this.items,
            switch1: false,
            switch2: true,
            arrayOptions: JSON.parse(this.options),
            showAlert: false
        };
    },
    created() {
        console.log(this.arrayOptions);
    },
    methods: {
        submit() {
          this.showAlert=false;
            axios.put('/options', this.arrayOptions).then(response => {
                this.showAlert = true;
            }).catch(error => {
                console.log(error);
            });
        }
    }

}
</script>

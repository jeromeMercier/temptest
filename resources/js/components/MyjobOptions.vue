<template>
<v-layout row wrap>
    <v-flex xs12>
        <v-card class="text-xs-left ma-4 align-center text-xs-left epfl-card" flat tile max-width="550">
            <v-card-title class="pb-2">
                <h2>{{ $t('general.titles.notifications') }}</h2>
            </v-card-title>
            <v-card-text>
                <v-switch v-model="arrayOptions.notifications_instant" :label="$t('options.labels.notifications_instant')" @change="submit()" color="red"></v-switch>
                <v-switch v-model="arrayOptions.notifications_day" :label="$t('options.labels.notifications_day')" @change="submit()" color="red"></v-switch>
                <v-switch v-model="arrayOptions.notifications_week" :label="$t('options.labels.notifications_week')" @change="submit()" color="red"></v-switch>
            </v-card-text>

        </v-card>

    </v-flex>

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

    },
    methods: {
        submit() {
          this.$root.showAlert=false;
          var that = this;
            axios.put('/options', this.arrayOptions).then(response => {
                this.$root.showAlert = true;
                this.$root.alertType = 'success';
                this.$root.alertMessage = that.$t('options.labels.options_updated');
            }).catch(error => {
                console.log(error);
            });
        }
    }

}
</script>

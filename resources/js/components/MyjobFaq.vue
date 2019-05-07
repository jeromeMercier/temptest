<template>
<v-card class="ma-4">
    <v-card-title class="pb-2">
        <h2>Foire aux questions</h2>
    </v-card-title>
    <v-card-text>
        Après de nombreuses années de services, l'équipe de Myjob a soigneusement répertorié ici les questions les plus posées.
    </v-card-text>

    <v-expansion-panel popout class="pb-4">
        <v-expansion-panel-content v-for="(item,i) in questions" :key="i">
            <template v-slot:header>
                <div>{{item.question_fr}}</div>
            </template>
            <v-card>
                <v-card-text v-html="item.answer_fr"></v-card-text>
            </v-card>
        </v-expansion-panel-content>
    </v-expansion-panel>

</v-card>
</template>


<script>
export default {
    props: ['items'],
    data() {
        return {
            questions: this.items,
        };
    },
    created() {

    },
    methods: {}

}
</script>

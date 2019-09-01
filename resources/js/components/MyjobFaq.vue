<template>
<v-card class="ma-4">
    <v-card-title class="pb-2">
        <h2>{{ $t('general.titles.faq') }}</h2>
    </v-card-title>
    <v-card-text>
        {{ $t('general.texts.faq') }}
    </v-card-text>

    <v-expansion-panel popout class="pb-4">
        <v-expansion-panel-content v-for="(item,i) in questions" :key="i">
            <template v-slot:header>
                <div>{{getQuestion(item, $i18n.locale)}}</div>
            </template>
            <v-card>
                <v-card-text v-html="getAnswer(item, $i18n.locale)"></v-card-text>
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
    computed: {

    },
    methods: {
      getQuestion(item, locale){
        return eval('item.question_' + locale);
      },
      getAnswer(item, locale){
        return eval('item.answer_' + locale);
      }
    }

}
</script>

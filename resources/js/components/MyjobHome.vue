<template>
<v-layout row wrap>
    <v-flex xs12  md4>
        <v-card class="text-xs-center ma-4 align-center adopte-etudiant-card">
            <v-layout align-center fill-height>
                <v-flex xs12>
                    <v-card-text primary-title>
                        <h1>
                            {{ $t('general.titles.adopt') }}
                        </h1>
                    </v-card-text >

                    <v-card-text v-html="$t('general.texts.description')">

                    </v-card-text>
                    <v-container class="pt-0">
                        <v-layout row wrap>
                            <v-flex sm6>
                                <v-card flat>
                                    <v-card-text width="150" height="150">
                                        <h1 class="epfl-txt-color">{{ students }}</h1>
                                    </v-card-text>
                                    <v-card-actions class="justify-center ">{{ $t('general.titles.students') }}</v-card-actions>
                                </v-card>

                            </v-flex>
                            <v-flex sm6>
                                <v-card flat>
                                    <v-card-text width="150" height="150">
                                        <h1 class="epfl-txt-color">{{publishers}}</h1>
                                    </v-card-text>
                                    <v-card-actions class="justify-center ">{{ $t('general.titles.publishers') }}</v-card-actions>
                                </v-card>
                            </v-flex>
                        </v-layout>
                    </v-container>
                </v-flex>
            </v-layout>
        </v-card>
    </v-flex>
    <v-flex xs12 md4>
        <v-card class="text-xs-center ma-4">
            <v-container>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-card flat>
                            <v-card-text>
                                <v-icon size="130" color="black">work_outline</v-icon>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs12>
                        <v-card flat>
                            <v-card-text>
                                <h1>{{ $t('general.titles.publishers') }}</h1>
                            </v-card-text>
                            <v-card-actions class="justify-center">
                                <v-btn class="epfl-bg-color" text-color="white" dark @click="redirect('/new-job')">{{ $t('general.buttons.offer') }}</v-btn>
                            </v-card-actions>
                            <v-card-text class="pb-0" v-html="$t('general.texts.noinscription')"></v-card-text>
                            <v-card-text class="pt-0"><a @click="redirect('forgotten-link')">{{ $t('general.texts.oldad') }}</a></v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
    </v-flex>
    <v-flex xs12 md4>
        <v-card class="text-xs-center ma-4">
            <v-container>
                <v-layout row wrap>
                    <v-flex xs12>
                        <v-card flat>
                            <v-card-text>
                                <v-icon size="130" color="black">school</v-icon>
                            </v-card-text>
                        </v-card>
                    </v-flex>
                    <v-flex xs12>
                        <v-card flat>
                            <v-card-text>
                                <h1>{{ $t('general.titles.students') }}</h1>
                            </v-card-text>
                            <v-card-actions class="justify-center">
                                <v-btn class="epfl-bg-color" text-color="white" dark @click="redirect('/jobs')">{{ $t('general.buttons.seek') }}</v-btn>
                            </v-card-actions>
                            <v-card-text class="pb-0" v-html="$t('general.texts.tequila')"></v-card-text>
                            <v-card-text class="pt-0"><a href="https://gaspar.epfl.ch/cgi-bin/gaspar-web/lostpwd">{{ $t('general.texts.newpassword') }}</a></v-card-text>
                        </v-card>
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card>
    </v-flex>
</v-layout>
</template>

<script>
export default {
    props: ['students', 'publishers'],
    components: {
        SheetFooter: {
            functional: true,
            render(h, {
                children
            }) {
                return h('v-sheet', {
                    staticClass: 'mt-auto align-center justify-center d-flex',
                    props: {
                        color: 'rgba(0, 0, 0, .36)',
                        dark: true,
                        height: 50
                    }
                }, children)
            }
        }
    },
    data() {
        return {

        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            console.log(' mounted');
        }
    }
}
</script>

<template>
<v-layout row wrap>
    <v-flex xs12  md4>
        <v-card class="text-xs-center ma-4 align-center adopte-etudiant-card">
            <v-layout align-center fill-height>
                <v-flex xs12>
                    <v-card-text primary-title>
                        <h1>
                            Adopte un étudiant EPFL
                        </h1>
                    </v-card-text>
                    <v-card-text>
                        L'Association Générale des Etudiants de l'Ecole Polytechnique Fédérale de Lausanne met gratuitement cette plateforme à disposition pour mettre en relation étudiants et employeurs. Le but est de permettre aux étudiants de
                        trouver
                        facilement un job/emploi durant leurs études, et en même temps d'offrir aux employeurs des profils variés et qualifiés.
                    </v-card-text>
                    <v-container class="pt-0">
                        <v-layout row wrap>
                            <v-flex sm6>
                                <v-card flat>
                                    <v-card-text width="150" height="150">
                                        <h1 class="epfl-txt-color">{{students}}</h1>
                                    </v-card-text>
                                    <v-card-actions class="justify-center ">Etudiants</v-card-actions>
                                </v-card>

                            </v-flex>
                            <v-flex sm6>
                                <v-card flat>
                                    <v-card-text width="150" height="150">
                                        <h1 class="epfl-txt-color">{{publishers}}</h1>
                                    </v-card-text>
                                    <v-card-actions class="justify-center ">Employeurs</v-card-actions>
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
                                <h1>Employeur</h1>
                            </v-card-text>
                            <v-card-actions class="justify-center">
                                <v-btn class="epfl-bg-color" text-color="white" dark @click="redirect('/new-job')">Je recherche un étudiant</v-btn>
                            </v-card-actions>
                            <v-card-text class="pb-0">Aucune inscription, gestion par email.</v-card-text>
                            <v-card-text class="pt-0"><a>Retrouver une ancienne annonce.</a></v-card-text>
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
                                <h1>Students</h1>
                            </v-card-text>
                            <v-card-actions class="justify-center">
                                <v-btn class="epfl-bg-color" text-color="white" dark>Je recherche un job</v-btn>
                            </v-card-actions>
                            <v-card-text class="pb-0">Accès Tequila requis.</v-card-text>
                            <v-card-text class="pt-0"><a>Recevoir un nouveau mot de passe.</a></v-card-text>
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

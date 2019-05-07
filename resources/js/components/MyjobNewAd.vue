<template>
<v-layout row wrap>
    <v-flex xs12 md8 align-center class="align-center text-xs-center">
        <v-form ref="form" v-model="valid" lazy-validation>
            <v-card class="text-xs-left ma-4 align-center" align-center>
                <div class="agep-bg-color" style="width:100%; height:53px;">
                    <v-card-text>
                        <h4 style="color:white;">INFORMATIONS GÉNÉRALES</h4>
                    </v-card-text>
                </div>
                <v-container>
                    <v-layout row wrap>
                        <v-flex xs12 class="px-1">
                            <v-text-field v-model="titre" label="Titre" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-select :items="listeCategorie" label="Categories"></v-select>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="lieuDeTravail" label="Lieu de travail" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-card class="text-xs-left ma-4 align-center" align-center>
                <div class="agep-bg-color" style="width:100%; height:53px;">
                    <v-card-text>
                        <h4 style="color:white;">DÉTAILS DU JOB</h4>
                    </v-card-text>
                </div>
                <v-container>
                    <v-layout row wrap>
                        <v-flex xs6 class="px-1">
                            <v-menu v-model="menuDateDebut" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width min-width="290px">
                                <template v-slot:activator="{ on }">
                                    <v-text-field v-model="dateDebut" label="Date de début" prepend-icon="event" readonly v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="dateDebut" @input="menuDateDebut = false" :min="date"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-menu v-model="menuDateFin" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width min-width="290px">
                                <template v-slot:activator="{ on }">
                                    <v-text-field v-model="dateFin" label="Date de fin" prepend-icon="event" readonly v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="dateFin" @input="menuDateFin = false" :min="dateDebut"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-select :items="listeDuree" label="Durée indicative"></v-select>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="remuneration" label="Rémuneration" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="competences" label="Compétences" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="langues" label="Langues" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 class="px-1">
                            <v-select v-model="sections" :items="listeSections" label="Favorite Fruits" multiple>
                                <template v-slot:prepend-item>
                                    <v-list-tile ripple @click="selectAllSections">
                                        <v-list-tile-action>
                                            <v-icon :color="sections.length > 0 ? 'indigo darken-4' : ''">{{icon}}</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Select All</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-divider class="mt-2"></v-divider>
                                </template>
                                <template v-slot:selection="{ item, index }">
                                    <span v-if="index<3 && !(sections.length === listeSections.length) && !(index===sections.length-1)">{{ item }},&nbsp;</span>
                                    <span v-if="index<3 && !(sections.length === listeSections.length) && (index===sections.length-1)">{{ item }}&nbsp;</span>
                                    <span v-if="sections.length >2 && !(sections.length === listeSections.length) && index ===3" class="grey--text caption">(+{{ sections.length - 3 }} others)</span>
                                    <span v-if="sections.length === listeSections.length && index===0">All</span>
                                </template>
                            </v-select>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-card class="text-xs-left ma-4 align-center" align-center>
                <div class="agep-bg-color" style="width:100%; height:53px;">
                    <v-card-text>
                        <h4 style="color:white;">CORPS DE L'ANNONCE</h4>
                    </v-card-text>
                </div>
                <v-container>
                    <v-layout row wrap>
                        <v-flex xs12 class="px-1">
                            <v-textarea v-model="description" color="teal" auto-grow :rules="description.length<500" :counter="500">
                                <template v-slot:label>
                                    <div>
                                        Description
                                    </div>
                                </template>
                            </v-textarea>
                        </v-flex>

                    </v-layout>
                </v-container>
            </v-card>
            <v-card class="text-xs-left ma-4 align-center" align-center>
                <div class="agep-bg-color" style="width:100%; height:53px;">
                    <v-card-text>
                        <h4 style="color:white;">PERSONNE DE CONTACT</h4>
                    </v-card-text>
                </div>
                <v-container>
                    <v-layout row wrap>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="prenom" label="Prenom" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="nom" label="Nom" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="email" label="Email" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="telephone" label="Telephone" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-container class="mx-4 mt-4 pa-0">
                <v-checkbox color="#7595af"v-model="projetJe" label="Lancer le projet avec la junior entreprise"></v-checkbox>
            </v-container>
            <v-btn class="epfl-bg-color" dark>Enregistrer la nouvelle annonce</v-btn>

        </v-form>
    </v-flex>
    <v-flex xs12 md4>
        <v-card class="text-xs-left ma-4 align-center text-xs-left">
            <v-card-title class="pb-2">
                <h2>Gestion de l'annonce</h2>
            </v-card-title>
            <v-card-text>Il existe deux façons de gérer l'annonce. Pour les collaborateurs et les étudiants de l'EPFL, il est possible de se connecter au moyen de Tequila, puis d'aller dans la rubrique "mes annonces". Pour les autres, il suffit de
                cliquer sur le lien envoyé par email à la création de l'annonce ou d'en redemander un. Dans tous les cas, l'annonce est visible durant 15 jours, durée après laquelle il faut la renouveler.
            </v-card-text>
            <v-card-actions>
                <v-btn class="epfl-bg-color" text-color="white" dark>
                    <v-icon left dark>restore</v-icon>Récuperer une annonce
                </v-btn>
            </v-card-actions>
        </v-card>
        <v-card class="text-xs-left ma-4 align-center text-xs-left">
            <v-card-title class="pb-2">
                <h2>Conditions d'acceptation</h2>
            </v-card-title>
            <v-card-text>
                <p>
                    L'annonce doit respecter les critères suivants pour être validée:
                </p>
                <ol>
                    <li>cible un étudiant durant ses études à l'EPFL</li>
                    <li>respect du tarif minimum : CHF 24.—/h</li>
                    <li>pas de lien de postulation extérieure</li>
                    <li>les annonces doivent être rédigées en français ou anglais</li>
                </ol>
            </v-card-text>
            <v-card-actions>
                <v-btn class="epfl-bg-color" text-color="white" dark>
                    <v-icon left dark>contact_support</v-icon>Poser une question
                </v-btn>
            </v-card-actions>
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
            projetJe: false,
            titre: '',
            sections: [],
            categorie: '',
            lieuDeTravail: '',
            dateDebut: new Date().toISOString().substr(0, 10),
            menuDateDebut: false,
            menuDateFin: false,
            dateFin: '',
            dureeInactive: '',
            remuneration: '',
            competences: '',
            langues: '',
            description: '',
            prenom: '',
            nom: '',
            email: '',
            telephone: '',
            listeCategorie: [
                'Aide à domicile', 'Babysitting', 'Expériences', 'Informatique', 'Job de bureau',
                'Flyering', 'Administratif', 'Etudes/experiences',
                'Promotion', 'Restauration/Hôtellerie', 'Soutien scolaire', 'Autre'
            ],
            listeDuree: [
                'Temps plein', 'A côté des études', 'Weekends', 'Vacances', 'Autre'
            ],
            listeSections: [
                'Architecture', 'Chimie et génie chimique', 'Cours de mathématiques spéciales', 'EME (EPFL Middle East)', 'Génie civil',
                'Génie mecanique', 'Génie électrique et electronique', 'Humanités digitales', 'Informatique', 'Ingénierie des sciences du vivant',
                'Ingénierie financière', 'Management de la technologie', 'Mathématiques', 'Microtechnique', 'Physique', 'Science et génie des materiaux',
                "Science et ingénierie de l'environnement", 'section FCUE', 'Système de communication'
            ],
            date: new Date().toISOString().substr(0, 10),
        };
    },
    created() {
        this.fetchData();
    },
    computed: {
        icon() {
            if (this.sections.length === this.listeSections.length) return 'cancel'
            return 'check_box_outline_blank'
        }
    },
    methods: {
        fetchData() {
            console.log(' mounted');
        },
        selectAllSections() {
            this.$nextTick(() => {
                if (this.sections.length === this.listeSections.length) {
                    this.sections = []
                } else {
                    this.sections = this.listeSections.slice()
                }
            })
        }
    }
}
</script>

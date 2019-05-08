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
                            <v-text-field v-model="form.titre" label="Titre" required :rules="titleRules"></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-select v-model="form.categorie" :items="listeCategorie" :rules="[v => !!v || 'Item is required']" label="Categorie" required></v-select>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.lieuDeTravail" label="Lieu de travail" required :rules="lieuRules"></v-text-field>
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
                                    <v-text-field v-model="form.dateDebut" label="Date de début" prepend-icon="event" readonly v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="form.dateDebut" @input="menuDateDebut = false" :min="date"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-menu v-model="menuDateFin" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width min-width="290px">
                                <template v-slot:activator="{ on }">
                                    <v-text-field v-model="form.dateFin" label="Date de fin" prepend-icon="event" readonly v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="form.dateFin" @input="menuDateFin = false" :min="form.dateDebut"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-select :items="listeDuree" label="Durée indicative" v-model="form.duree" :rules="[v => !!v || 'Item is required']" required></v-select>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.remuneration" label="Rémuneration" :rules="[v => !!v || 'Item is required']" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.competences" label="Compétences" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.langues" label="Langues" required></v-text-field>
                        </v-flex>
                        <v-flex xs12 class="px-1">
                            <v-select v-model="form.sections" :items="listeSections" label="Favorite Fruits" multiple>
                                <template v-slot:prepend-item>
                                    <v-list-tile ripple @click="selectAllSections">
                                        <v-list-tile-action>
                                            <v-icon :color="form.sections.length > 0 ? 'indigo darken-4' : ''">{{icon}}</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Select All</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-divider class="mt-2"></v-divider>
                                </template>
                                <template v-slot:selection="{ item, index }">
                                    <span v-if="index<3 && !(form.sections.length === listeSections.length) && !(index===form.sections.length-1)">{{ item }},&nbsp;</span>
                                    <span v-if="index<3 && !(form.sections.length === listeSections.length) && (index===form.sections.length-1)">{{ item }}&nbsp;</span>
                                    <span v-if="form.sections.length >2 && !(form.sections.length === listeSections.length) && index ===3" class="grey--text caption">(+{{ sections.length - 3 }} others)</span>
                                    <span v-if="form.sections.length === listeSections.length && index===0">All</span>
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
                            <v-textarea v-model="form.description" color="teal" auto-grow :rules="[v => !!v || 'Item is required', v => form.description.length<500 || 'Description must be lass than 500 car']" :counter="500">
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
                            <v-text-field v-model="form.prenom" label="Prenom" :rules="[v => !!v || 'Item is required']" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.nom" label="Nom" :rules="[v => !!v || 'Item is required']" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.email" label="Email" :rules="emailRules" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.telephone" label="Telephone" required></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-container class="mx-4 mt-4 pa-0">
                <v-checkbox color="#7595af" v-model="form.projetJe" label="Lancer le projet avec la junior entreprise"></v-checkbox>
            </v-container>

            <v-btn :disabled="!valid" @click="validate" :class="buttonColor" >Enregistrer la nouvelle annonce</v-btn>

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
            form: {
                projetJe: false,
                titre: '',
                sections: [],
                categorie: null,
                lieuDeTravail: '',
                dateDebut: null,
                dateFin: null,
                remuneration: '',
                competences: '',
                langues: '',
                description: '',
                prenom: '',
                nom: '',
                email: '',
                telephone: '',
            },
            menuDateDebut: false,
            menuDateFin: false,

            valid: true,

            titleRules: [
                v => !!v || 'Title is required',
                v => (v && v.length <= 80) || 'Title must be less than 80 characters'
            ],
            lieuRules: [
                v => !!v || 'Lieu is required',
                v => (v && v.length <= 40) || 'Lieu must be less than 40 characters'
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            categorieRules: [
                v => !!v || 'Categorie is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            dateRules: [
                v => !!v || 'Date is required'
            ],


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
            if (this.form.sections.length === this.listeSections.length) return 'cancel'
            return 'check_box_outline_blank'
        },
        buttonColor(){
          if(this.validate){
            return"epfl-bg-color white-text";
          }
        }
    },
    methods: {
        fetchData() {
            console.log(' mounted');
        },
        selectAllSections() {
            this.$nextTick(() => {
                if (this.form.sections.length === this.listeSections.length) {
                    this.form.sections = []
                } else {
                    this.form.sections = this.listeSections.slice()
                }
            })
        },
        validate() {
            if (this.$refs.form.validate()) {
                this.snackbar = true
            }
        },
    }
}
</script>

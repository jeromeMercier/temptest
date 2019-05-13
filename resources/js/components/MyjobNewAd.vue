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
                            <v-text-field v-model="form.title" label="Titre" required :rules="titleRules"></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-select v-model="form.category_id" :items="listeCategorie" :rules="[v => !!v || 'Item is required']" label="Categorie" required></v-select>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.place" label="Lieu de travail" required :rules="baseRules"></v-text-field>
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
                                    <v-text-field v-model="form.starts_at" label="Date de début" prepend-icon="event" readonly v-on="on" required :rules="[v => !!v || 'Item is required']"></v-text-field>
                                </template>
                                <v-date-picker v-model="form.starts_at" @input="menuDateDebut = false" :min="date"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-menu v-model="menuDateFin" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width min-width="290px">
                                <template v-slot:activator="{ on }">
                                    <v-text-field v-model="form.ends_at" label="Date de fin" prepend-icon="event" readonly v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="form.ends_at" @input="menuDateFin = false" :min="form.starts_at"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-select :items="listeDuree" label="Durée indicative" v-model="form.duration" :rules="[v => !!v || 'Item is required']" required></v-select>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.salary" label="Rémuneration" :rules="baseRules" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.skills" label="Compétences" :rules="skillRules"></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.languages" label="Langues" :rules="languageRules"></v-text-field>
                        </v-flex>
                        <v-flex xs12 class="px-1">
                            <v-select v-model="form.section_ids" :items="listeSections" label="Sections" multiple>
                                <template v-slot:prepend-item>
                                    <v-list-tile ripple @click="selectAllSections">
                                        <v-list-tile-action>
                                            <v-icon :color="form.section_ids.length > 0 ? 'indigo darken-4' : ''">{{icon}}</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Select All</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-divider class="mt-2"></v-divider>
                                </template>
                                <template v-slot:selection="{ item, index }">
                                    <span v-if="index<3 && !(form.section_ids.length === listeSections.length) && !(index===form.section_ids.length-1)">{{ item }},&nbsp;</span>
                                    <span v-if="index<3 && !(form.section_ids.length === listeSections.length) && (index===form.section_ids.length-1)">{{ item }}&nbsp;</span>
                                    <span v-if="form.section_ids.length >2 && !(form.section_ids.length === listeSections.length) && index ===3" class="grey--text caption">(+{{ section.length - 3 }} others)</span>
                                    <span v-if="form.section_ids.length === listeSections.length && index===0">All</span>
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
                            <v-textarea v-model="form.description" color="teal" auto-grow :rules="descriptionRules" :counter="500">
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
                            <v-text-field v-model="form.contact_first_name" label="Prenom" :rules="baseRules" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.contact_last_name" label="Nom" :rules="baseRules" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.contact_email" label="Email" :rules="emailRules" required></v-text-field>
                        </v-flex>
                        <v-flex xs6 class="px-1">
                            <v-text-field v-model="form.contact_phone" label="Telephone" :rules="phoneRules"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-container class="mx-4 mt-4 pa-0">
                <v-checkbox color="#7595af" v-model="form.projetJe" label="Lancer le projet avec la junior entreprise"></v-checkbox>
            </v-container>

            <v-btn :disabled="!valid" @click="validate" :class="buttonColor">Enregistrer la nouvelle annonce</v-btn>

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
                title: '',
                section_ids: [],
                category_id: '',
                place: '',
                starts_at: new Date().toISOString().substr(0, 10),
                ends_at: '',
                salary: '',
                duration: '',
                skills: '',
                languages: '',
                description: '',
                contact_first_name: '',
                contact_last_name: '',
                contact_email: '',
                contact_phone: '',
            },
            menuDateDebut: false,
            menuDateFin: false,

            valid: true,
            errore: {},
            phoneRules: [
                v => (!v || v.length <= 15) || 'Item must be less than 15 characters',
                v => (!v || v.length > 5 || 'Item must be at least 5 characters')
            ],
            skillRules: [
                v => (!v || v.length <= 40) || 'Item must be less than 40 characters',
                v => (!v || v.length > 1 || 'Item must be at least 2 characters')
            ],
            languageRules: [
                v => (!v || v.length <= 40) || 'Item must be less than 40 characters',
                v => (!v || v.length > 1 || 'Item must be at least 2 characters')
            ],
            titleRules: [
                v => !!v || 'Title is required',
                v => (v && v.length <= 80) || 'Title must be less than 80 characters',
                v => (v && v.length > 4 || 'Item must be at least 5 characters')
            ],
            descriptionRules: [
                v => !!v || 'Item is required',
                v => (v && v.length <= 80) || 'Item must be less than 500 characters',
                v => (v && v.length > 9 || 'Item must be at least 10 characters')
            ],
            baseRules: [
                v => !!v || 'Item is required',
                v => (v && v.length <= 40) || 'Item must be less than 40 characters',
                v => (v && v.length > 1 || 'Item must be at least 2 characters')
            ],
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid',
                v => (v && v.length > 4 || 'Item must be at least 5 characters')
            ],
            categorieRules: [
                v => !!v || 'Categorie is required',
                v => /.+@.+/.test(v) || 'E-mail must be valid'
            ],
            dateRules: [
                v => !!v || 'Date is required'
            ],


            listeCategorie: [
                'Aide à domicile',
                'Babysitting',
                'Expériences',
                'Informatique',
                'Job de bureau',
                'Flyering',
                'Administratif',
                'Etudes/expériences',
                'Promotion',
                'Restauration / Hôtellerie',
                'Soutien scolaire',
                'Autre'
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


    },
    computed: {
        icon() {
            if (this.form.section_ids.length === this.listeSections.length) return 'cancel'
            return 'check_box_outline_blank'
        },
        buttonColor() {
            if (this.validate) {
                return "epfl-bg-color white-text";
            }
        }
    },
    methods: {
        fetchData() {
            console.log(' mounted');
        },
        selectAllSections() {
            this.$nextTick(() => {
                if (this.form.section_ids.length === this.listeSections.length) {
                    this.form.section_ids = []
                } else {
                    this.form.section_ids = this.listeSections.slice()
                }
            })
        },
        validate() {
            if (this.$refs.form.validate()) {
                this.snackbar = true
                this.submit();
            }
        },
        submit() {
            console.log("submit");
            this.errors = {};
            var sendableForm = {};
            for (var key in this.form) {
                if (!(this.form[key] === null || this.form[key] === '')) {
                    if (key === "category_id") {
                        sendableForm[key] = this.listeCategorie.indexOf(this.form[key]) + 1;
                    } else if (key === "duration") {
                        sendableForm[key] = this.listeDuree.indexOf(this.form[key]) + 1;
                    } else if (key === "section_ids") {
                        var sectionIdsSendable = [];
                        for (let i = 0; i < this.form.section_ids.length; i++) {
                            sectionIdsSendable.push(this.listeSections.indexOf(this.form.section_ids[i]));
                        }
                        sendableForm[key] = sectionIdsSendable;
                    } else {
                        sendableForm[key] = this.form[key];
                    }

                }
            }
            console.log(sendableForm)
            axios.post('/new-job', sendableForm).then(response => {
                console.log(response)
                alert('Message sent!');
            }).catch(error => {
                console.log(error);
            });
        },
    }
}
</script>

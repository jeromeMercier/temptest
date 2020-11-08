<template>
<v-layout row wrap>
    <v-flex xs12 md8 align-center class="align-center text-xs-center">
        <v-form ref="form" v-model="valid" lazy-validation> <!--  -->
            <v-card class="text-xs-left ma-4 align-center epfl-card" align-center flat tile >
                <div  style="width:100%; height:53px;">
                    <v-card-text>
                        <h4>{{ $t('ads.sections.general').toUpperCase() }}</h4>
                    </v-card-text>
                </div>
                <v-container class="pa-3">
                    <v-layout row wrap>
                        <v-flex xs12 class="px-1">
                            <v-text-field v-model="form.title" :label="$t('ads.labels.title')+'*'" required :rules="titleRules" :counter="80"></v-text-field>
                        </v-flex>
                        <v-flex xs12 sm6 class="px-1">
                            <v-select v-model="form.category_id" :items="listeCategorie" :rules="[v => !!v || $t('validation.required')]" :label="$t('ads.labels.category_id')+'*'" required>
                                <template slot="selection" slot-scope="data">
    <!-- HTML that describe how select should render selected items -->
    {{ $t("ads.category." + data.item)}}
  </template>
  <template slot="item" slot-scope="data">
    <!-- HTML that describe how select should render items when the select is open -->
    {{ $t("ads.category." + data.item)}}
  </template>
                            </v-select>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.place" :label="$t('ads.labels.place')+'*'" required :rules="baseRules" :counter="40"></v-text-field>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-card class="text-xs-left ma-4 align-center epfl-card" flat tile align-center>
                <div  style="width:100%; height:53px;">
                    <v-card-text>
                        <h4>{{ $t('ads.sections.details').toUpperCase() }}</h4>
                    </v-card-text>
                </div>
                <v-container class="pa-3">
                    <v-layout row wrap>
                        <v-flex sm6 xs12 class="px-1">
                            <v-menu v-model="menuDateDebut" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width min-width="290px">
                                <template v-slot:activator="{ on }">
                                    <v-text-field v-model="form.starts_at" :label="$t('ads.labels.starts_at')" prepend-icon="event" readonly v-on="on" required :rules="[v => !!v || $t('validation.required')]"></v-text-field>
                                </template>
                                <v-date-picker v-model="form.starts_at" @input="menuDateDebut = false" :min="date"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-menu v-model="menuDateFin" :close-on-content-click="false" :nudge-right="40" lazy transition="scale-transition" offset-y full-width min-width="290px">
                                <template v-slot:activator="{ on }">
                                    <v-text-field v-model="form.ends_at" :label="$t('ads.labels.ends_at')" prepend-icon="event" readonly v-on="on"></v-text-field>
                                </template>
                                <v-date-picker v-model="form.ends_at" @input="menuDateFin = false" :min="form.starts_at"></v-date-picker>
                            </v-menu>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-select :items="listeDuree"  :message="'dick'" :label="$t('ads.labels.duration')+'*'" v-model="form.duration" :rules="[v => !!v || $t('validation.required')]" required>
                                <template slot="selection" slot-scope="data">
    <!-- HTML that describe how select should render selected items -->
    {{ $t("ads.availability." + data.item)}} 
  </template>
  <template slot="item" slot-scope="data">
    <!-- HTML that describe how select should render items when the select is open -->
    {{ $t("ads.availability." + data.item)}} 
  </template>
                            </v-select>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.salary" :label="$t('ads.labels.salary')+'*'" :rules="baseRules" required :counter="40"></v-text-field>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.skills" :label="$t('ads.labels.skills')" :rules="skillRules" :counter="80"></v-text-field>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.languages" :label="$t('ads.labels.languages')" :rules="languageRules" :counter="40"></v-text-field>
                        </v-flex>
                        <v-flex xs12 class="px-1">
                            <v-select v-model="form.section_ids" :items="listeSections" :label="$t('ads.labels.section_ids')" multiple>
                                <template v-slot:prepend-item>
                                    <v-list-tile ripple @click="selectAllSections">
                                        <v-list-tile-action>
                                            <v-icon :color="form.section_ids.length > 0 ? 'indigo darken-4' : ''">{{icon}}</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>{{$t('ads.epfl_sections.all')}}</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-divider class="mt-2"></v-divider>
                                </template>
                                <template v-slot:selection="{ item, index }">
                                    <span v-if="index<3 && !(form.section_ids.length === listeSections.length) && !(index===form.section_ids.length-1)">{{ $t('ads.epfl_sections.'+item) }},&nbsp;</span>
                                    <span v-if="index<3 && !(form.section_ids.length === listeSections.length) && (index===form.section_ids.length-1)">{{ $t('ads.epfl_sections.'+item) }}&nbsp;</span>
                                    <span v-if="form.section_ids.length >2 && !(form.section_ids.length === listeSections.length) && index ===3" class="grey--text caption">(+{{ section.length - 3 }} others)</span>
                                    <span v-if="form.section_ids.length === listeSections.length && index===0">{{$t('ads.epfl_sections.all')}}</span>
                                </template>
                                  <template slot="item" slot-scope="data">
    <!-- HTML that describe how select should render items when the select is open -->
    {{ $t("ads.epfl_sections." + data.item)}} 
  </template>
                            </v-select>
                        </v-flex>
                    </v-layout>
                </v-container>
            </v-card>
            <v-card class="text-xs-left ma-4  epfl-card" flat tile >
                <div  style="width:100%; height:53px;">
                    <v-card-text>
                        <h4 >{{ $t('ads.sections.main').toUpperCase() }}</h4>
                    </v-card-text>
                </div>
                <v-container class="pa-3">
                    <v-layout row wrap>
                        <v-flex xs12 class="px-1">
                            <v-textarea v-model="form.description"  auto-grow :rules="descriptionRules" :counter="500">
                                <template v-slot:label>
                                    <div>
                                        {{ $t('ads.labels.description') +'*'}}
                                    </div>
                                </template>
                            </v-textarea>
                        </v-flex>

                    </v-layout>
                </v-container>
            </v-card>
            <v-card class="text-xs-left ma-4 align-center epfl-card" flat tile align-center>
                <div  style="width:100%; height:53px;">
                    <v-card-text>
                        <h4 >{{ $t('ads.sections.publisher').toUpperCase() }}</h4>
                    </v-card-text>
                </div>
                <v-container class="pa-3">
                    <v-layout row wrap>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.contact_first_name" :label="$t('ads.labels.contact_first_name')+'*'" :rules="baseRules" :counter="40" required></v-text-field>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.contact_last_name" :label="$t('ads.labels.contact_last_name')+'*'" :rules="baseRules" :counter="40" required></v-text-field>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.contact_email" :label="$t('ads.labels.contact_email')+'*'" :rules="emailRules" required></v-text-field>
                        </v-flex>
                        <v-flex sm6 xs12 class="px-1">
                            <v-text-field v-model="form.contact_phone" :label="$t('ads.labels.contact_phone')" :rules="phoneRules"></v-text-field>
                        </v-flex>

                    </v-layout>
                </v-container>
            </v-card>
            
            <v-container class="mx-4 mt-4 pa-0" align="left" text-xs-left>
                <v-checkbox color="#7595af" v-model="form.managed_by_je" :label="$t('ads.labels.ask_je')"></v-checkbox>
                <div>
                    <vue-recaptcha sitekey="6LfBm6MUAAAAAAdx9OqOmWNXN4bMgJlGChyVLB2X" @expired="emptyRecaptcha" @verify="setRecaptcha" ref="recaptcha"></vue-recaptcha>
                <div class="v-text-field__details" style="margin-top:8px;">
                  <div class="v-messages theme--light error--text" role="alert">
                    <div class="v-messages__wrapper">
                      <div
                        class="v-messages__message"
                        v-show="captchaAlert"
                      >Captcha is required</div>
                    </div>
                  </div>
                </div>
                </div>
                
                
            </v-container>
            
            <v-btn :disabled="!valid" @click="validate" color="secondary" depressed class="white-text">{{ $t('general.buttons.submit.new') }}</v-btn>

        </v-form>
    </v-flex>
    <v-flex xs12 md4>
        <v-card class="text-xs-left ma-4 align-center text-xs-left epfl-card" flat tile >
            <v-card-title class="pb-2">
                <h2>{{ $t('general.titles.managing') }}</h2>
            </v-card-title>
            <v-card-text v-html="$t('general.texts.rules.visibility')"></v-card-text>
            <v-card-actions>
                <v-btn class="secondary-btn-epfl" flat @click="redirect('forgotten-link')">
                    <v-icon left dark>restore</v-icon>{{ $t('general.buttons.recover') }}
                </v-btn>
            </v-card-actions>
        </v-card>
        <v-card class="text-xs-left ma-4 align-center text-xs-left epfl-card" flat tile>
            <v-card-title class="pb-2">
                <h2>{{ $t('general.titles.conditions') }}</h2>
            </v-card-title>
            <v-card-text>
                <p>
                    {{ $t('general.texts.rules.respect') }}
                </p>
                <ol>
                    <li v-html="$t('general.texts.rules.rule1')"></li>
                    <li v-html="$t('general.texts.rules.rule2')"></li>
                    <li v-html="$t('general.texts.rules.rule3')"></li>
                    <li v-html="$t('general.texts.rules.rule4')"></li>
                </ol>
            </v-card-text>
            <v-card-actions>
                <v-btn class="secondary-btn-epfl" flat  @click="redirect('help')">
                    <v-icon left dark>contact_support</v-icon>{{ $t('general.buttons.ask') }}
                </v-btn>
            </v-card-actions>
        </v-card>
            
    </v-flex>

</v-layout>
</template>

<script>
import VueRecaptcha from 'vue-recaptcha';
export default {
    components: { VueRecaptcha },
    props: ['contact'],
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
                g_recaptcha_response: '',
                managed_by_je: false,
            },

            captchaAlert:false,
            menuDateDebut: false,
            menuDateFin: false,

            arrayContact: JSON.parse(this.contact),
            valid: true,
            errore: {},
            phoneRules: [
            ],
            skillRules: [
                v => (!v || v.length <= 80) || this.$t('validation.max_80'),
                
            ],
            languageRules: [
                v => (!v || v.length <= 40) || this.$t('validation.max_40'),
                
            ],
            titleRules: [
                v => !!v || this.$t('validation.required'),
                v => (v && v.length <= 80) || this.$t('validation.max_80'),
                
            ],
            descriptionRules: [
                v => !!v || this.$t('validation.required'),
                v => (v && v.length <= 500) || this.$t('validation.max_500'),
            ],
            baseRules: [
                v => !!v || this.$t('validation.required'),
                v => (v && v.length <= 40) || this.$t('validation.max_40'),
            ],
            emailRules: [
                v => !!v || this.$t('validation.required'),
                v => /.+@.+/.test(v) || this.$t('validation.email_valid'),
            ],
            categorieRules: [
                v => !!v || this.$t('validation.required'),
            ],
            dateRules: [
                v => !!v || this.$t('validation.required')
            ],


            listeCategorie: [
                'home', 'babysitting', 'experiments', 'computer', 'office', 'flyering', 'administrative', 'studies_experiments', 'promotion', 'waiter_hospitality', 'tutoring', 'other'
            ],
            listeDuree: [
                'full_time', 'beside', 'weekends', 'holiday', 'other'
            ],
            listeSections: [
                'architecture', 'chemistry', 'cms', 'civil', 'meca', 'elec', 'humanities', 'computer', 'financial', 'management', 'mathematics', 'microengineering', 'physics', 'materials', 'environmental', 'communication'
            ],
            date: new Date().toISOString().substr(0, 10),
        };
    },
    created() {
    if(!(this.arrayContact.length===null)){
        this.form.contact_first_name = this.arrayContact.first_name;
        this.form.contact_last_name = this.arrayContact.last_name;
        this.form.contact_email = this.arrayContact.email;
    }

    },
    computed: {
        icon() {
            if (this.form.section_ids.length === this.listeSections.length) return 'cancel'
            return 'check_box_outline_blank'
        },
        buttonColor() {
            if (this.validate) {
                return "btn-epfl white-text";
            }
        }
    },
    methods: {
        emptyRecaptcha(){
            this.form.g_recaptcha_response = '';
        },
        setRecaptcha(response) {
            this.form.g_recaptcha_response=response;
            this.captchaAlert=false;
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
            if (this.$refs.form.validate() /*&& this.form.g_recaptcha_response != ''*/) {
                this.snackbar = true
                this.submit();
            }
            /* Uncomment for recaptcha activation
            else if(this.form.g_recaptcha_response == ''){
                this.captchaAlert=true;
            }*/
        },
        submit() {
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
            axios.post('/new-job', sendableForm).then(response => {
                console.log(response);
                if(response.data == 'bad-captcha'){
                    this.$root.alertType = 'error';
                    this.$root.alertMessage = 'Bad captcha, it might have expired.';
                    this.$refs.recaptcha.reset();

                } else if(response.data == 'done') {
                    this.$root.showAlert = true;
                    this.$root.alertType = 'success';
                    this.$root.alertMessage = this.$t('general.successes.adcreated');
                    setTimeout(() => {  this.$root.redirect('/'); }, 4000);
                    

                }
                else{
                    this.$root.alertType = 'error';
                    this.$root.alertMessage = "an error occured, please contact us if you did everything right.";
                }
                this.$root.showAlert = true;
            }).catch(error => {
                this.$root.alertType = 'error';
                    this.$root.alertMessage = error;
                    this.$root.showAlert;
            });
        },
    }
}
</script>

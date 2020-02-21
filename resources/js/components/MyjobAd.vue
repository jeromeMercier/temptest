<template>
    <v-layout row wrap>
        <v-flex xs12 md8 align-center class="align-center text-xs-center">
            <v-card
                class="text-xs-left ma-4 align-center epfl-card"
                align-center
                flat
                tile
            >
                <v-card-title>
                    <div>
                        <div class="headline">{{ adsArray.title }}</div>
                        <span class="grey--text"
                            >Publiée par {{ adsArray.contact_first_name }}
                            {{ adsArray.contact_last_name }}, le
                            {{ adsArray.updated_at.substring(0, 10) }}</span
                        >
                    </div>
                </v-card-title>
                <v-card-text class="pb-2"
                    ><div class="label-for-ad">
                        Description:
                    </div>
                    {{ adsArray.description }}</v-card-text
                >

                <v-card-text v-if="adsArray.skills" class="py-2"
                    ><div class="label-for-ad">
                        Compétences:
                    </div>
                    {{ adsArray.skills }}</v-card-text
                >

                <v-card-text v-if="adsArray.languages" class="py-2"
                    ><div class="label-for-ad">
                        Languages:
                    </div>
                    {{ adsArray.languages }}</v-card-text
                >

                <v-card-text v-if="adsArray.section_ids" class="py-2"
                    ><div class="label-for-ad">
                        Section:
                    </div>
                    <span
                        v-for="(section, key) in adsArray.section_ids"
                        :key="section"
                        >{{ listeSections[section]
                        }}<span v-if="key == adsArray.section_ids.length - 1"
                            >.</span
                        ><span v-else>, </span></span
                    ></v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        Durée indicative:
                    </div>
                    {{ listeDuree[adsArray.duration] }}</v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        Rémunération:
                    </div>
                    {{ adsArray.salary }}.-/h</v-card-text
                >
                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        Lieu de travail:
                    </div>
                    {{ adsArray.place }}</v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        Email:
                    </div>
                    {{ adsArray.contact_email }}</v-card-text
                >
                <v-card-text v-if="adsArray.contact_phone" class="py-2"
                    ><div class="label-for-ad">
                        Téléphone:
                    </div>
                    {{ adsArray.contact_phone }}</v-card-text
                >
            </v-card>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    props: ["ad"],
    data() {
        return {
            adsArray: JSON.parse(this.ad),
            listeDuree: [
                "Temps plein",
                "A côté des études",
                "Weekends",
                "Vacances",
                "Autre"
            ],
            listeSections: [
                "Architecture",
                "Chimie et génie chimique",
                "Cours de mathématiques spéciales",
                "EME (EPFL Middle East)",
                "Génie civil",
                "Génie mecanique",
                "Génie électrique et electronique",
                "Humanités digitales",
                "Informatique",
                "Ingénierie des sciences du vivant",
                "Ingénierie financière",
                "Management de la technologie",
                "Mathématiques",
                "Microtechnique",
                "Physique",
                "Science et génie des materiaux",
                "Science et ingénierie de l'environnement",
                "section FCUE",
                "Système de communication"
            ]
        };
    },
    filters: {
        truncate: function(text, length, suffix) {
            if (text.length > length) {
                return text.toString().substring(0, length) + suffix;
            } else {
                return text;
            }
        }
    },
    created() {
        console.log(JSON.parse(this.ad));
    },
    methods: {}
};
</script>
<style>
.label-for-ad {
    display: inline-block;
    min-width: 130px;
}
.job-card {
    border: 1px solid #e6e6e6 !important;
}
.job-card-header {
    background-color: #e6e6e6;
}

.link-trapeze-horizontal:focus:before,
.link-trapeze-horizontal:hover:before {
    border-top-width: 0.5rem;
}

.link-trapeze-horizontal:before {
    content: "";
    display: block;
    position: absolute;
    z-index: -1;
    border: 0.5rem solid transparent;
    -webkit-transition: border 0.2s;
    transition: border 0.2s;
    top: 100%;
    left: 0;
    width: 100%;
    height: 0;
    border-bottom-width: 0;
    border-top-width: 0;
    border-top-color: #d5d5d5;
}

*,
:after,
:before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
.link-trapeze-horizontal:focus,
.link-trapeze-horizontal:hover {
    -webkit-transform: translateY(-0.5rem);
    transform: translateY(-0.5rem);
}
.link-trapeze-horizontal {
    position: relative;
    z-index: 0;
    -webkit-transition: -webkit-transform 0.2s;
    transition: -webkit-transform 0.2s;
    transition: transform 0.2s;
    transition: transform 0.2s, -webkit-transform 0.2s;
}
</style>

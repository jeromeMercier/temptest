<template>
    <v-layout row wrap>
        <v-container fill-height fluid v-if="this.adsArray.data.length == 0"
            ><v-layout align-center justify-center>
                <v-card-title
                    style="font-weight:700; color:#707070; font-size:14px;"
                    >{{ $t("ads.none") }}</v-card-title
                >
            </v-layout></v-container
        >
        <v-flex xs12 md8 v-if="this.adsArray.data.length > 0" class="pa-4">
            <div v-for="(item, key) in adsArrayValidated" :key="key">
                <v-hover
                    class="link-trapeze-horizontal"
                    v-if="item.validated == '1'"
                >
                    <v-card
                        v-if="item.validated == '1'"
                        class="cursor-pointer job-card link-trapeze-horizontal epfl-card"
                        :style="adsStyle(key)"
                        flat
                        tile
                        @click="redirect('job/' + item.url)"
                    >
                        <v-tooltip bottom v-if="myjobs">
                            <template v-slot:activator="{ on }">
                                <v-icon
                                    v-on="on"
                                    style="position:absolute; top:4px; right: 4px;"
                                    color="green"
                                    >mdi-check-circle</v-icon
                                >
                            </template>
                            <span>{{ $t("general.successes.adcreated") }}</span>
                        </v-tooltip>

                        <div style="width:100%; height:53px;">
                            <v-card-title>
                                <div>
                                    <div>
                                        <h4 style="color:black;">
                                            {{ item.title }}
                                        </h4>
                                    </div>
                                    <span class="grey--text">{{
                                        item.place
                                    }}</span>
                                </div>
                            </v-card-title>
                        </div>
                        <v-card-text
                            >{{ item.description | truncate(200, "...") }}
                            <span style="font-style:italic;">{{
                                item.place
                            }}</span></v-card-text
                        >
                    </v-card>
                </v-hover>
                <div v-else>
                    <v-card class=" job-card  epfl-card" flat tile>
                        <v-tooltip bottom v-if="item.validated == null">
                            <template v-slot:activator="{ on }">
                                <v-icon
                                    v-on="on"
                                    style="position:absolute; top:4px; right: 4px;"
                                    color="orange"
                                    >mdi-circle-slice-3</v-icon
                                >
                            </template>
                            <span>{{ $t("general.texts.moderation") }}</span>
                        </v-tooltip>
                        <v-tooltip bottom v-else>
                            <template v-slot:activator="{ on }">
                                <v-icon
                                    style="position:absolute; top:4px; right: 4px;"
                                    v-on="on"
                                    color="red"
                                    >mdi-close-circle</v-icon
                                >
                            </template>
                            <span>{{ $t("general.texts.refused") }}</span>
                        </v-tooltip>

                        <div style="width:100%; height:53px;">
                            <v-card-title>
                                <div>
                                    <div>
                                        <h4 style="color:black;">
                                            {{ item.title }}
                                        </h4>
                                    </div>
                                    <span class="grey--text">{{
                                        item.place
                                    }}</span>
                                </div>
                            </v-card-title>
                        </div>
                        <v-card-text
                            >{{ item.description | truncate(60, "...") }}
                            {{ item.place }}</v-card-text
                        >
                    </v-card>
                </div>
            </div>
        </v-flex>
        <v-flex xs12 md4 class="hidden-sm-and-down">
            <v-layout row wrap>
                <v-flex xs12>
                    <v-card class="text-xs-center ma-4 epfl-card" flat tile>
                        <v-container>
                            <v-layout row wrap>
                                <v-flex xs12 lg6>
                                    <v-card flat>
                                        <img
                                            :src="'/contents/images/je.svg'"
                                            alt="Boss"
                                            width="100%"
                                            height="100%"
                                        />
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 lg6 class="text-xs-left">
                                    <v-card flat>
                                        <v-card-text class="py-0">
                                            La Coupole - CO116<br />
                                            Case Postale 50<br />
                                            CH-1015 Lausanne<br />Tel: +41 (0)
                                            21 693 20 35</v-card-text
                                        >
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-card>
                </v-flex>
            </v-layout>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    props: ["ads", "myjobs", "students", "publishers"],
    data() {
        return {
            adsArray: JSON.parse(this.ads)
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
        console.log(JSON.parse(this.ads));
    },
    methods: {
        adsStyle(key) {
            if (this.myjobs) {
                if (key == 0) {
                    return "border-bottom:0px!important;";
                } else if (key == this.adsArray.data.length - 1) {
                    return "";
                }
                return "border-bottom:1px!important;";
            } else {
                if (key == 0) {
                    return "border-bottom:0px!important;";
                } else if (key == this.adsArrayValidated.length - 1) {
                    return "";
                }
                return " border-bottom:1px!important;";
            }
        }
    },
    computed: {
        adsArrayValidated: function() {
            if (this.myjobs) {
                return this.adsArray.data;
            }
            let newArray = [];

            for (let i = 0; i < this.adsArray.data.length; i++) {
                if (this.adsArray.data[i].validated == 1) {
                    newArray.push(this.adsArray.data[i]);
                }
            }
            return newArray;
        }
    }
};
</script>
<style>
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

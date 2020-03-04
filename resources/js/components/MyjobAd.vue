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
                            >{{$t('ad.show.publisher')}} {{ adsArray.contact_first_name }}
                            {{ adsArray.contact_last_name }}, le
                            {{ adsArray.updated_at.substring(0, 10) }}</span
                        >
                    </div>
                </v-card-title>
                <v-card-text class="pb-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.description')}}:
                    </div>
                    {{ adsArray.description }}</v-card-text
                >

                <v-card-text v-if="adsArray.skills" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.skills')}}:
                    </div>
                    {{ adsArray.skills }}</v-card-text
                >

                <v-card-text v-if="adsArray.languages" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.languages')}}:
                    </div>
                    {{ adsArray.languages }}</v-card-text
                >

                <v-card-text v-if="adsArray.section_ids" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.section_ids')}}:
                    </div>
                    <span
                        v-for="(section, key) in adsArray.section_ids"
                        :key="section"
                        >{{ $t('ads.epfl_sections.'+listeSections[section])
                        }}<span v-if="key == adsArray.section_ids.length - 1"
                            >.</span
                        ><span v-else>, </span></span
                    ></v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.duration')}}:
                    </div>
                    {{ $t('ads.availability.'+listeDuree[adsArray.duration]) }}</v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.salary')}}:
                    </div>
                    {{ adsArray.salary }}.-/h</v-card-text
                >
                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.place')}}:
                    </div>
                    {{ adsArray.place }}</v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.contact_email')}}:
                    </div>
                    {{ adsArray.contact_email }}</v-card-text
                >
                <v-card-text v-if="adsArray.contact_phone" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.contact_phone')}}:
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
                'full_time', 'beside', 'weekends', 'holiday', 'other'
            ],
            listeSections: [
                'architecture', 'chemistry', 'cms', 'civil', 'meca', 'elec', 'humanities', 'computer', 'financial', 'management', 'mathematics', 'microengineering', 'physics', 'materials', 'environmental', 'communication'
            ],
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
    min-width: 155px;
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

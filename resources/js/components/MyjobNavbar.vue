<template>
<v-card flat>
    <v-toolbar color="white" height="128" class="align-center">


        <img class="myagep" :src="'/contents/images/myagep.svg'" alt="EPFL" width="120"></v-toolbar-items>


        <v-spacer></v-spacer>


        <v-toolbar-items class="hidden-sm-and-down">
            <v-btn icon @click="expand = !expand">
                <v-icon>language</v-icon>
            </v-btn>
        </v-toolbar-items>

        <v-expand-x-transition>
            <div v-show="expand" style="white-space: nowrap">
                <v-toolbar-items>
                    <v-btn flat @click="switchLanguageAndCloseExpand('en')">
                        EN
                    </v-btn>
                    <v-btn flat @click="switchLanguageAndCloseExpand('fr')">
                        FR
                    </v-btn>
                </v-toolbar-items>
            </div>
        </v-expand-x-transition>

    </v-toolbar>
    <v-layout row pb-2>
        <v-flex xs12>
            <v-card class="card--flex-toolbar" flat>
                <v-toolbar card prominent class="epfl-bg-color" dark>
                    <v-toolbar-items class="hidden-sm-and-down">
                        <v-btn v-for="(link, title) in array" v-if="!isLogin(title)" flat @click="redirect(link)" :key="title">{{$t('general.nav.' + title)}}</v-btn>
                    </v-toolbar-items>
                    <v-spacer></v-spacer>
                    <v-toolbar-items class="hidden-sm-and-down">
                        <v-btn v-for="(link, title) in array" v-if="isLogin(title)" flat @click="redirect(link)" :key="title">{{$t('general.nav.' + title)}}</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
            </v-card>
        </v-flex>
    </v-layout>
</v-card flat>
</template>

<script>
export default {
    props: ['links'],
    data() {
        return {
            expand: false,
            marker: false,
            array: JSON.parse(this.links),
        };
    },
    created() {
        console.log(this.links)
    },
    methods: {
        fetchData() {
            console.log('navbar mounted');
        },
        switchLanguageAndCloseExpand(language) {
          this.changeLocale(language);
            this.expand = false;

        },
        isLogin(value) {
            if (value == 'connect' || value == 'disconnect') {
                return true;
            } else {
                return false;
            }
        }
    }
}
</script>

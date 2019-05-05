<template>
<v-card flat>
    <v-toolbar color="white" extended>

        <v-toolbar-items>
            <img class="myagep" :src="'/contents/images/myagep.svg'" alt="Myjob">
        </v-toolbar-items>

        <v-spacer></v-spacer>

        <v-text-field class="search-text-field" append-icon="search" outline height="48px" label="Recherche" type="text" @click:append="marker = !marker"></v-text-field>

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
                <v-toolbar card prominent class="sub-navbar" dark>
                    <v-toolbar-items class="hidden-sm-and-down">
                        <v-btn flat>Link One</v-btn>
                        <v-btn flat>Link Two</v-btn>
                        <v-btn flat>Link Three</v-btn>
                    </v-toolbar-items>
                </v-toolbar>
            </v-card>
        </v-flex>
    </v-layout>
</v-card flat>
</template>

<script>
export default {
    data() {
        return {
            expand: false,
            marker: false,
        };
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            console.log('navbar mounted');
        },
        switchLanguageAndCloseExpand(language) {
            this.expand = false;
        }
    }
}
</script>

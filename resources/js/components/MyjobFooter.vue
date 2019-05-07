<template>
<v-footer height="auto" >
    <v-card class="flex" flat tile style="background-color:#FAFAFA;">
        <v-container grid-list-md text-xs-center  style="background-color:#FAFAFA;">
            <v-layout row wrap align-center>
                <v-flex md4 class="hidden-sm-and-down">
                    <img class="" :src="'/contents/images/agepinfo.svg'" alt="AGEPOLY" height="120"></v-toolbar-items>
                </v-flex>
                <v-flex md4 xs8 offset-xs2 offset-md0>
                    <v-card-text>
                        <a href="https://github.com/agepoly">AGEPINFO</a> ·
                        <a href="https://github.com/zifeo/Myjob">Sources</a><br>
                        <a href="https://github.com/timozattol">Timothée Lottaz</a> ·
                        <a href="https://github.com/zifeo">Teo Stocco</a><br>
                        <a href="https://petitesannonces.epfl.ch">Petites annonces</a> ·
                        <a href="https://polyhelp.epfl.ch">PolyHelp</a>
                    </v-card-text>
                </v-flex>
                <v-flex md4 class="hidden-sm-and-down">
                    <img :src="'/contents/images/epfl.svg'" alt="EPFL" width="120"></v-toolbar-items>
                </v-flex>
            </v-layout>
        </v-container>
    </v-card>
</v-footer>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.')
    }
}
</script>

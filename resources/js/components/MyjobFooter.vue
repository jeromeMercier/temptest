<template>
<v-footer height="auto" >
    <v-card class="flex" flat tile style="    background-color: #e6e6e6!important;">
        <v-container grid-list-md text-xs-center  style="background-color:#E6E6E6;">
            <v-layout row wrap align-center>
                <v-flex md4 class="hidden-sm-and-down">
                    <!--<img class="" :src="'/contents/images/agepinfo.svg'" alt="AGEPOLY" height="120"></v-toolbar-items>-->
                </v-flex>
                <v-flex md4 xs8 offset-xs2 offset-md0>
                    <v-card-text>
                        <a class="link-pretty" href="https://github.com/agepoly">AGEPINFO</a> ·
                        <a class="link-pretty" href="https://github.com/zifeo/Myjob">Sourcejs</a><br>
                        <a href="https://github.com/jeromemercier">Jérôme Mercier</a><br>
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
        
    }
}
</script>
<style>
a{
    text-decoration-color: red;
    color:#707070!important;
}
a:hover{
    text-decoration-color: #212121;
}
a:active{
    text-decoration-color: #212121;
}
</style>
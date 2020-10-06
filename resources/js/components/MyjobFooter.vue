<template>
<v-footer height="auto" >
    <v-card class="flex" flat tile style="    background-color: #e6e6e6!important;">
        <v-container grid-list-md text-xs-center  style="background-color:#E6E6E6;">
            <v-layout row wrap align-center>
                <v-flex xs4 class="">
                    <img :src="'/contents/images/je.svg'" alt="JE" :height="$vuetify.breakpoint.xsOnly ? '40' : '50'">
                </v-flex>
                <v-flex xs4  offset-md0>
                    <v-card-text v-if="!$vuetify.breakpoint.xsOnly ">
                        <span style="color: #707070!important;" >2020 - </span><a href="https://je.epfl.ch/">JE EPFL</a><br>
                    </v-card-text>
                     <v-card-text v-if="$vuetify.breakpoint.xsOnly ">
                        <span style="color: #707070!important;" >2020 <br></span><a href="https://je.epfl.ch/">JE EPFL</a><br>
                    </v-card-text>
                </v-flex>
                <v-flex xs4 class="">
                    <img :src="'/contents/images/epfl.svg'" alt="EPFL" :width="$vuetify.breakpoint.xsOnly ? '80' : '120'">
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
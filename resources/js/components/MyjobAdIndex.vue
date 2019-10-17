<template>
<v-layout row wrap>
    <v-flex xs12 md4 v-for="item in adsArray.data" :key="item.url" class="px-1">
        <v-hover class="link-trapeze-horizontal">
            <v-card  class="cursor-pointer job-card link-trapeze-horizontal epfl-card" flat tile  @click="redirect('job/' + item.url)">
                <div style="width:100%; height:53px;">
                    <v-card-title>
                        <div>
                        <div><h4 style="color:black;">{{item.title }}</h4></div>
                        <span class="grey--text">{{item.place}}</span>
                        </div>
                    </v-card-title>
                </div>
                <v-card-text>{{item.description | truncate(60, '...') }} {{item.place}}</v-card-text>
            </v-card>
        </v-hover>
    </v-flex>
</v-layout>
</template>

<script>
export default {
    props: ['ads'],
    data() {
        return {
            adsArray: JSON.parse(this.ads),
        };
    },
    filters: {
        truncate: function(text, length, suffix) {
          if(text.length > length){
            return text.toString().substring(0, length) + suffix;
          }
            else{
              return text;
            }
        },
    },
    created() {
        this.fetchData();
    },
    methods: {
        fetchData() {
            console.log('dick');
            console.log(this.adsArray);
        }
    }
}
</script>
<style>
.job-card{
    border: 1px solid #E6E6E6!important;
    
}
.job-card-header{
    background-color:#E6E6E6;
}

.link-trapeze-horizontal:focus:before, .link-trapeze-horizontal:hover:before {
    border-top-width: .5rem;
}

.link-trapeze-horizontal:before {
    content: "";
    display: block;
    position: absolute;
    z-index: -1;
    border: .5rem solid transparent;
    -webkit-transition: border .2s;
    transition: border .2s;
    top: 100%;
    left: 0;
    width: 100%;
    height: 0;
    border-bottom-width: 0;
    border-top-width: 0;
    border-top-color: #d5d5d5;
}

*, :after, :before {
    -webkit-box-sizing: border-box;
    box-sizing: border-box;
}
.link-trapeze-horizontal:focus, .link-trapeze-horizontal:hover {
    -webkit-transform: translateY(-.5rem);
    transform: translateY(-.5rem);
}
.link-trapeze-horizontal {
    position: relative;
    z-index: 0;
    -webkit-transition: -webkit-transform .2s;
    transition: -webkit-transform .2s;
    transition: transform .2s;
    transition: transform .2s,-webkit-transform .2s;
}
</style>

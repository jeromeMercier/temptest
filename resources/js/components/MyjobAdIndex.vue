<template>
<v-layout row wrap>
    <v-flex xs12 md4 v-for="item in adsArray.data" :key="item.url" class="px-1">
        <v-hover>
            <v-card slot-scope="{ hover }" :class="`elevation-${hover ? 12 : 2}` + ' cursor-pointer'" @click="redirect('job/' + item.url)">
                <div class="agep-bg-color" style="width:100%; height:53px;">
                    <v-card-text>
                        <h4 style="color:white;">{{item.title }}</h4>
                    </v-card-text>
                </div>
                  <v-card-text>{{item.description | truncate(60, '...') }}</v-card-text>
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
            console.log(' mounted');
        }
    }
}
</script>

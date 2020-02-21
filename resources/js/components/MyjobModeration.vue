<template>
  <v-layout v-on:keyup.ctrl.right="accept(0)" >
    <v-flex xs12 md6 lg5 v-on:keyup.ctrl.left="refuse(0)">
      <v-layout>
        <template v-for="(item, i) in adsArray">
          <v-flex xs12 v-if="activeIndex(i)" :key="i" class="pa-1">
            <v-card class="job-card epfl-card" flat tile @click="currentIndex = i">
              <v-card-text>
                <v-text-field v-model="item.title" :label="$t('ads.labels.title')" autofocus></v-text-field>
                <v-text-field v-model="item.place" :label="$t('ads.labels.place')"></v-text-field>

                <v-textarea v-model="item.description" color="teal" auto-grow :counter="500" >
                  <template v-slot:label>
                    <div>{{ $t('ads.labels.description')}}</div>
                  </template>
                </v-textarea>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn outlined flat color="red"@click="refuse(i)">refuse</v-btn>
                <v-btn outlined flat color="green" @click="accept(i)" >accept</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </template>
      </v-layout>
    </v-flex>
    <v-flex xs12 md6 lg7>
        <v-layout>
      <template v-for="(item, i) in adsArray">
        <v-flex xs12 md4 class="pa-1" :key="i" v-if="!activeIndex(i)">
          <v-hover class="link-trapeze-horizontal">
            <v-card
              class="cursor-pointer job-card link-trapeze-horizontal epfl-card"
              flat
              tile
              @click="currentIndex = i"
            >
              <div style="width:100%; height:53px;">
                <v-card-title>
                  <div>
                    <div>
                      <h4 style="color:black;">{{item.title }}</h4>
                    </div>
                    <span class="grey--text">{{item.place}}</span>
                  </div>
                </v-card-title>
              </div>
              <v-card-text>{{item.description | truncate(60, '...') }}</v-card-text>
            </v-card>
          </v-hover>
        </v-flex>
      </template>
      </v-layout>
    </v-flex>
  </v-layout>
</template>
      </v-flex>
    
  </v-layout>
</template>

<script>
export default {
  props: ["ads"],
  data() {
    return {
      adsArray: JSON.parse(this.ads),
      currentIndex: 0
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
    this.fetchData();
  },
  methods: {
    fetchData() {
      
    },
    activeIndex(val) {
      if (this.currentIndex == val) {
        return true;
      }
    },
    accept(index){
        this.adsArray[index]["validated"]=true;
        this.adsArray[index]["validated_at"]=Date.now();
        axios.post('/update-job/'  + this.adsArray[index]["url"] + '/' + 1, this.adsArray[index]).then(function (response) {});
        
        this.adsArray.shift();
    },
    refuse(index){
        this.adsArray[index]["validated"]=true;
        this.adsArray[index]["validated_at"]=Date.now();
        axios.post('/update-job/'  + this.adsArray[index]["url"] + '/' + 0, this.adsArray[index]).then(function (response) {});
       
        this.adsArray.shift();
;    }
  }
};
</script>
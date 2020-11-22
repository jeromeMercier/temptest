<template>
  <v-layout v-on:keyup.ctrl.right="accept(0)" row wrap>
    <v-flex xs12 md6 lg5 v-on:keyup.ctrl.left="refuse(0)">
      <v-layout row wrap>
        <template v-for="(item, i) in adsArray">
          <v-flex xs12 v-if="activeIndex(i)" :key="i" >
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
              <v-card-text v-if="item.skills" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.skills')}}:
                    </div>
                    {{ adsArray.skills }}</v-card-text
                >

                <v-card-text v-if="item.languages" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.languages')}}:
                    </div>
                    {{ adsArray.languages }}</v-card-text
                >

                <v-card-text v-if="item.section_ids" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.general.section_ids')}}:
                    </div>
                    <span
                        v-for="(section, key) in item.section_ids"
                        :key="section"
                        >{{ $t('ads.epfl_sections.'+listeSections[section])
                        }}<span v-if="key == item.section_ids.length - 1"
                            >.</span
                        ><span v-else>, </span></span
                    ></v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.duration')}}:
                    </div>
                    {{ listeDuree[item.duration] }}</v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.salary')}}:
                    </div>
                    {{ item.salary }}.-/h</v-card-text
                >

                <v-card-text class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.contact_email')}}:
                    </div>
                    {{ item.contact_email }}</v-card-text
                >
                <v-card-text v-if="adsArray.contact_phone" class="py-2"
                    ><div class="label-for-ad">
                        {{$t('ads.labels.contact_phone')}}:
                    </div>
                    {{ item.contact_phone }}</v-card-text
                >
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn outlined flat color="red"@click="refuse(i)">{{$t('general.buttons.refuse')}}</v-btn>
                <v-btn outlined flat color="green" @click="accept(i)" >{{$t('general.buttons.accept')}}</v-btn>
              </v-card-actions>
            </v-card>
          </v-flex>
        </template>
      </v-layout>
    </v-flex>
    <v-flex xs12 md6 lg7>
        <v-layout row wrap>
      <template v-for="(item, i) in adsArray">
        <v-flex xs12 md4  :key="i" v-if="!activeIndex(i)">
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
      currentIndex: 0,
      listeDuree: [
                "Temps plein",
                "A côté des études",
                "Weekends",
                "Vacances",
                "Autre"
            ],
            listeSections: [
                "Architecture",
                "Chimie et génie chimique",
                "Cours de mathématiques spéciales",
                "EME (EPFL Middle East)",
                "Génie civil",
                "Génie mecanique",
                "Génie électrique et electronique",
                "Humanités digitales",
                "Informatique",
                "Ingénierie des sciences du vivant",
                "Ingénierie financière",
                "Management de la technologie",
                "Mathématiques",
                "Microtechnique",
                "Physique",
                "Science et génie des materiaux",
                "Science et ingénierie de l'environnement",
                "section FCUE",
                "Système de communication"
            ]
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
    console.log(JSON.parse(this.ads)[0]);
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
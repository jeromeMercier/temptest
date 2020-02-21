<template>
  <div>
    <v-navigation-drawer v-model="drawer" absolute temporary>
      <v-list class="pt-0 navbar-links drawer-links" dense justify-start>
        <v-list-tile
          v-for="(link, title) in array"
          v-if="!isLogin(title)"
          :key="title"
          @click="redirect(link)"
        >
          <v-list-tile-action>{{$t('general.nav.' + title)}}</v-list-tile-action>
        </v-list-tile>
        <v-list-tile
          v-for="(link, title) in array"
          v-if="isLogin(title)"
          :key="title"
          @click="redirect(link)"
        >
          <v-list-tile-action>{{$t('general.nav.' + title)}}</v-list-tile-action>
        </v-list-tile>
        <div class="drawer-close-button">
          <v-btn icon flat :ripple="false" @click="drawer = !drawer">
            <v-icon>close</v-icon>
          </v-btn>
        </div>
      </v-list>
      <v-divider></v-divider>
      <v-toolbar-items class="laguage-items mt-3 ml-3" >
        <v-btn
          :ripple="false"
          flat
          @click="switchLanguageAndCloseExpand('en')"
          :class="languageButtonClass('en')"
        >EN</v-btn>
        <div class="bar"></div>
        <v-btn
          :ripple="false"
          flat
          @click="switchLanguageAndCloseExpand('fr')"
          :class="languageButtonClass('fr') +  ' second-button '    "
        >FR</v-btn>
      </v-toolbar-items>
    </v-navigation-drawer>

    <v-card flat>
      <v-toolbar flat color="white" height="128" class="align-left">
        <img :src="'/contents/images/epfl.svg'" style="padding-left:16px;" alt="EPFL" width="160" />

        <v-spacer></v-spacer>

        <v-toolbar-items class="hidden-md-and-up language-items pr-3">
          <v-icon @click="drawer = !drawer">menu</v-icon>
        </v-toolbar-items>
        <v-toolbar-items class="laguage-items hidden-sm-and-down">
          <v-btn
            :ripple="false"
            flat
            @click="switchLanguageAndCloseExpand('en')"
            :class="languageButtonClass('en')"
          >EN</v-btn>
          <div class="bar"></div>
          <v-btn
            :ripple="false"
            flat
            @click="switchLanguageAndCloseExpand('fr')"
            :class="languageButtonClass('fr') +  ' second-button '    "
          >FR</v-btn>
        </v-toolbar-items>
      </v-toolbar>
      <v-layout row pb-2 class="hidden-sm-and-down">
        <v-flex xs12>
          <v-card class="card--flex-toolbar" flat>
            <v-toolbar card prominent class="navbar-links">
              <v-toolbar-items class="hidden-sm-and-down">
                <v-btn
                  v-for="(link, title) in array"
                  :ripple="false"
                  v-if="!isLogin(title)"
                  flat
                  @click="redirect(link)"
                  :key="title"
                  :class="navbarLinkClass(link)"
                >{{$t('general.nav.' + title)}}</v-btn>
              </v-toolbar-items>
              <v-spacer></v-spacer>

              <v-toolbar-items class="hidden-sm-and-down">
                <v-btn
                  v-for="(link, title) in array"
                  :ripple="false"
                  v-if="isLogin(title)"
                  flat
                  @click="redirect(link)"
                  :key="title"
                  navbar-link
                  :class="navbarLinkClass(link)"
                >{{$t('general.nav.' + title)}}</v-btn>
              </v-toolbar-items>
            </v-toolbar>
          </v-card>
        </v-flex>
      </v-layout>
      <v-divider></v-divider>
    </v-card>
  </div>
</template>

<script>
export default {
  props: ["links"],
  data() {
    return {
      expand: false,
      marker: false,
      array: JSON.parse(this.links),
      drawer: false
    };
  },
  created() {
    
  },
  methods: {
    fetchData() {
      
    },
    switchLanguageAndCloseExpand(language) {
      this.changeLocale(language);
      this.expand = false;
    },
    languageButtonClass(locale) {
      if (locale == this.$i18n.locale) {
        return "language-button-active";
      } else {
        return "language-button";
      }
    },
    isLogin(value) {
      if (value == "connect" || value == "disconnect") {
        return true;
      } else {
        return false;
      }
    },
    navbarLinkClass(link) {
      if (link == window.location.pathname) {
        return "navbar-link navbar-link-active";
      } else {
        return "navbar-link";
      }
    }
  }
};
</script>
<style>
.bar {
  content: " ";
  display: block;
  margin-top: 0.3rem;
  width: 1px;
  height: 0.9rem;
  background: #d5d5d5 !important;
}
.navbar-link-active {
  color: red !important;
}
.navbar-link-active:after {
  content: " ";
  display: block;
  position: absolute;
  top: 1em;
  left: 0.8rem;
  width: 7px;
  height: 6px;
  background: red !important;
  -webkit-transform: none;
  transform: none;
  -webkit-transition: opacity 0.3s;
  transition: opacity 0.3s;
}
.drawer-links {
  top: 0.3em !important;
}

.language-button {
  width: 24px;
  padding: 4px;
  font-weight: 700;
  font-size: 1rem;
  min-width: 24px;
  padding: 0px;
  color: #adb5bd !important;
}
.language-button:hover {
  color: black !important;
}
.language-button-active {
  width: 24px;
  padding: 4px;
  font-weight: 700;
  font-size: 1rem;
  min-width: 24px;
  padding: 0px;
  color: red !important;
}
.laguage-items {
  height: auto;
  margin-right: 16px !important;
}
.navbar-link {
  font-weight: 700;
}
.navbar-link:hover {
  color: red !important;
}
.navbar-link:hover:after {
  content: " ";
  display: block;
  position: absolute;
  top: 1em;
  left: 0.8rem;
  width: 7px;
  height: 6px;
  background: red !important;
  -webkit-transform: none;
  transform: none;
  -webkit-transition: opacity 0.3s;
  transition: opacity 0.3s;
}
.language-button:hover:before {
  background-color: white !important;
}
.navbar-links {
  background-color: white !important;
}
.v-divider {
  border: 0.5px solid #d5d5d5 !important;
}
.current-item {
  color: red;
}
.current-item:after {
  content: " ";
  display: block;
  position: absolute;
  top: 1em;
  left: 0.8rem;
  width: 7px;
  height: 6px;
  background: red !important;
  -webkit-transform: none;
  transform: none;
  -webkit-transition: opacity 0.3s;
  transition: opacity 0.3s;
}
.v-btn:before {
  width: 0;
}
.drawer-close-button {
  position: fixed;
  top: 0px;
  right: 0px;
}
</style>
<style scoped>
.v-navigation-drawer > .v-list .v-list__tile {
  padding: 0px !important;
}
.v-btn {
  min-width: 0px !important;
}
</style>
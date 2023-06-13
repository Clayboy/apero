import Vue from 'vue'

import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { faSyncAlt} from '@fortawesome/pro-regular-svg-icons'
import { faCloudDrizzle, faThunderstorm, faCloudSun, faCloudSunRain, faCloudShowers, faCloudShowersHeavy, faCloudSnow, faFog, faSunHaze, faSunDust, faSun, faMoon, faTornado, faCloudMoonRain, faCloud, faClouds, faCloudMoon } from "@fortawesome/pro-light-svg-icons";

library.add({
    faSyncAlt,
    faThunderstorm,
    faCloudDrizzle,
    faCloudSunRain,
    faCloudMoonRain,
    faCloudShowers,
    faCloudShowersHeavy,
    faCloudSnow,
    faFog,
    faSunHaze,
    faSunDust,
    faTornado,
    faSun,
    faMoon,
    faCloudSun,
    faCloudMoon,
    faCloud,
    faClouds
});

Vue.component('font-awesome-icon', FontAwesomeIcon)

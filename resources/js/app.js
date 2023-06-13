/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import WeatherWidget from './components/WeatherWidget.vue';
import TimeWidget from './components/TimeWidget.vue';
import { createApp } from 'vue'

const app = createApp({
    el : '#app',
    data(){
        return {
            lat : window.lat,
            lng : window.lng,
            geocoder : null,
            address : null,
        }
    },
    components : {
        WeatherWidget,
        TimeWidget
    },

    created(){
        console.log("ici");
        navigator.geolocation.getCurrentPosition(this.updatePosition);
    },

    methods: {
        updatePosition(position){
            this.lat = position.coords.latitude;
            this.lng = position.coords.longitude;
            // this.updateLocation();
        },

        // updateLocation() {
        //     var latlng = new google.maps.LatLng(this.lat, this.lng);

        //     this.geocoder.geocode({'latLng': latlng}, (results, status) => {
        //         console.log(results);
        //         if (status == google.maps.GeocoderStatus.OK) {
        //             this.address = results[1].formatted_address;
        //         }
        //     });
        // }
    }
}).mount('#app')

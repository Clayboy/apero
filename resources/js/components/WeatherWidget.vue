<template>

    <div class="text-white mx-2 px-4 md:px-8 py-4 rounded shadow mb-4 relative black-transparent">
        <a href="#" class="absolute top-0 right-0 p-2" @click="refresh">
            <font-awesome-icon :icon="['far', 'sync-alt']" :spin="loading"></font-awesome-icon>
        </a>
        <div class="flex item-center justify-around mb-4 leading-none">
            <p class="mx-3">
                <font-awesome-icon :icon="['fal', icon]" class="text-6xl md:text-7xl"></font-awesome-icon>
            </p>
            <p class="text-6xl md:text-7xl lg:text-8xl mx-3">
                {{weather.temperature}}°C
            </p>
        </div>

        <div class="text-sm sm:text-xs lg:text-base w-full justify-around flex item-center mb-4">
            <p>
                Humidité : {{weather.humidity}}%
            </p>
            <p>
                Vent : {{weather.wind.speed}} Km/h
            </p>
            <p>
                Pression : {{weather.pressure}} hPa.
            </p>
        </div>
        <p class="text-xs text-right">
            {{weather.city}}
        </p>
    </div>

</template>

<script>


import weatherIcons from "../weatherIcons"


export default {
    props : {
        data : {
            type : [Object, Array],
        },
        lat : {
            type : Number,
        },
        lng : {
            type : Number,
        }
    },

    data(){
        return {
            weather : this.data,
            loading : false,
            coords : {
                lat : this.lat,
                lng : this.lng,
            }
        }
    },

    watch : {
        lat(val, oldVal){
            if(val != oldVal){
                this.coords.lat = val;
                this.refresh();
            }
        },
        lng(val, oldVal){
            if(val != oldVal){
                this.coords.lng = val;
                this.refresh();
            }
        }
    },

    computed:{
        icon () {
            return weatherIcons[this.weather.iconId];
        }
    },

    methods : {
        refresh(){
            if(this.coords.lat != undefined && this.coords.lng != undefined){
                this.loading = true;
                axios.get(`/weather/${this.coords.lat}/${this.coords.lng}`)
                    .then(({data}) => {
                        this.weather = data,
                        this.loading = false;
                    })
            }
        }
    }
}
</script>

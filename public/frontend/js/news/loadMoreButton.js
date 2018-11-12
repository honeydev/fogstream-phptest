import Vue from 'vue';
import eventBus from '../eventBus';
import Axios from "axios";

export const loadMoreButton = Vue.component('loadmorebutton', {
    template: `
         <div  v-if="hasNextPage" class="container loadmorebuttonContainer">
             <div class="row">
                <div class="col-12 text-center">
                    <button v-on:click="clickButton()" class="btn btn-primary">Update profile</button>
                </div>
             </div>
         </div>
    `,
    data() {
        return {
            hasNextPage: true
        }
    },
    created() {
        this.setEventsListerners();
    },
    methods: {
        clickButton() {
            eventBus.eventBus.$emit('click-load-more-button');
        },
        setEventsListerners() {
            eventBus.eventBus.$on('next-page-is-empty', () => {
                this.hasNextPage = false;
            });
        }
    }
});

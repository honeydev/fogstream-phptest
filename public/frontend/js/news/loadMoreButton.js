import Vue from 'vue';
import eventBus from '../eventBus';

export const loadMoreButton = Vue.component('loadmorebutton', {
    template: `
         <div class="container">
             <div class="row">
                <div class="col-12 text-center">
                    <button v-on:click="clickButton()" class="btn btn-primary">Update profile</button>
                </div>
             </div>
         </div>
    `,
    methods: {
        clickButton() {
            eventBus.eventBus.$emit('click-load-more-button');
        }
    }
});


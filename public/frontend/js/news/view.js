import Vue from 'vue';
import Axios from 'axios';


Vue.component('container', {

    template: `
        <div class="container">
            <div class="row">
                <row v-for="row in news"></row>
            </div>
        </div>
    `,
    data() {
        let news = {};

        for (let i = 0; i < 12; i = i + 3) {
            let row = {};

            for (let y = 0; y < 3; y++) {
                row[y] = {
                    header: 'header',
                    date: 'date',
                    id: 0
                }
            }
            news[i] = row;
        }
        console.log(news)
        return {news: news};
    }
});

Vue.component('row', {
    template: `
        <div class="row">
            <news v-for="news in row"></news>
        </div>
    `
});

Vue.component('news', {
    template: `
        <div class="col-3 offset-1">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src=".../100px180/" alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
    `
})

const news = new Vue({
    el: "#news"
});

export default news;
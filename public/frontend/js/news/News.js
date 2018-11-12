'use strict';

import Vue from 'vue';
import Axios from 'axios';
import NewsFormater from './NewsFormater';
import eventBus from '../eventBus';
import loadMoreButton from './loadMoreButton';

const newsFormater = new NewsFormater();

Vue.component('newslist', {
    template: `
        <div class="container">
            <div class="col-12">
            <div class="row" v-for="row in news" >
                <news 
                v-for="(concretNews, index) in row"
                    v-bind:title="concretNews.title"
                    v-bind:body="concretNews.body"
                    v-bind:url="concretNews.url"
                    v-bind:created="concretNews.created"
                    v-bind:author="concretNews.author"
                    v-bind:preview="concretNews.preview"
                    v-bind:even="isEvenNews(index)"
                ></news>
            </div>
            </div>
        </div>
    `,
    data() {
        return {
            pagination: [],
            news: []
        }
    },
    created() {
        Axios.get('/api/news/get?page=1').then((response) => {
            this.pagination = response.data;
            this.setNews(this.pagination.data.data);
            this.checkNextPage();
        });
        this.setEventsListerners();
    },
    methods: {
        setNews(news) {
            this.news = this.formatNews(news);
        },
        addNews(news) {
            const formated = this.formatNews(news);

            for (let index in formated) {
                this.news.push(formated[index]);
            }
        },
        nextPage() {
            Axios.get(this.pagination.next_page_url).then((response) => {
                this.pagination = response.data;
                setNews();
            });
        },
        formatNews(news) {
            return newsFormater.format(news);
        },
        isEvenNews(index) {
            return index % 2 === 0;
        },
        checkNextPage() {
          if (this.pagination.next_page_url === null) {
              eventBus.eventBus.$emit('next-page-is-empty');
          }
        },
        setEventsListerners() {
            eventBus.eventBus.$on('click-load-more-button', () => {
                Axios.get(this.pagination.next_page_url).then((response) => {
                    this.pagination = response.data;
                    this.addNews(this.pagination.data.data);
                    this.checkNextPage();
                });
            });
        }
    }
});

Vue.component('news', {
    template: `
        <div class=" d-flex flex-column border rounded  newsPreview col-5"  v-bind:class="{'ml-auto mr-4': even, 'mr-auto mr-4': !even }">
            <h5>{{ title }}</h5>
            <img v-if="preview !== undefined" v-bind:src="preview.url" class="frontpagePreview">
            <p>{{ body }}</p>
            <div class="mt-auto">
                <ul class="list-unstyled list-inline ">
                    <li>Author: {{ author.name }}</li>
                    <li>Created: {{ created.formated }}</li>
                </ul>
                <a v-bind:href="url" class="btn btn-primary">Read More</a>
             </div>
        </div>
        </div>
    `,
    props: ['title', 'body', 'created', 'author', 'preview', 'url', 'even'],
});

const news = new Vue({
    el: "#news",
    components: {loadMoreButton: loadMoreButton},
});

export default news;

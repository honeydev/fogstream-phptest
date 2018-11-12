'use strict';

import moment from 'moment';

class NewsFormater {
    /**
     * @param {array} news
     * @return {array}
     */
    format(news) {
        let formatedNews = this.formatTime(news);
        formatedNews = this.sliceBody(news);
        formatedNews = this.zipInRows(formatedNews);
        return formatedNews;
    }
    /**
     *
     * @param {array} news
     * @return {array}
     */
    formatTime(news) {
        return news.map((news) => {
            news.created.formated = moment(news.created.date).format('Do MMMM YYYY');
            return news;
        });
    }
    /**
     *
     * @param news
     * @returns {array}
     */
    sliceBody(news) {
        return news.map((news) => {
            news.body = news.body.slice(0, 300);
            return news;
        });
    }
    /**
     * @param {array} news
     * @return {array}
     */
    zipInRows(news) {
        let rows = [];
        for (let i = 0; i < news.length; i += 2) {
            let row = [];
            let current = news[i];
            let next = news[i+1];
            row.push(current);
            if (next !== undefined) {
                row.push(next);
            }
            rows.push(row);
        }
        return rows;
    }
}

export default NewsFormater;

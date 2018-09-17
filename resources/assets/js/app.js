
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

// Vue.component('example-component', require('./components/ExampleComponent.vue'));

const app = new Vue({
    el: '#app',
    data: {
        editedItem: {
            product_name: '',
            quantity_in_stock: '',
            price_per_item: ''
        },
        defaultItem: {
            product_name: '',
            quantity_in_stock: '',
            price_per_item: ''
        },
        editedIndex: -1,
        stocks: []
    },
    created () {
        axios.get('/stocks')
            .then(( { data } ) => {
                this.stocks = data
            })
    },

    computed: {
        totalValueNumber () {
            let totals = 0
            if (this.stocks.length > 0) {
                this.stocks.forEach(element => {
                    totals += element.total_value_number
                })
                return totals
            }
            return totals
        }
    },

    methods: {
        submit () {
            if (this.editedIndex > -1) {
                axios.patch('/stock/' + this.editedItem.id, this.editedItem)
                    .then(( { data } ) => {
                        this.stocks = data
                    })
                    .catch(( { response } ) => {
                        if (response.status === 422) {
                            for (let error in response.data.errors) {
                                alert(response.data.errors[error][0])
                            }
                        }
                    })
            } else {
                axios.post('/stock', this.editedItem)
                    .then(( { data } ) => {
                        this.stocks = data
                    })
                    .catch(( { response } ) => {
                        if (response.status === 422) {
                            for (let error in response.data.errors) {
                                alert(response.data.errors[error][0])
                            }
                        }
                    })
            }
            this.close()
        },

        edit (item) {
            this.editedItem = item
            this.editedIndex = this.stocks.indexOf(item)
        },

        close () {
            this.dialog = false
            setTimeout(() => {
                this.editedItem = Object.assign({}, this.defaultItem)
                this.editedIndex = -1
            }, 300)
        },
    }
});

import Vue from 'vue'
import Vuex from 'vuex'
import axios from 'axios'
Vue.use(Vuex)

export default new Vuex.Store({
    state:{
        arrayProducts:[],
        productsCart :[],
        cartLenght : 0,
        total:0
    },
    getters:{
        getterAllProducts(state){
            return state.arrayProducts
        },
        getterProductsCart(state){
            return state.productsCart
        },
        getterCartLenght(state){
            return state.cartLenght
        },
        getterPrice(state){
            return state.total
        }
    },
    mutations:{
        arrayProducts(state,data){
            return state.arrayProducts = data
        },
        arrayCart(state,data){
            return state.productsCart = data
        },
        lenghtArray(state,data){
            return state.cartLenght = data
        },
        calculPrice(state,data){
            let array = state.productsCart = data
            state.total = 0
            array.forEach(element => {

                return state.total += (element.quantity * element.product.price)
            });
        }
    },
    actions:{
        allProducts({commit}){
            axios.get("/api/products")
                .then(response =>{
                    commit('arrayProducts',response.data)
                })
        },
        productsInCart({commit}){
            axios.get("/api/cart")
                .then(response =>{
                    commit('arrayCart',response.data)
                    commit('lenghtArray',response.data.length)
                    commit('calculPrice',response.data)
                })
        },
        addToCart({commit ,dispatch},btnValue){
            axios.post('/api/cart',{product_id:btnValue})
                .then(() =>{
                    dispatch('productsInCart')
                })
        },
        emptyCart({commit ,dispatch}){
            axios.delete('/api/cart')
                .then(() =>{
                    dispatch('productsInCart')
                })
        },
        deleteCart({commit ,dispatch},product_id){
            axios.delete('/api/cart/'+product_id)
                .then(() =>{
                    dispatch('productsInCart')
                })
        }
    },
})
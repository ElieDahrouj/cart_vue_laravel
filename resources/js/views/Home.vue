<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-dark">
            <div class=" navbar-collapse" id="navbarSupportedContent">
                <div class="navbar-nav d-flex justify-content-between align-items-center col-12 p-0 backgr">
                    <div>
                        <b class="text-white">Vue Shopping Cart</b>
                    </div>
                    <div class="d-flex ">
                        <div class="mr-3 d-flex align-items-center">
                            <p class="m-0 text-white mr-2">{{getterCartLenght}} items in Cart </p>
                            <p class="m-0 text-white">({{getterPrice}} €)</p>
                        </div>
                        <b class="text-white">Deku</b>
                    </div>
                </div>
            </div>
        </nav>
        <div class="container d-flex justify-content-between align-items-baseline mt-3">
            <div class="card custom mr-4">
                <div class="card-header">
                    <b>Products</b>
                </div>
               <div class="grid">
                   <div v-for="product in getterAllProducts" :key="product.id" class="card my-4 mx-2" style="width: 18rem;">
                       <div class="card-body">
                           <h5 class="card-title">{{product.name}}</h5>
                           <h6 class="card-subtitle mb-2 text-muted">Price: {{product.price}} €</h6>
                           <p class="card-text">{{product.description}}</p>
                           <button @click="addToCart(product.id)" class="btn btn-success">Add to cart</button>
                       </div>
                   </div>
               </div>
            </div>
            <div class="card cartCustom">
                <h5 class="card-header">Cart</h5>
                <ul v-if="getterProductsCart.length !== 0" class="list-group list-group-flush">
                    <li v-for="pdtCart in getterProductsCart" :key="pdtCart.id" class="list-group-item">
                        <p class="d-flex justify-content-between align-items-center m-0">
                            <span>{{pdtCart.quantity}} x</span> {{pdtCart.product.name}} <b>{{pdtCart.product.price}} €</b>
                            <button class="btn btn-danger" @click="deleteCart(pdtCart.product_id)">Remove</button>
                        </p>
                    </li>
                    <li class="list-group-item">
                        <button @click="emptyCart" class="btn btn-danger w-100">Remove all products</button>
                    </li>
                </ul>
                <div v-else class="alert alert-info m-3" role="alert">
                    Panier vide
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import {mapActions, mapGetters} from 'vuex'
    export default {
        name:'Home',
        computed:{
            ...mapGetters(['getterAllProducts','getterProductsCart','getterCartLenght','getterPrice'])
        },
        methods:{
            ...mapActions(['allProducts','productsInCart','addToCart','emptyCart','deleteCart'])
        },
        mounted(){
            this.allProducts()
            this.productsInCart()
        }
    }
</script>
<style lang="scss" scoped>
    .grid{
        display: grid;
        grid-gap: 30px;
        justify-content: center;
        grid-template-columns: repeat(auto-fit, 300px);
    }
    .custom{
        width: 75%;
    }
    .cartCustom{
        width: 30%;
    }
</style>
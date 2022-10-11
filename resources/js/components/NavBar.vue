<template>
    <div>
        <b-contanier fluid="lg">
            <b-navbar type="dark" variant="dark">
                <b-navbar-nav class="row">
                    <b-nav-item class="col-lg-10">
                        <router-link :to="{name: 'home'}" class="nav-items">
                            home
                        </router-link>
                    </b-nav-item>
                    <b-nav-item class="ml-auto col-lg-1">
                        <router-link :to="{name: 'login'}" v-if="!$store.getters.GET_AUTH_ID" class="nav-items">
                            login
                        </router-link>
                    </b-nav-item>
                    <b-nav-item href="#" class=" col-lg-1" v-if="!$store.getters.GET_AUTH_ID">
                        <router-link :to="{name: 'signUp'}" class="nav-items">
                            signUp
                        </router-link>
                    </b-nav-item>
                    <b-nav-item href="#" class="ml-auto col-lg-1" v-if="$store.getters.GET_AUTH_ID">
                        <b-button @click="logout">logout</b-button>
                    </b-nav-item>
                </b-navbar-nav>
            </b-navbar>
        </b-contanier>
    </div>
</template>

<script>
export default {
    name: "NavBar",

    methods: {
        logout() {
            this.$store.dispatch('logout')
            .then(response=> {
                this.$router.push({name:'logout'})
            })
        }
    }
}
</script>

<style lang="scss">
.nav-items{
    color: white;
    text-decoration: none !important;
    &:hover {
        color: #adb5bd !important;
    }
}

.navbar-nav{
    width: 100% !important;
}
.col-lg-1{
    width: 5.333333% !important;
}
</style>

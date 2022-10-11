<template>
        <b-container>

            <b-form  @submit.stop.prevent="loginUser" class="w-50 ms-auto me-auto">
                <b-alert v-if="error" class="mt-5" show variant="danger">{{errorMessage}}</b-alert>
                <label for="feedback-user">User ID</label>
                <b-form-input v-model="email" id="feedback-user"></b-form-input>
                <b-form-invalid-feedback :state="validEmail">
                    Your user ID must be 5-12 characters long.
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="validEmail">
                    Looks Good.
                </b-form-valid-feedback>
                <label for="text-password">Password</label>
                <b-form-input type="password" v-model="password"  id="text-password" aria-describedby="password-help-block"></b-form-input>
                <b-form-invalid-feedback :state="validPassword">
                    Your user ID must be 5-12 characters long.
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="validPassword">
                    Looks Good.
                </b-form-valid-feedback>
                <b-button type="submit"  class="mt-2" variant="success">Button</b-button>
            </b-form>

        </b-container>
</template>

<script>
import { mapActions } from 'vuex'
export default {
    name: "login",
    data() {
        return {
            email: '',
            password: '',
            validEmail:'',
            validPassword:'',
            error:false,
            errorMessage:''
        }
    },
    watch: {
        email() {
            this.error = false
                this.validEmail = this.email.length > 4
        },

        password(){
            this.error = false
            this.validPassword = this.password.length > 4 && this.password.length < 20
        }
    },

    methods:{

         loginUser(){
             let data = {
                 email: this.email,
                 password:this.password
             }
             this.$store.dispatch('login', data)
                .then(response=> {
                    if (response) {
                        this.$router.push({name:'home'})
                    }else{
                        this.error = true
                        this.errorMessage = 'Invalid  email'
                    }
                })

        }
    }
}
</script>

<style scoped>

</style>

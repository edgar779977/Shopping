<template>
    <b-container>
        <b-form  @submit.stop.prevent="signUp" class="w-50 ms-auto me-auto">
            <label for="name-user">Name</label>
            <b-form-input type="text" v-model="name" id="name-user"></b-form-input>
            <b-form-invalid-feedback  type="text":state="validName">
               The filed is required...
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="validName === true">
                Looks Good.
            </b-form-valid-feedback>
            <label for="last_name">Last Name</label>
            <b-form-input v-model="lastName" id="last_name"></b-form-input>
            <div class="text-danger mt-3"
                 v-if="errorMessage.last_name"
            >
                {{errorMessage.last_name[0]}}
            </div>
            <b-form-valid-feedback v-if="!errorMessage.last_name" :state="validPassword === true">
                Looks Good.
            </b-form-valid-feedback>
            <label for="feedback-user">Email</label>
            <b-form-input  type="email" v-model="email" id="feedback-user"></b-form-input>
            <div class="text-danger mt-3" v-if="errorMessage.email">
                {{errorMessage.email[0]}}
            </div>
            <b-form-valid-feedback :state="validEmail === true">
                Looks Good.
            </b-form-valid-feedback>
            <label for="text-password">Password</label>
            <b-form-input type="password" v-model="password"  id="text-password" aria-describedby="password-help-block"></b-form-input>
            <b-form-invalid-feedback :state="validPassword">
                Your user ID must be 5-12 characters long.
            </b-form-invalid-feedback>
            <b-form-valid-feedback :state="validPassword === true">
                Looks Good.
            </b-form-valid-feedback>
            <div v-if="password">
                <label for="passwordConfirm">Confirm Password</label>
                <b-form-input type="password" v-model="passwordConfirm"  id="passwordConfirm" aria-describedby="password-help-block"></b-form-input>
                <b-form-invalid-feedback :state="validPasswordConfirm">
                    your password confirmation must be same as password
                </b-form-invalid-feedback>
                <b-form-valid-feedback :state="validPasswordConfirm === true">
                    Looks Good.
                </b-form-valid-feedback>
            </div>
            <b-button type="submit"  class="mt-2" variant="success">Button</b-button>
        </b-form>

    </b-container>
</template>

<script>
import router from "../Router";

export default {
    name: "signUp",
    data() {
        return {
            name:null,
            lastName:null,
            email: null,
            password: null,
            validName:null,
            passwordConfirm:null,
            validLastName:'',
            validEmail:'',
            validPassword:'',
            validPasswordConfirm:'',
            error:false,
            errorMessage:[]
        }
    },
    watch: {
        // name() {
        //     this.error = false
        //     this.validName = this.name !== ''
        // },
        //
        // lastName() {
        //     this.error = false
        //     this.validLastName =  this.lastName !== ''
        // },
        //
        lastName(val){
           if(this.errorMessage.last_name){
               console.log(999)
               if(val){
                   delete this.errorMessage.last_name
               }
           }
        },

        email(val){

           if(this.errorMessage.email){
               console.log(999)
               if(val){
                   delete this.errorMessage.email
               }
           }else{
               this.error = false
               this.validEmail = this.email.length > 4
           }
        },


        password(){
            this.error = false
            this.validPassword = this.password.length > 4 && this.password.length < 20
        },

        passwordConfirm(){
            this.error = false
            this.validPasswordConfirm = (this.password  === this.passwordConfirm) && this.passwordConfirm !== ''
        }
    },

    methods:{
        signUp(){
            let data = {
                first_name:this.name,
                last_name:this.lastName,
                email: this.email,
                password:this.password,
                passwordConfirm:this.passwordConfirm
            }


            axios.post('api/signUp', data).then(response=>{
                if (response.status === 201 && response.data.success){
                    this.$router.push({ path: '/login' })
                }
            }).catch(err=>{
                console.log(err.response.data.errors,9999)
                this.error =true
                this.errorMessage = err.response.data.errors
                console.log(err.response.data.message)
            })
            console.log()
        }
    }
}
</script>

<style scoped>

</style>

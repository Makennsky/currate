<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-5" >
                <div class="border m-5 p-5">
                    <h6>Auth</h6>
                    <form @submit.prevent="login">
                        <input id="email" type="text" v-model="email" placeholder="E-mail" class="form-control mt-2">
                        <input id="password" type="password" v-model="password" placeholder="Password" class="form-control mt-2">
                        <button class="btn btn-sm btn-primary mt-2 text-white px-4">Log In</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                email: '',
                password: '',
            }
        },
        methods: {
            async login () {
                let auth = await this.$store.dispatch('getToken', {
                    email: this.email,
                    password: this.password
                })
                console.log(auth)
                if(auth){
                    this.$router.push('/main-rates')
                }
            },
            logout() {
                return this.$store.dispatch('logout', {

                })
            }
        },
        created() {
            console.log('msin rates')
        }
    }
</script>

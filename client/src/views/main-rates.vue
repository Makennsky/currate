<template>
    <div>
        <div v-for="(item, index) in rates" :key="index" class="rate-card">
            <h3>{{ item.pair }}</h3>
            <p>{{ item.value }}</p>
            <router-link :to="`/pair/${item.pair}`">history</router-link>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        data: () => ({
            rates: []
        }),
        name: "main-rates",
        async created() {
            console.log('msin rates')
            let token = this.$cookies.get('auth')
            if(!token){
                this.$router.push('/')
            }
            let auth = await axios.post('http://api.techgarden.tk/api/log_check', {token: token})
            if(!auth.data.status){
                this.$cookies.remove('auth')
                this.$router.push('/')
            }

            let mainRates = await axios.get("http://api.techgarden.tk/api/main_rates").then(result => result.data).catch(error => {
                console.log("http://api.techgarden.tk/api/main_rates", error);
                return false;
            })
            console.log(mainRates)
            this.rates = mainRates
        }
    }
</script>

<style scoped>
.rate-card{
    padding: 16px;
    border-radius: 8px;
    margin: 16px;
    box-shadow: 0 10px 20px rgba(0,0,0,0.19), 0 6px 6px rgba(0,0,0,0.23);
}
</style>

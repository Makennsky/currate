<template>
    <div>
        <h3>{{ $route.params.id}}</h3>
        <div v-for="(item, index) in pair" :key="index" class="rate-card">

            <h3> курс: {{ item.value }}</h3>
            <p> дата обновления: {{item.created_at}}</p>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: "pair",
        data: () => ({
            pair: []
        }),
        async created() {
            let token = this.$cookies.get('auth')
            if(!token){
                this.$router.push('/')
            }
            let auth = await axios.post('', {token: token})
            if(!auth.data.status){
                this.$cookies.remove('auth')
                this.$router.push('/')
            }

            console.log(this.$route.params.id)
            let http = await axios.post("http://127.0.0.1:8000/api/rate_history", {pair: this.$route.params.id})
            console.log(http)
            this.pair = http.data
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

<template>
    <div class="container" v-if="isLoggedIn">
        <div class="row">
            <div class="col-12">
                <h6>защищенная страница, только авторизация</h6>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        computed : {
            isLoggedIn () { return this.$store.getters.isLogged}
        },
    }
</script>

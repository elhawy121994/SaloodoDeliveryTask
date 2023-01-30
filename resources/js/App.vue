<template>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="collapse navbar-collapse">
                <div class="navbar-nav">
                   <h1> <router-link to="/" class="nav-item nav-link">Saloodo</router-link></h1>
                </div>
            </div>
        </nav>
        <router-view></router-view>
    </div>
</template>

<script>
export default {
    data: {
        senderToken: ''
    },
    computed() {
        this.isSender = function () {
            JSON.parse(localStorage.getItem('senderToken'));
        };
        this.isBikerUser = function () {
            JSON.parse(localStorage.getItem('bikerToken'));
        };
    }
};
</script>

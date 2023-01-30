<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <br>
                <div class="row">
                    <button type="button" class="btn btn-success btn-lg btn-block">
                        <router-link to="/senders/login" class="nav-item nav-link">Login As Sender</router-link>
                    </button>
                </div>
                <br>
                <div class="row">
                    <button type="button" class="btn btn-primary btn-lg btn-block">
                        <router-link to="/bikers/login" class="nav-item nav-link">Login As Bikers</router-link>
                    </button>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
export default {
    mounted() {
        console.log('Component mounted.');
    }
};
</script>

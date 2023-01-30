<template>
    <div class="container">
        <div class="btn-group" role="group">
            <router-link :to="{name: 'senderParcels'}" class="btn btn-danger">Go To Parcels </router-link>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ parcel.name }}</div>

                    <div class="card-body">
                       <span> Status:  </span> <label>{{ parcel.status }}</label> <hr>
                       <span> created at:  </span> <label>{{ parcel.created_at }}</label> <hr>
                       <span> pick_up_address:  </span> <label>{{ parcel.pick_up_address }}</label> <hr>
                       <span> pick_up_address:  </span> <label>{{ parcel.drop_off_address }}</label> <hr>
                        <span> Details:  </span> <label>{{ parcel.details }}</label> <hr>
                        <span> Note:  </span> <label>{{ parcel.notes }}</label>

                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import authHeader from "./AuthHeaderLogin";

export default {
    data() {
        return {
            parcel: {}
        }
    },
    mounted() {
        this.axios
            .get(`http://localhost:8000/api/v1/senders/parcels/${this.$route.params.id}`, {headers: authHeader('Sender')})
            .then(response => {
                this.parcel = response.data;
            })
            .catch(err => console.log(err))
            .finally(() => this.loading = false);
    },
};
</script>

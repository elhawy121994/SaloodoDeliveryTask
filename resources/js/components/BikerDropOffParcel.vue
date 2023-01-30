<template>
    <div>
        <h3 class="text-center">Create Parcel</h3>
        <div class="row">
            <div class="col-md-4">
                <form @submit.prevent="pickParcel">
                    <div class="form-group">
                        <label>Time</label>
                        <datetime format="YYYY-MM-DD H:i:s" width="300px" v-model="delivered_at"></datetime>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-success">Drop Off</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
import authHeader from "./AuthHeaderLogin";
import datetime from 'vuejs-datetimepicker';
export default {
    components: { datetime },
    data() {
        return {
            delivered_at: ''
        };
    },
    methods: {
        pickParcel() {
            this.axios
                .patch(`http://127.0.0.1:8000/api/v1/bikers/parcels/drop-off/${this.$route.params.id}`, {"delivered_at": this.delivered_at},
                    {headers: authHeader('Biker')})
                .then(response => (
                    this.$router.push({name: 'bikerParcels'})
                ))
                .catch(err => console.log(err))
                .finally(() => this.loading = false);
        }
    }
};
</script>

<template>

  <div>
      <div class="btn-group" role="group">
          <router-link :to="{name: 'bikerParcels'}" class="btn btn-danger">Go To Pick Up </router-link>
      </div>
    <h2 class="text-center">Parcels List For Drop Off</h2>

    <table class="table">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Sender</th>
        <th>Drop Off Address</th>
        <th>Drop Off Details</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="parcel in parcels" :key="parcel.id">
        <td>{{ parcel.id }}</td>
        <td>{{ parcel.name }}</td>
        <td>{{ parcel.sender.name }}</td>
        <td>{{ parcel.drop_off_address }}</td>
        <td>
          <div class="btn-group" role="group">
            <router-link :to="{name: 'bikerDropOffParcel', params: { id: parcel.id }}" class="btn btn-success">Details</router-link>
          </div>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>

import authHeader from './AuthHeaderLogin';
export default {
  data() {
    return {
      parcels: []
    }
  },
  created() {
    this.axios
        .get('http://127.0.0.1:8000/api/v1/bikers/parcels/drop-off', { headers: authHeader('Biker') })
        .then(response => {
          this.parcels = response.data.data;
          console.log(this.parcels)
        }).catch(err => console.log(err))
        .finally(() => this.loading = false)
  },
}
</script>

<template>
  <div>
      <div class="btn-group" role="group">
          <router-link :to="{name: 'createParcel'}" class="btn btn-danger">Go To Create Parcel </router-link>
      </div>
      <br>
    <h2 class="text-center">Parcels List</h2>

    <table class="table">
      <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Status</th>
        <th>Detail</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="parcel in parcels" :key="parcel.id">
        <td>{{ parcel.id }}</td>
        <td>{{ parcel.name }}</td>
        <td>{{ parcel.status }}</td>
        <td>
          <div class="btn-group" role="group">
            <router-link :to="{name: 'parcelSenderDetails', params: { id: parcel.id }}" class="btn btn-success">Details</router-link>
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
        .get('http://127.0.0.1:8000/api/v1/senders/parcels', { headers: authHeader('Sender') })
        .then(response => {
          this.parcels = response.data;
          console.log(this.parcels)
        }).catch(err => console.log(err))
        .finally(() => this.loading = false)
  },
}
</script>

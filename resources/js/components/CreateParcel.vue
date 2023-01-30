<template>
  <div>
    <h3 class="text-center">Create Parcel</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="addProduct">
          <div class="form-group">
            <label>Name</label>
            <input type="text" class="form-control" v-model="product.name">
          </div>
            <br>
          <div class="form-group">
            <label>Pick Up Address</label>
            <input type="text" class="form-control" v-model="product.pick_up_address">
          </div>
            <br>

            <div class="form-group">
            <label>Drop Off Up Address</label>
            <input type="text" class="form-control" v-model="product.drop_off_address">
          </div>
            <br>

          <button type="submit" class="btn btn-primary">Create</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import authHeader from "./AuthHeaderLogin";

export default {
  data() {
    return {
      product: {}
    }
  },
  methods: {
    addProduct() {
      this.axios
          .post('http://127.0.0.1:8000/api/v1/parcels', this.product,{ headers: authHeader('Sender')})
          .then(response => (
              this.$router.push({ name: 'senderParcels' })
          ))
          .catch(err => console.log(err))
          .finally(() => this.loading = false)
    }
  }
}
</script>

<template>
  <div>
    <h3 class="text-center">Senders Login</h3>
    <div class="row">
      <div class="col-md-6">
        <form @submit.prevent="login">
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" v-model="email">
          </div>
          <div class="form-group">
            <label>Password</label>
            <input type="password" class="form-control" v-model="password">
          </div>
            <br>
          <button type="submit" class="btn btn-success">Login</button>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data: () => {
    return {
      email: "",
      password: "",
    };
  },
  methods: {
    login() {
      this.axios
          .post('http://localhost:8000/api/auth/login', {'email': this.email, "password": this.password})
          .then(response => {
            if (response.data.access_token && response.data.type === "Sender") {
              localStorage.setItem('senderToken', JSON.stringify(response.data.access_token));
                this.$router.push({ name: 'senderParcels' });
            }
          })
          .catch(err => console.log(err))
          .finally(() => this.loading = false)
    },
    logout() {
      localStorage.removeItem('senderToken');
    }
  }
}
</script>

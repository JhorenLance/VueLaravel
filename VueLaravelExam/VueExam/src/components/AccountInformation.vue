<template>
  <form @submit.prevent="nextStep">
    <div>
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" v-model="form.first_name" required />
    </div>
    <div>
      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" v-model="form.last_name" required />
    </div>
    <div>
      <label for="email">Email Address</label>
      <input type="email" id="email" v-model="form.email" required />
    </div>
    <div>
      <label for="username">Username</label>
      <input type="text" id="username" v-model="form.username" required />
    </div>
    <div>
      <label for="password">Password</label>
      <input type="password" id="password" v-model="form.password" required />
    </div>
    <div>
      <label for="password_confirmation">Confirm Password</label>
      <input
        type="password"
        id="password_confirmation"
        v-model="form.password_confirmation"
        required
      />
    </div>
    <div>
      <label for="type">Type of Participation</label>
      <select id="type" v-model="form.type" required>
        <option value="Buyer">Buyer</option>
        <option value="Exhibitor">Exhibitor</option>
        <option value="Visitor">Visitor</option>
      </select>
    </div>
    <button type="submit">Next</button>
  </form>
</template>

<script>
export default {
  data() {
    return {
      form: {
        first_name: "",
        last_name: "",
        email: "",
        username: "",
        password: "",
        password_confirmation: "",
        type: "",
      },
    };
  },
  methods: {
    nextStep() {
      this.$emit("next-step", this.form);
    },
  },
};
</script>

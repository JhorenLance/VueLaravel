<template>
  <div>
    <h2>Step 3: Review & Confirm</h2>

    <h3>Account Information</h3>
    <ul>
      <li><strong>First Name:</strong> {{ form.first_name }}</li>
      <li><strong>Last Name:</strong> {{ form.last_name }}</li>
      <li><strong>Email:</strong> {{ form.email }}</li>
      <li><strong>Username:</strong> {{ form.username }}</li>
      <li><strong>Type:</strong> {{ form.type }}</li>
    </ul>

    <h3>Company Information</h3>
    <ul>
      <li><strong>Company Name:</strong> {{ form.company_name }}</li>
      <li><strong>Address Line:</strong> {{ form.address_line }}</li>
      <li><strong>Town/City:</strong> {{ form.town_city }}</li>
      <li><strong>Region/State:</strong> {{ form.region_state }}</li>
      <li><strong>Country:</strong> {{ form.country }}</li>
      <li><strong>Year Established:</strong> {{ form.year_established }}</li>
      <li><strong>Website:</strong> {{ form.website || "N/A" }}</li>
      <li>
        <strong>Brochure:</strong>
        <span v-if="form.brochure">{{ form.brochure.name }}</span>
        <span v-else>N/A</span>
      </li>
    </ul>

    <button @click="$emit('go-back')">Back</button>
    <button @click="$emit('submit')">Submit Registration</button>
  </div>
</template>

<script>
export default {
  props: {
    modelValue: {
      type: Object,
      required: true,
    },
  },
  computed: {
    form() {
      return this.modelValue;
    },
  },
};
</script>

<style scoped>
h2 {
  margin-bottom: 20px;
}
ul {
  list-style: none;
  padding: 0;
  margin-bottom: 20px;
}
li {
  margin-bottom: 10px;
}
button {
  margin-right: 10px;
  padding: 10px 20px;
}
</style>

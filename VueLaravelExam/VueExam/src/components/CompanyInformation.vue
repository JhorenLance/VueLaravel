<template>
  <form @submit.prevent="handleNext">
    <input
      type="text"
      v-model="form.company_name"
      placeholder="Company Name"
      required
    />
    <input
      type="text"
      v-model="form.address_line"
      placeholder="Address Line"
      required
    />
    <input
      type="text"
      v-model="form.town_city"
      placeholder="Town/City"
      required
    />
    <input
      type="text"
      v-model="form.region_state"
      placeholder="Region/State"
      required
    />

    <select v-model="form.country" required>
      <option disabled value="">Select Country</option>
      <option v-for="country in countries" :key="country" :value="country">
        {{ country }}
      </option>
    </select>

    <input
      type="number"
      v-model="form.year_established"
      placeholder="Year Established"
      required
    />
    <input type="url" v-model="form.website" placeholder="Website (optional)" />
    <input type="file" @change="handleFile" accept=".pdf,.doc,.docx" />

    <button @click.prevent="$emit('go-back')">Back</button>
    <button type="submit">Next</button>
  </form>
</template>

<script>
export default {
  props: ["modelValue"],
  emits: ["update:modelValue", "next-step", "go-back"],
  data() {
    return {
      countries: ["Philippines", "USA", "Japan", "Germany"],
      form: this.modelValue,
    };
  },
  methods: {
    handleFile(event) {
      this.form.brochure = event.target.files[0];
    },
    handleNext() {
      this.$emit("next-step", this.form);
    },
  },
  watch: {
    form: {
      deep: true,
      handler(newVal) {
        this.$emit("update:modelValue", newVal);
      },
    },
  },
};
</script>

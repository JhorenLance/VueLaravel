<script setup>
import { RouterLink, RouterView } from "vue-router";
import HelloWorld from "./components/HelloWorld.vue";
</script>

<template>
  <div class="container">
    <h1>Manila FAME Registration</h1>
    <component
      :is="currentComponent"
      v-model="form"
      @next-step="handleNext"
      @go-back="handleBack"
      @submit="handleSubmit"
    />

    <p v-if="message" style="color: green">{{ message }}</p>
  </div>
</template>

<script>
import AccountInformation from "./components/AccountInformation.vue";
import CompanyInformation from "./components/CompanyInformation.vue";
import RegistrationSummary from "./components/RegistrationSummary.vue";

export default {
  components: {
    AccountInformation,
    CompanyInformation,
    RegistrationSummary,
  },
  data() {
    return {
      step: 1,
      message: "",
      form: {
        // Step 1
        first_name: "",
        last_name: "",
        email: "",
        username: "",
        password: "",
        password_confirmation: "",
        type: "",
        // Step 2
        company_name: "",
        address_line: "",
        town_city: "",
        region_state: "",
        country: "",
        year_established: "",
        website: "",
        brochure: null,
      },
    };
  },
  computed: {
    currentComponent() {
      if (this.step === 1) return "AccountInformation";
      if (this.step === 2) return "CompanyInformation";
      return "RegistrationSummary";
    },
  },
  methods: {
    handleNext(updatedForm) {
      this.form = { ...this.form, ...updatedForm };
      this.step++;
    },
    handleBack() {
      this.step--;
    },
    async handleSubmit() {
      const formData = new FormData();
      for (const key in this.form) {
        if (this.form[key]) {
          formData.append(key, this.form[key]);
        }
      }

      try {
        const res = await fetch("http://127.0.0.1:8000/api/register", {
          method: "POST",
          body: formData,
        });

        const data = await res.json();

        if (res.ok) {
          this.message = data.message;
          this.step = 1;
          this.resetForm();
        } else {
          alert(JSON.stringify(data.errors));
        }
      } catch (err) {
        alert("Error submitting registration.");
        console.error(err);
      }
    },
    resetForm() {
      this.form = {
        first_name: "",
        last_name: "",
        email: "",
        username: "",
        password: "",
        password_confirmation: "",
        type: "",
        company_name: "",
        address_line: "",
        town_city: "",
        region_state: "",
        country: "",
        year_established: "",
        website: "",
        brochure: null,
      };
    },
  },
};
</script>

<style>
.container {
  max-width: 600px;
  margin: 50px auto;
  font-family: Arial, sans-serif;
}
input,
select {
  display: block;
  margin-bottom: 15px;
  padding: 10px;
  width: 100%;
}
button {
  padding: 10px 20px;
  margin: 5px;
}
</style>

<style scoped>
header {
  line-height: 1.5;
  max-height: 100vh;
}

.logo {
  display: block;
  margin: 0 auto 2rem;
}

nav {
  width: 100%;
  font-size: 12px;
  text-align: center;
  margin-top: 2rem;
}

nav a.router-link-exact-active {
  color: var(--color-text);
}

nav a.router-link-exact-active:hover {
  background-color: transparent;
}

nav a {
  display: inline-block;
  padding: 0 1rem;
  border-left: 1px solid var(--color-border);
}

nav a:first-of-type {
  border: 0;
}

@media (min-width: 1024px) {
  header {
    display: flex;
    place-items: center;
    padding-right: calc(var(--section-gap) / 2);
  }

  .logo {
    margin: 0 2rem 0 0;
  }

  header .wrapper {
    display: flex;
    place-items: flex-start;
    flex-wrap: wrap;
  }

  nav {
    text-align: left;
    margin-left: -1rem;
    font-size: 1rem;

    padding: 1rem 0;
    margin-top: 1rem;
  }
}
</style>

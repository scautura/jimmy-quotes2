<template>
<div>
  <b-navbar toggleable="lg" type="dark" variant="dark">
    <b-navbar-brand href="/">{{ title }} Quotes</b-navbar-brand>
    <random></random>
    <b-navbar-nav class="ml-auto">
      <b-nav-form>
        <b-input-group>
          <b-form-input id="filter" :value="filter" @update="filterMessages" placeholder="Type to Filter"></b-form-input>
          <b-input-group-append>
            <b-button :disabled="!filter" @click="clearFilter">Clear</b-button>
          </b-input-group-append>
        </b-input-group>
      </b-nav-form>
    </b-navbar-nav>
  </b-navbar>
</div>
</template>

<script>
module.exports = {
  props: {
    title: String
  },
  data: function () {
    return {
      filter: ''
    }
  },
  methods: {
    clearFilter() {
      this.filter = '';
      this.$store.commit('updateFilter', '');
    },
    filterMessages(filter) {
      this.filter = filter;
      this.$store.commit('updateFilter', filter);
    }
  },
};
</script>

<style>
</style>

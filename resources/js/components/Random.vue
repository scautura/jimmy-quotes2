<template>
<div>
  <b-navbar-nav>
    <b-nav-item @click="loadRandomQuote()">Random Quote <b-spinner small v-show="loading"></b-spinner></b-nav-item>
  </b-navbar-nav>
  <b-modal ref="random-quote" id="random-quote" title="Random Quote" ok-only>
    <p>{{ quote.text }}</p>
  </b-modal>
</div>
</template>

<script>


module.exports = {
  data() {
    return {
      quote: {
        id: 0,
        added_by: 0,
        author_id: 0,
        author_name: "None.",
        text: "None"
      },
      loading: false
    };
  },
  props: {
    text: String
  },
  methods: {
    loadRandomQuote () {
      this.loading = true;
      window.axios.get("/api/quotes/random").then(({ data }) => {
        console.log(data);
        this.$refs['random-quote'].show();
        this.loading = false;
      })
    }
  }
}
</script>

<style>
</style>

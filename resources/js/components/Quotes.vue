<template>
<div>
  <b-table striped hover :items="quotes" :fields="fields" :per-page="perPage" :current-page="currentPage" :filter="filter" @filtered="onFiltered"></b-table>
  <b-pagination align="center" :total-rows="totalRows" :per-page="perPage" v-model="currentPage"></b-pagination>
</div>
</template>

<script>
function Quote({ added_by, author_id, author_name, text }, id) {
  this.id = id;
  this.added_by = added_by;
  this.author_id = author_id;
  this.author_name = author_name;
  this.text = text;
}

module.exports = {
  data() {
    return {
      quotes: [],
      fields: [
        {
          key: "id",
          sortable: true
        },
        {
          key: "author_name",
          sortable: true
        },
        {
          key: "text",
          sortable: false
        }
      ],
      perPage: 25,
      currentPage: 1,
      totalRows: 0,
    };
  },
  computed: {
    filter () {
      return this.$store.state.filter;
    }
  },
  methods: {
    read() {
      this.mute = true;
      window.axios.get("/api/quotes").then(({ data }) => {
        data.forEach(quote => {
          this.quotes.push(new Quote(quote, this.quotes.length + 1));
        });
        this.mute = false;
        this.totalRows = this.quotes.length;
      });
    },
    onFiltered(filteredItems) {
      this.totalRows = filteredItems.length;
      this.currentPage = 1;
    },
    clearFilter() {
        this.filter = '';
    },
    filterMessages(filter) {
        this.filter = filter;
        this.$store.commit('updateFilter', filter);
    }
  },
  created() {
    this.read();
  },
};
</script>

<style>
</style>

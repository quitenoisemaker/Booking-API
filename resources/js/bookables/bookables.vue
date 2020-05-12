<template>
    <div>

        <div v-if="loading">Data is loading...</div> 
        <div v-else>
            <div class="row mb-4" v-for="row in rows" :key="'row' + row">
                <div class="col d-flex align-items-stretch" v-for="(bookable, column) in bookableInRows(row)" :key="'row' + row + column"> 
                    <bookable-list-item  :title="bookable.title" :description="bookable.description" :price="3000" ></bookable-list-item>
                </div>
                <div class="col" v-for="p in placeholderInRow(row)" :key="'placeholder' + row + p"></div>
            </div>
            
           </div>
    </div>
</template>


<script>

  import bookableListItem from '../bookables/bookableListItem.vue';
  

export default {

   components: {
    'bookable-list-item': bookableListItem,
    
  },
 
  data () {
    return {
        bookables: null,
         loading: false,
         columns: 3
    }
  },
  computed: {
      rows() {
          return this.bookables == null ? 0 : Math.ceil(this.bookables.length / this.columns);
      }
  },
  methods: {
      bookableInRows(row) {
          return this.bookables.slice((row - 1) * this.columns, row * this.columns);
      },
      placeholderInRow(row) {
          return this.columns - this.bookableInRows(row).length;
      }
  },
//   beforeCreate() {
//       console.log("before created");
//   },

  created() {
      this.loading =true;

      const p = new Promise((resolve, reject) => {
          console.log(resolve);
          console.log(reject);
          setTimeout(() => reject("Hello"), 3000);
      })

    //   .then(result => "Hello again " + result)
    //   .then(result => console.log(result))
    //   .catch(result => console.log(`Error ${result}`));
    //    console.log(p);


       const request = axios.get("/api/bookables").then(response => {
           this.bookables = response.data;
           this.loading = false;
       });

  }

};
</script>
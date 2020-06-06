<<template>
    <div class="row">
        <div class="col-md-8 p-2">
            <div class="card">
                <div class="card-body">
                    <div v-if="loading">
                        Loading...
                    </div>
                    <div v-else>
                        
                        <h1>{{bookable.title}}</h1>
                        <hr/>
                        <article>{{bookable.description}}</article>
                    </div>
                  
                </div>
            </div>
            <review-list :bookable-id="this.$route.params.id"></review-list>
        </div>
        <div class="col-md-4 p-2">
            <availability :bookable-id="this.$route.params.id"></availability>
        </div>
    </div>
</template>

<script>

//import the component
  import availability from '../bookable/availability.vue';
  import reviewList from '../bookable/reviewList.vue';

export default {

     components: {
    'availability': availability,
    'review-list': reviewList,
    
  },
    data() {
        return {
            bookable: null,
            loading: false
        };
    },

    created() {

        this.loading=true;
        axios.get(`/api/bookables/${this.$route.params.id}`)
        .then(response=> {this.bookable = response.data.data;   // here we are assigning the response to bookable which is "null" in the data
        //data here are 2 because the first is the actual axios data and the other is the Json property
        this.loading=false;
        });
    },
}
</script>
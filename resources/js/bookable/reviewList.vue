<<template>
    <div>
        <h6 class="text-uppercase text-secondary font-weight-bolder pt-3">Review List</h6>

        <div v-if="loading">
            Loading...
        </div>

        <div v-else>
             <div class="border-bottom" v-for="(review, index) in reviews" :key="index">
            <div class="row pt-4">
                <div class="col-md-6">Samson Ojugo</div>
                <div class="col-md-6 d-flex justify-content-end">
                    <star-rating :value="review.rating"></star-rating>
                </div>
            </div>
            <div class="row">
                 <div class="col-md-12">{{review.created_at | fromNow}}</div> <!--here we use the filter "fromNow" to read the created_at-->
            </div>
            <div class="row pt-3 pb-3">
                <div class="col-md-12">{{review.content}}</div>
            </div>
        </div>
        </div>

       
    </div>
</template>

<script>
// import moment from "moment"; // importing the moment library

export default {

     props: {bookableId: [String, Number]},

    data() {
        return {
            loading: false,
            reviews: null
        }
    },
    created() {
        this.loading=true;
        axios.get(`/api/bookables/${this.bookableId}/reviews`)
        .then(response => (this.reviews = response.data.data))
        .then(() => (this.loading = false));
    },

    // filters: {

    //     fromNow(value) {
    //         return moment(value).fromNow();
    //     }

    // }
};
</script>
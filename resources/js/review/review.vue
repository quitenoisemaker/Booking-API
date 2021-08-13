<template>
    <div>
        <success v-if="success">
            You've left a review
        </success>
      <fatal-error v-if="error"></fatal-error>
        <div class="row" v-if="!success && !error"> 
             <div :class="[{'col-md-4': twoColumns}, {'d-none': oneColumns}]">
            <div class="card">
                <div class="card-body">
                    <div v-if="loading">Loading...</div>
                    <div v-if="hasBooking">
                        <p>Stayed at <router-link :to="{name: 'bookable', params: { id: booking.bookable.bookable_id}}">{{booking.bookable.title}}</router-link></p>

                        <p>You stayed from {{booking.from}} to {{booking.to}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div :class="[{'col-md-8': twoColumns}, {'col-md-12': oneColumns}]">
            <div v-if="loading">
            Loading...
        </div>
        <div v-else>
        <div v-if="alreadyReviewed">
            <h4>You have already made a review</h4>
        </div>
        <div v-else>
            <div class="form-group">
            <label class="text-muted">Select the star rating (1 is worst - 5 is best)</label>
            <star-rating class="fa-3x" v-model="review.rating"></star-rating> 
            <!--Here the child component was rendered and v-model was use to determine the star rating  -->
        </div>
        <div class="form-group">
            <label for="content" class="text-muted">Describe your experience with</label>
            <textarea name="content" cols="30" rows="10" class="form-control" v-model="review.content"
            :class="[{'is-invalid': errorFor('content')}]"
            ></textarea>

             <v-errors :errors="errorFor('content')"></v-errors>
        </div>
        <button class="btn btn-lg btn-primary btn-block" @click.prevent="submit" :disabled="sending">Submit</button>
        </div>
        </div>
        </div>
        </div>
       
        
        
        
    </div>
</template>

<script>
import {is404, is422} from "./../shared/utilities/response";
import validationErrors from "./../shared/mixins/validationErrors";
export default {

    mixins: [validationErrors],

    data() {
        return {
            review: {
                id: null,
                rating: 5,
                content: null
            },

            existingReview: null,
            loading: false,
            booking: null,
            error: false,
            sending: false,
            success: false
        }
    },
    // methods: {
    //     onRatingChanged(rating) {
    //         console.log(rating);
    //     }
    // },

    async created() {// adding async at the start because we want to use the async syntax

        this.review.id = this.$route.params.id; 

        this.loading=true;

        //here using the Async await syntax
            try{
        this.existingReview = (await axios.get(`/api/reviews/${this.review.id}`)).data.data;
        } catch (err) {

        
            if (is404(err)) {

                 try {
                this.booking =( await axios.get(`/api/booking-by-review/${this.review.id}`)).data.data;
            } catch (err) {
                 if ( !is404(err)) {

                        this.error = true; 
                        }
            }
                
            }else{
                this.error =true;
            }
        }
        this.loading = false;
        //end here

// using the then and catch syntax
        // axios.get(`/api/reviews/${this.review.id}`)
        // .then((response) => (this.existingReview=response.data.data))
        // .catch(err => {
        //     if (is404(err)) {

        //         // fetch booking by review key
        //         return axios.get(`/api/booking-by-review/${this.review.id}`)
        //         .then(response => {
        //             this.booking = response.data.data;
        //         })
        //         .catch(err => {
        //             if ( !is404(err)) {

        //                 this.error = true; 
        //                 }
        //         });
        //     }

        //     this.error = true;
        // })
        // .then(() =>(this.loading=false));
    },

    computed: {
        alreadyReviewed() {
            return this.hasReview || !this.booking;
        },
        hasReview() {
            return this.existingReview !== null; //when there is a review this function will be true (that is there is data in the existingReview)
        },
        hasBooking() {
            return this.booking !== null; //when there is a booking this function will be true (that is there is data in the booking)
        },
        oneColumns() {
            return !this.loading && this.alreadyReviewed;
        },
        twoColumns() {
            return this.loading || !this.alreadyReviewed;
        }
    },
    methods: {
        submit() {
            this.errors= null;
            this.sending = true;
            this.success =false;
            
            axios.post(`/api/reviews`, this.review)
            .then(response => {

                this.success=201 === response.status;
            })
            .catch(err => { if (is422(err)){
                const errors = err.response.data.errors;
                if (errors ["content"] && 1 === _.size(errors)){
                    
                    this.errors =errors;

                    return;
                }
                }
                this.error =true;
            })
            .then(() => (this.sending = false));
        },

      
    },
}
</script>
 <<template>
     <div>
         <h6 class="text-uppercase text-secondary font-weight-bolder">Check Availabilty

         <span v-if="noAvailability" class="text-danger">(NOT AVAILABLE)</span>
         <span v-if="hasAvailability" class="text-success">(AVAILABLE)</span>
         </h6>
         
         <div class="form-row">
             <div class="form-group col-md-6">
                 <label for="from">From</label>
                 <input type="text" name="from" class="form-control form-control-sm" placeholder="Start date" v-model="from" @keyup.enter="check" 
                  :class="[{'is-invalid': this.errorFor('from')}]"/>
                   <!-- binding with a classname is-invalid and it implement when it has the method "errorFor" with field "from" -->
                   <div class="invalid-feedback" v-for="(error, index) in this.errorFor('from')" :key="'from' + index">
                       {{error}}
                   </div>
             </div>
             <div class="form-group col-md-6">
                 <label for="to">To</label>
                    <!-- @keyup.enter tells enable us to press the enter key on d keyboard if we decide to ignore the check button -->
                 <input type="text" name="to" class="form-control form-control-sm" placeholder="End date" v-model="to" @keyup.enter="check" 
                 :class="[{'is-invalid': this.errorFor('to')}]"/>
                  <!-- binding with a classname is-invalid and it implement when it has the method "errorFor" with field "to" -->

                  <div class="invalid-feedback" v-for="(error, index) in this.errorFor('to')" :key="'to' + index">
                      {{error}}
                   </div>
             </div>
         </div>

         <button class="btn btn-outline-secondary btn-block" @click="check" :disabled="loading">Check!</button>
     </div>
 </template>

 <script>
import bookableVue from './bookable.vue';
 export default {

    props: {bookableId: String},
     data() {
         return {
             from: null,
             to: null,
             loading: false,
             status: null,
             error: null
         }
     },

     methods: {
         check() {
             this.loading=true;
             this.error = null;

             axios.get(
                 `/api/bookables/${this.bookableId}/availability?from=${this.from}&to=${this.to}`
             ).then(response => {
                 this.status = response.status;
             })
             .catch( error => {
                 if(422 === error.response.status){ //422 when something is actually wrong
                     this.error = error.response.data.errors;
                 }
                 this.status = error.response.status; // 400 this will handle when there is no availability
             })
             .then(() =>(this.loading = false)); // it doesn't matter if it fails or not it will make the loading false
         },

         errorFor(field) {
             return this.hasErrors && this.error[field] ? this.error[field] : null; //methods that will return errors for a specific field
         }
     },
     computed: {
         hasErrors() {
             return 422 ===this.status && this.error !== null; //creating the function hasErrors with the conditions 
         },
         hasAvailability() {
             return 200 === this.status; //creating the function hasAvailability to return conditions
         },
         noAvailability() {
             return 404 === this.status; //creating the function noAvailability to return conditions
         }
     }
 };
 </script>


 <style scoped>
 label {
     font-size: 0.7rem;
     text-transform: uppercase;
     color: gray;
     font-weight: bolder;
 }

 .is-invalid{
     border-color: #bb2222;
     background-image: none;
 }
 .invalid-feedback{
     color: #bb2222;
 }
 </style>
<template>
    <div class="d-flex">
        <i class="fas fa-star" v-for="star in fullStar" :key="'full' +star"
         @click="$emit('input', star)"></i> <!--here we use the custom event where 'rating:changed' is the name and 'star' is the
          current rating -->
        <i class="fas fa-star-half-alt" v-if="halfStar"></i>
        <i class="far fa-star" v-for="star in emptyStar" :key="'empty' +star"
        @click="$emit('input', fullStar + star)"></i>
        <!-- 'input' was used because on the v-model in the parent component (review.vue) -->
    </div>
</template>

<script>
export default {

    // the reason to my understanding why will use props here is because we can specify rating as a number 
    props: {
        value: Number //the prop was called 'value' because of the v-model used in parent component
    },
    computed: {
        halfStar() {
            return false;
        },
        fullStar() {
            //4.5 = 5 stars
            //4.3 = 4 stars
            return Math.round(this.value);
        },
        emptyStar() {
            // if rating is 2, ceil(2) =2, 5 -2 = 3, render 3 empty stars
            return 5 - Math.ceil(this.value);
        }
    }
};
</script>
export default{
    data() {
        return {
            errors:null
        };
    },

    methods: {
        errorFor(field) {
            return null !== this.errors && this.errors[field] ? this.errors[field] : null;
             //methods that will return errors for a specific field
        }
    },
}
<template>
    <v-select 
        :options="collection"
        :reduce="collection => collection.value"
        label="name"></v-select>
</template>

<script>

export default {
    props: {
<<<<<<< HEAD
        
=======
        collection:Object,
>>>>>>> 0b7e1ccf6618e099838130fed027e0f6f5af5989
        form:Object,
        /**
         * List of dynamic props to watch that will trigger
         * the api call (axios response)
         */

        // barangas:{
        //     type: String,
        //     default: ''
        // },

        // purok:{
        //     type: String,
        //     default: ''
        // },

    },

    watch:{
       form: {
           handler(value){
               this.$emit('callMethod');
                console.log(value.barangay_id)
           },
           deep:true
       }
        
    },

}
</script>

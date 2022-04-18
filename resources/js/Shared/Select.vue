<template>
    <v-select 
        :reduce="collection => collection.value"
        :clearable="false" 
        
        label="name"></v-select>
</template>

<script>

export default {
    props: {
        
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

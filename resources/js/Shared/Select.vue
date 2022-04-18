<template>
    <v-select 
        :options="collection"
        :reduce="collection => collection.value"
        label="name"></v-select>
</template>

<script>

export default {
    props: {
        collection:Object,
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
           handler(){
               this.$emit('callMethod');
           },
           deep:true
       }
        
    }
}
</script>


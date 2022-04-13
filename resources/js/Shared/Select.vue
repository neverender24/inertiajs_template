<template>
    <v-select 
        
        :options="collection" 
        :reduce="collection => collection.value"
        :clearable="false" 
        
        label="name"></v-select>
</template>

<script>
import { watch } from '@vue/runtime-core'

export default {
    props: {
        collection: Array,

        /**
         * List of dynamic props to watch that will trigger
         * the api call (axios response)
         */

        barangays:{
            type: String,
            default: ''
        }

    },

    watch:{
       barangays: function(value) {
        axios.post('/barangays', {municipal_id:value}).then((response) => {
            this.$emit('storeBarangay',response.data)
        })
       }
    }
}
</script>


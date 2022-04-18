<template>
    <v-select 
        :options="collection"
        :reduce="collection => collection.value"
        label="name"
        :resetOnOptionsChange="true"
        >
        </v-select>
</template>

<script>

export default {
    props: {
        collection: Object,
        form: Object,
        propName: String,
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

                console.log(value.barangay_id, this.collection, this.propName)

                if (_.find(this.collection, { value: value.barangay_id })) {
                    console.log(true)
                }

               this.$emit('callMethod');
           },
           deep:true
       }
        
    },

    updated() {
        // if (_.find(this.collection, { value: this.form.barangay_id })) {
        //     console.log('updated', this.collection)
        // } else {
        //     console.log('updated', false)

        // }
    }

}
</script>

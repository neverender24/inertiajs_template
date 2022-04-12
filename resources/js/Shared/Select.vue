<template>
    <v-select 
        
        :options="collection" 
        :reduce="collection => collection.value"
        :clearable="false" 
        label="name"></v-select>
</template>

<script>

export default {
    props: {
        collection: Array
    }
}
</script>


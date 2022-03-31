<template>
    <div>
        <Component 
            :is="link.url ? 'Link' : 'span'"
            v-for="link in links" 
            :href="link.url" 
            v-html="link.label"
            class="p-3 text-decoration-none"
            :class="{'text-muted' : !link.url, 'fw-bold' : link.active}"
        />
    </div>
</template>

<script>
export default {
    props: {
        links: Array
    }
}
</script>


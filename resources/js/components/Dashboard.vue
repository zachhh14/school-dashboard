<script setup>
const props = defineProps(['title']);
</script>

<template>
     <div class="card p-4 mb-2">
        <h3 v-if="props">{{ props.title ?? ''  }}</h3>
        <slot>
        </slot>
    </div>
</template>

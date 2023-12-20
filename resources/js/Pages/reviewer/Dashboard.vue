<script setup>
import { onMounted, ref } from 'vue';
import { getSubjects } from '../../composable/subjects.js';

const subjects = ref([])

onMounted(async () => {
    subjects.value = await getSubjects();
});

function redirectTo(id){
    window.location.href = `/reviewer/${id}`;
}

</script>
<template>
    <h1>Reviewer</h1>
    <p>Welcome to Reviewer Dashboard by Zachary Tecson</p>
    <div class="card p-4 mb-2">
        <h3>Subjects</h3>
        <ul>
            <li v-for="subject in subjects" :key="subject.id">
                <a @click="redirectTo(subject.id)" class="text-underline cursor-pointer">
                    {{ subject.subject_name }}
                </a>
            </li>
        </ul>
    </div>
    <a href="/" class="me-2">
        <button class="btn btn-warning">Back to Dashboard</button>
    </a>
</template>
<style scoped>
.cursor-pointer:hover{
    cursor: pointer;
}
</style>

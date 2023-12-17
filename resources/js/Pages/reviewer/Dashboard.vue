<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { getSubjects } from '../../composable/subjects.js';

const subjects = ref([])

onMounted(async () => {
    subjects.value = await getSubjects();
});

</script>
<template>
    <h1>Reviewer</h1>
    <p>Welcome to Reviewer Dashboard by Zachary Tecson</p>
    <div class="card p-4 mb-2">
        <h3>Subjects</h3>
        <ul>asdf
            <li v-for="subject in subjects">
                <a href="#">
                    {{ subject.subject_name }}
                </a>
            </li>
        </ul>
    </div>
    <a href="/" class="me-2">
        <button class="btn btn-warning">Back to Dashboard</button>
    </a>
    <a href="/create-subject">
        <button class="btn btn-success">Add Subject</button>
    </a>
</template>

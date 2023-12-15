<template>
    <h1>Create Subject</h1>
    <form @submit.prevent="createSubject">
        <div class="mb-3">
            <label
                for="subjectCode"
                class="form-label"
            >
                Subject Code
            </label>
            <input
                type="text"
                class="form-control"
                id="subjectCode"
                v-model="subjectForm.subjectCode"
            />
        </div>
        <div class="mb-3">
            <label
                for="subjectName"
                class="form-label"
            >
                Subject Name
            </label>
            <input
                type="text"
                class="form-control"
                id="subjectName"
                v-model="subjectForm.subjectName"
            />
        </div>
        <button type="reset" class="btn btn-danger me-2">Reset</button>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</template>

<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';


const subjectForm = reactive({
    subjectCode: '',
    subjectName: ''
})
const sample = ref()

async function createSubject(){
    try {
        const response = await axios.post('/post-subject',{ ...subjectForm })
    } catch (err) {
        // Log the error details for debugging or display a user-friendly error message
        console.error('Error creating subject:', err);
        alert('An error occurred while creating the subject.');
    }
}
</script>

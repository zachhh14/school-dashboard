<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';


const subjectForm = reactive({
    userId: 1, // for debugging
    subjectCode: '',
    subjectName: ''
})
const sample = ref()

async function createSubject(){
    try {
        const response = await axios.post('/post-subject',{ ...subjectForm });

        if (response) {
            // Redirect to another page after successful creation
            window.location.href = '/subjects';  // Adjust the URL as needed
        } else {
            // Handle other success scenarios if necessary
            console.log('Subject creation was not successful:', response.data.message);
            alert('An error occurred while creating the subject.');
        }
    } catch (err) {
        console.error('Error creating subject:', err);
        alert('An error occurred while creating the subject.');
    }
}
</script>

<template>
    <h1>Create Subject</h1>
    <form @submit.prevent="createSubject">
        <input type="hidden" v-model="subjectForm.userId">
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



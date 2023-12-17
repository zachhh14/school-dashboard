<script setup>
import { reactive, ref } from 'vue';
import axios from 'axios';

const errors = ref(null);

const subjectForm = reactive({
    userId: 1, // for debugging
    subjectCode: '',
    subjectName: ''
})

async function createSubject(){
    try {
        const response = await axios.post('/post-subject',{ ...subjectForm });
        if (response) {
            window.location.href = '/subjects';
        }
    } catch (error) {
        if (error.response.status === 422) {
            errors.value = error.response.data.errors;
        }
    }
}
</script>

<template>
    <div v-if="errors" class="text-danger">
        <div
            class="alert alert-danger"
            role="alert"
            v-for="(messages, field) in errors"
            :key="field"
        >
            {{ messages[0] }}
        </div>
    </div>
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



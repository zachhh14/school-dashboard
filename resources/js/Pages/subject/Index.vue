<script setup>
import axios from 'axios';
import { onMounted, ref } from 'vue';

const subjects = ref([]);
onMounted(()=>{
    getSubjects();
})

async function getSubjects(){
    try {
        const response = await axios.get('/subject/list')
        if(response){
            subjects.value = response.data;
        }
    } catch (err) {
        alert('Error');
    }
}

async function deleteSubject(id){
    try{
        const response = await axios.get(`/delete-subject/${id}`)
        if (response){
            getSubjects();
        }
    } catch (err){
        alert('error');
    }
}
</script>
<template>
    <h1>Subjects</h1>
    <div class="card p-2 mb-2">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr class="text-center">
                    <th scope="col">Subject Code</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Schedule</th>
                    <th scope="col" class="w-25">Action</th>
                </tr>
            </thead>
            <tbody>
                <template v-if="subjects.length == 0">
                    <tr>
                        <td colspan="4" class="text-center fw-bold">
                            There are no existing subject ATM!!
                        </td>
                    </tr>
                </template>
                <tr v-for="subject in subjects" :key="subject.id">
                    <td>{{ subject.subject_code }}</td>
                    <td>{{ subject.subject_name }}</td>
                    <td>{{ subject.schedule ?? 'No Schedule' }}</td>
                    <td class="d-flex justify-content-center">
                        <button
                        type="button"
                        class="btn btn-light border me-2"
                        >
                            View
                        </button>
                        <button
                            type="button"
                            class="btn btn-danger"
                            @click="deleteSubject(subject.id)"
                            >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <a href="/" class="me-2">
        <button class="btn btn-warning">Back to Dashboard</button>
    </a>
    <a href="/create-subject">
        <button class="btn btn-success">Add Subject</button>
    </a>
</template>




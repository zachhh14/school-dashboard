import axios from 'axios';

export async function getSubjects() {
    try {
        const response = await axios.get('/subject/list');
        // subjects.value = response.data; // Assuming subjects is defined elsewhere
        return response.data; // Return the actual data
    } catch (err) {
        console.error('Error:', err); // Log the error for debugging
        return null; // Return null or handle the error in a more specific way
    }
}

import axios from 'axios';

export async function getSubjects() {
    try {
        const response = await axios.get('/subject/list');

        return response.data;
    } catch (err) {
        return null;
    }
}

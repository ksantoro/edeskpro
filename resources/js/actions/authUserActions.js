import axios from 'axios';

export const fetchAuthUser = () => {

    let authUser;

    axios.get('/users/current_user')
        .then(response => {
            authUser = {
                id:           response.data.id,
                first_name:   response.data.first_name,
                last_name:    response.data.last_name,
                email:        response.data.email,
                user_type:    response.data.type_user_id,
                company_id:   response.data.company.id,
                company_name: response.data.company.name
            }
        })
        .catch(error => {
            console.log('Error fetching and parsing data', error);
        });

    return {
        type:   'FETCH_AUTH_USER',
        payload: authUser
    };
}

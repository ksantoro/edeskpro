import axios from 'axios';
import { FETCH_AUTH_USER } from './types';

export const fetchAuthUser = () => async( dispatch ) => {

    try {
        const authUserResponse = await axios.get( '/users/current_user' );
        const authUserData     = authUserResponse.data;
        const payload          = {
            id:           authUserData.id,
            first_name:   authUserData.first_name,
            last_name:    authUserData.last_name,
            email:        authUserData.email,
            user_type:    authUserData.type_user_id,
            company_id:   authUserData.company.id,
            company_name: authUserData.company.name
        }

        dispatch( {
            type:    FETCH_AUTH_USER,
            payload: payload,
        } )

    } catch ( error ) {
        console.log('Error fetching and parsing authUser data', error);
    }
}

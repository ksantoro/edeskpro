import { FETCH_AUTH_USER } from '../actions/types';

const authUserReducer = ( state = {}, action ) => {
    switch ( action.type ) {
        case FETCH_AUTH_USER :
            return {
                ...state,
                authUser : action.payload
            }
        break;
        default:
            return state;
    }
};

export default authUserReducer;

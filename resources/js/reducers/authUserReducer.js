const authUserReducer = (state = {}, action) => {
    switch (action.type) {
        case 'FETCH_AUTH_USER' :
            state = {
                ...state,
                authUser : action.payload
            }
            break;
    }
    return state;
};

export default authUserReducer;

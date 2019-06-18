const userReducer = (state = {}, action) => {
    switch (action.type) {
        case 'FETCH_AUTH_USER' :
            state = {
                ...state,
                auth_user : action.payload
            }
            break;
    }
    return state;
};

export default userReducer;

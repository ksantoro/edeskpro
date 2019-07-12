import { combineReducers } from 'redux';
import authUserReducer from './authUserReducer';
import userReducer from './userReducer';

const rootReducer = combineReducers({
    authUserReducer,
    userReducer
});

export default rootReducer;

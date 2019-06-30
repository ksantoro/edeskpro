import { createStore, combineReducers, applyMiddleware } from 'redux';
import authUserReducer from './reducers/authUserReducer';
import userReducer from './reducers/userReducer';

export default createStore(
    combineReducers({
        authUser: authUserReducer,
        user:     userReducer
    }),
    {}
);

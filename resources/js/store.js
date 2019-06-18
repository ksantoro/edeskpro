import { createStore, combineReducers, applyMiddleware } from 'redux';
import userReducer from './reducers/userReducer';

export default createStore(
    combineReducers({
        user: userReducer
    }),
    {}
);

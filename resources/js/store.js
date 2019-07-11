import { createStore, combineReducers, applyMiddleware, compose } from 'redux';
import thunk from 'redux-thunk';
import authUserReducer from './reducers/authUserReducer';
import userReducer from './reducers/userReducer';

const initialState = {};
const middleware   = [thunk];
const store        = createStore(
    combineReducers({
        authUserReducer,
        userReducer
    }),
    initialState,
    compose(
        applyMiddleware(...middleware),
        window.__REDUX_DEVTOOLS_EXTENSION__ && window.__REDUX_DEVTOOLS_EXTENSION__()
    )
);

export default store;

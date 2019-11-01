import React from 'react';
import ReactDOM from 'react-dom';
import './Nav.css';

const Backdrop = props => (
    <div className='backdrop' onClick={props.click}></div>
);

export default Backdrop;

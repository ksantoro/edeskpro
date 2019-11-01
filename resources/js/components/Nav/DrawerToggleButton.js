import React from 'react';
import ReactDOM from 'react-dom';
import './Nav.css';

const DrawerToggleButton = props => (
    <button className='drawer-toggle-button' onClick={props.click}>
        <i className='fas fa-bars'></i>
    </button>
);

export default DrawerToggleButton;

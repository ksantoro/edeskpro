import React from 'react';
import ReactDOM from 'react-dom';
import './Nav.css';

const SideNavigation = props => {

    let drawerClasses = 'side-navigation';

    if (props.show) {
        drawerClasses = 'side-navigation side-navigation-open';
    }

    return (
        <nav className={drawerClasses}>
            <img src='https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-899413643241/resources/images/edesk_logo_white.png'/>
            <button className='drawer-close-button' onClick={props.close}>
                <i className='fas fa-chevron-circle-left'></i>
            </button>
            <br/>
            <ul>
                <li>
                    <a href='#'>Dashboard</a>
                </li>
                <li>
                    <a href='#'>Contacts</a>
                </li>
                <li>
                    <a href='#'>Sales</a>
                </li>
            </ul>
        </nav>
    );
};

export default SideNavigation;

import React from 'react';
import './Nav.css';

const SideNavigation = props => {

    let drawerClasses = 'side-navigation';

    if (props.show) {
        drawerClasses = 'side-navigation side-navigation-open';
    }

    return (
        <nav className={drawerClasses}>
            <div className='logo-container'>
                <img src='https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-899413643241/resources/images/edesk_logo_white.png'/>
                <button className='drawer-close-button' onClick={props.close}>
                    <i className='fas fa-chevron-circle-left'></i>
                </button>
            </div>

            <br/>
            <ul>
                <li>
                    <a href='/dashboard'><i className="fas fa-tachometer-alt"></i> &nbsp; Dashboard</a>
                </li>
                <li>
                    <i className="fas fa-users"></i> &nbsp;Contacts
                    <ul>
                        <li><a href='/leads'>Leads</a></li>
                        <li><a href='/opportunities'>Opportunities</a></li>
                        <li><a href='/customers'>Customers</a></li>
                        <li><a href='/contacts'>Contact Management</a></li>
                        <li><a href='/archived'>Archive</a></li>
                    </ul>
                </li>
                <li>
                    <i className='fas fa-cogs'></i>&nbsp; Admin
                    <ul>
                        <li><a href='/notifications'>Notification Settings</a></li>
                        <li><a href='/users'>User Management</a></li>
                    </ul>
                </li>
                <li>
                    <a href='/logout'>
                        <i className='fas fa-sign-out-alt'></i> &nbsp; Logout
                    </a>
                </li>
            </ul>
        </nav>
    );
};

export default SideNavigation;

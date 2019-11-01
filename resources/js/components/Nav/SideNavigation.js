import React, { Component } from 'react';
import PropTypes from 'prop-types';
import './Nav.css';

class SideNavigation extends Component {

    render () {

        const {
            authUserType,
        } = this.props;

        let drawerClasses  = 'side-navigation',
            showAdminItems,
            showSuperItems;

        if (this.props.show) {
            drawerClasses = 'side-navigation side-navigation-open';
        }

        if (authUserType <= 2) {
            showAdminItems =
                <li>
                    <i className='fas fa-cogs'></i>&nbsp; Admin
                    <ul>
                        <li><a href='/notifications'>Notification Settings</a></li>
                        <li><a href='/users'>User Management</a></li>
                    </ul>
                </li>;
        }

        if (authUserType == 1) {
            showSuperItems =
                <li>
                    <i className='fab fa-superpowers'></i> &nbsp; SuperUser
                    <ul>
                        <li><a href='/companies'>Company Management</a></li>
                    </ul>
                </li>;
        }

        return (
            <nav className={drawerClasses}>
                <div className='logo-container'>
                    <img src='https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-899413643241/resources/images/edesk_logo_white.png'/>
                    <button className='drawer-close-button' onClick={this.props.close}>
                        <i className='fas fa-chevron-circle-left'></i>
                    </button>
                </div>

                <br/>
                <ul>
                    <li>
                        <a href='/dashboard'><i className='fas fa-tachometer-alt'></i> &nbsp; Dashboard</a>
                    </li>
                    <li>
                        <i className='fas fa-users'></i> &nbsp;Contacts
                        <ul>
                            <li><a href='/leads'>Leads</a></li>
                            <li><a href='/opportunities'>Opportunities</a></li>
                            <li><a href='/customers'>Customers</a></li>
                            <li><a href='/contacts'>Contact Management</a></li>
                            <li><a href='/archived_contacts'>Archive</a></li>
                        </ul>
                    </li>
                    {showAdminItems}
                    {showSuperItems}
                    <li>
                        <i className='fas fa-phone-volume'></i> &nbsp; Contact
                        <ul>
                            <li><a href='mailto:info@edesk.pro'>Customer Service</a></li>
                            <li><a href='mailto:info@edesk.pro'>Technical Support</a></li>
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
    }
};

SideNavigation.propTypes = {
    authUserType: PropTypes.number,
}

export default SideNavigation;

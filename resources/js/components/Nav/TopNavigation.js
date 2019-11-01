import React, { Component } from 'react';
import PropTypes from 'prop-types';
import './Nav.css';
import DrawerToggleButton from './DrawerToggleButton';

class TopNavigation extends Component {

    render () {

        const {
            companyName,
            firstName,
            lastName
        } = this.props;

        return (
            <header className='top-navigation'>
                <nav className='top-navigation-nav'>
                    <div>
                        <DrawerToggleButton click={this.props.drawerClickHandler}/>
                    </div>
                    <div className='top-navigation-logo'>
                        <a href='/'>
                            <img src='https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-899413643241/resources/images/edesk_logo.png'/>
                        </a>
                    </div>
                    <div className='top-navigation-spacer'> &nbsp; | { companyName }</div>
                    <div className='top-navigation-items'>
                        <ul>
                            <li><a href='#'><i className='fas fa-question-circle' title='Help' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                            <li><a href='#'><i className='fas fa-bell' title='Notifications' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                            <li><a href='#'><i className='fas fa-envelope' title='Messages' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                            <li><a href='#'><i className="fas fa-user-circle"></i> &nbsp;{ firstName } { lastName }<span className='caret'></span></a></li>
                        </ul>
                    </div>
                </nav>
            </header>
        )
    }
};

TopNavigation.propTypes = {
    companyName: PropTypes.string,
    firstName:   PropTypes.string,
    lastName:    PropTypes.string,
}

export default TopNavigation;

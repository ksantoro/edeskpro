import React from 'react';
import './Nav.css';
import DrawerToggleButton from './DrawerToggleButton';

const TopNavigation = props => (
    <header className='top-navigation'>
        <nav className='top-navigation-nav'>
            <div>
                <DrawerToggleButton click={props.drawerClickHandler}/>
            </div>
            <div className='top-navigation-logo'>
                <a href='/'>
                    <img src='https://s3.us-east-2.amazonaws.com/elasticbeanstalk-us-east-2-899413643241/resources/images/edesk_logo.png'/>
                </a>
            </div>
            <div className='top-navigation-spacer'></div>
            <div className='top-navigation-items'>
                <ul>
                    <li><a href='#'><i className='fas fa-question-circle' title='Help' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                    <li><a href='#'><i className='fas fa-bell' title='Notifications' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                    <li><a href='#'><i className='fas fa-envelope' title='Messages' data-toggle='tooltip' data-placement='bottom'></i></a></li>
                    <li><a href='#'><i className="fas fa-user-circle"></i> &nbsp;{props.authuser.first_name} {props.authuser.last_name}<span className='caret'></span></a></li>
                </ul>
            </div>
        </nav>
    </header>
);

export default TopNavigation;

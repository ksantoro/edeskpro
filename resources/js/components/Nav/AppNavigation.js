import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import TopNavigation from './TopNavigation';
import SideNavigation from './SideNavigation';
import Backdrop from "./Backdrop";

class AppNavigation extends Component {

    state = {
        sideDrawerOpen: false
    };

    drawerToggleClickHandler = () => {
        this.setState((prevState) => {
            return { sideDrawerOpen: !prevState.sideDrawerOpen }
        });
    };

    backdropClickHandler = () => {
        this.setState({sideDrawerOpen: false});
    }

    iconCloseClickHander = () => {
        this.setState({sideDrawerOpen: false});
    }

    render() {

        let backdrop;

        if (this.state.sideDrawerOpen) {
            backdrop   = <Backdrop click={this.backdropClickHandler} />;
        }

        return (
            <React.Fragment>
                <TopNavigation drawerClickHandler={this.drawerToggleClickHandler} />
                <SideNavigation show={this.state.sideDrawerOpen} close={this.iconCloseClickHander}/>
                {backdrop}
            </React.Fragment>
        );
    }
}

if (document.getElementById('app-navigation')) {
    ReactDOM.render(<AppNavigation />, document.getElementById('app-navigation'));
}

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { connect } from 'react-redux';
import { bindActionCreators } from 'redux';
import TopNavigation from '../components/Nav/TopNavigation';
import SideNavigation from '../components/Nav/SideNavigation';
import Backdrop from '../components/Nav/Backdrop';
import store from '../store';
import { fetchAuthUser } from '../actions/authUserActions';

class AppNavigation extends Component {

    state = {
        authUser:       {},
        sideDrawerOpen: false
    };

    componentDidMount() {
        fetchAuthUser();
    }

    drawerToggleClickHandler = () => {
        this.setState((prevState) => {
            return { sideDrawerOpen: ! prevState.sideDrawerOpen }
        });
    };

    backdropClickHandler = () => {
        this.setState({ sideDrawerOpen: false });
    }

    iconCloseClickHander = () => {
        this.setState({ sideDrawerOpen: false });
    }

    render() {

        let backdrop;

        if (this.state.sideDrawerOpen) {
            backdrop = <Backdrop click={this.backdropClickHandler} />;
        }

        return (
            <React.Fragment>
                <TopNavigation drawerClickHandler={this.drawerToggleClickHandler} authUser={this.state.authUser}/>
                <SideNavigation show={this.state.sideDrawerOpen} close={this.iconCloseClickHander} authUser={this.state.authUser}/>
                {backdrop}
            </React.Fragment>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        authUser: state.authUser
    }
};

const mapDispatchToProps = (dispatch) => {
    return {
        fetchAuthUser: () => {
            dispatch(fetchAuthUser());
        }
    };
};

export default connect(mapStateToProps, mapDispatchToProps)(AppNavigation);

if (document.getElementById('app-navigation')) {
    ReactDOM.render(
        <Provider store={store}>
            <AppNavigation />
        </Provider>,
        document.getElementById('app-navigation')
    );
}

import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import PropTypes from 'prop-types';
import { Provider } from 'react-redux';
import { connect } from 'react-redux';
import {bindActionCreators} from 'redux';
import TopNavigation from '../components/Nav/TopNavigation';
import SideNavigation from '../components/Nav/SideNavigation';
import Backdrop from '../components/Nav/Backdrop';
import store from '../store';
import { fetchAuthUser } from '../actions/authUserActions';

class AppNavigation extends Component {

    state = {
        sideDrawerOpen: false,
    }

    componentDidMount() {
        const {
            authUser,
            onFetchAuthUser,
        } = this.props;

        onFetchAuthUser();
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

        const {
            authUser
        } = this.props;

        let backdrop;

        if (this.state.sideDrawerOpen) {
            backdrop = <Backdrop click={this.backdropClickHandler} />;
        }

        return (
            <React.Fragment>
                <TopNavigation
                    drawerClickHandler={this.drawerToggleClickHandler}
                    companyName={ authUser.company_name }
                    firstName={ authUser.first_name }
                    lastName={ authUser.last_name }
                />;
                <SideNavigation
                    show={ this.state.sideDrawerOpen }
                    close={ this.iconCloseClickHander }
                    authUserType={ authUser.user_type }/>
                {backdrop}
            </React.Fragment>
        );
    }
}

AppNavigation.defaultProps = {
    authUser: {}
};

AppNavigation.propTypes = {
    fetchAuthUser: PropTypes.func,
    authUser:      PropTypes.shape( {
        id:           PropTypes.number,
        company_id:   PropTypes.number,
        company_name: PropTypes.string,
        first_name:   PropTypes.string,
        last_name:    PropTypes.string,
        email:        PropTypes.string,
        user_type:    PropTypes.number,
    } ),
}

const mapStateToProps = ( state ) => ( {
    authUser: state.authUserReducer.authUser
} );

const mapDispatchToProps = dispatch => ( {
    onFetchAuthUser: () => dispatch( fetchAuthUser() )
} );

export default AppNavigation = connect(mapStateToProps, mapDispatchToProps)(AppNavigation);

if (document.getElementById('app-navigation')) {
    ReactDOM.render(
        <Provider store={store}>
            <AppNavigation />
        </Provider>,
        document.getElementById('app-navigation')
    );
}

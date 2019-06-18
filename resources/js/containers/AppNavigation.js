import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { Provider } from 'react-redux';
import { connect } from 'react-redux';
import axios from 'axios';
import TopNavigation from '../components/Nav/TopNavigation';
import SideNavigation from '../components/Nav/SideNavigation';
import Backdrop from '../components/Nav/Backdrop';
import store from '../store';
import {fetchAuthUser} from '../actions/userActions';

class AppNavigation extends Component {

    state = {
        authuser: {},
        sideDrawerOpen: false
    };

    componentDidMount() {
        this.fetchAuthUser();
    }

    fetchAuthUser() {
        axios.get('/users/current_user')
            .then(response => {
                console.log(response);

                this.setState({
                    authuser: {
                        id:         response.data.id,
                        first_name: response.data.first_name,
                        last_name:  response.data.last_name,
                        email:      response.data.email,
                        user_type:  response.data.type_user_id,
                        company:    {
                            id:   response.data.company.id,
                            name: response.data.company.name
                        }
                    }
                });
            })
            .catch(error => {
                console.log('Error fetching and parsing data', error);
            });
    }

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
            backdrop = <Backdrop click={this.backdropClickHandler} />;
        }

        return (
            <React.Fragment>
                <TopNavigation drawerClickHandler={this.drawerToggleClickHandler} authuser={this.state.authuser}/>
                <SideNavigation show={this.state.sideDrawerOpen} close={this.iconCloseClickHander}/>
                {backdrop}
            </React.Fragment>
        );
    }
}

const mapStateToProps = (state) => {
    return {
        user: state.authuser
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
        document.getElementById('app-navigation'));
}

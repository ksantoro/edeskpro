import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter as Router, Route, Switch } from 'react-router-dom';
import { Home } from './Home';
import { Layout } from './Layout';

class Main extends Component {
    render() {
        return (
            <React.Fragment>
                <Layout>
                    <Router>
                        <Switch>
                            <Route path='/home' component={Home}/>
                        </Switch>
                    </Router>
                </Layout>
            </React.Fragment>
        );
    }
}

if (document.getElementById('main')) {
    ReactDOM.render(<Main />, document.getElementById('main'));
}

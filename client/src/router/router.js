import React from 'react';
import {Route, Switch, Redirect} from 'react-router-dom';
import createComponent from './lazyLoad';

import App from 'pages/app';
import NotFound from 'bundle-loader?lazy&name=notFound!pages/layouts/notFound';

const getRouter = () => (
    <Switch>
        <Route exact path={'/'} render={() => <Redirect to={'/admin'} />}/>
        <Route path="/admin" component={App}/>
        <Route component={createComponent(NotFound)}/>
    </Switch>

);
export default getRouter;


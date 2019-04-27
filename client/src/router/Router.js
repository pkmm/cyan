import React from 'react';
import {Route, Switch} from 'react-router-dom';
import createComponent from './LazyLoad';

import App from 'pages/App';
import NotFound from 'bundle-loader?lazy&name=notFound!pages/layouts/notFound';

const getRouter = () => (
    <Switch>
        <Route path="/" component={App}/>
        <Route component={createComponent(NotFound)}/>
    </Switch>

);
export default getRouter;


import React, { Component } from 'react';
import { Router, Route, Switch, BrowserRouter} from 'react-router-dom';
import Loadable from 'react-loadable'
import LoadingCompnent from '../components/loading'

import history from '../components/common/history';

// import App from '../components/common/App';
// import Login from '../components/common/Login';
// import Home from '../components/common/Home';
// import NoMatch from '../components/common/404';

// 代码分割 按需加载
const LoadableApp = Loadable({
  loader: ()=>import('../components/common/App'),
  loading: LoadingCompnent,
  delay: 200,
});

const LoadableNotFound = Loadable({
  loader: ()=>import('../components/common/404'),
  loading: LoadingCompnent,
  delay: 200,
});

const LoadableHome = Loadable({
  loader: ()=>import('../components/common/Home'),
  loading: LoadingCompnent,
  delay: 200,
});

const LoadableLogin = Loadable({
  loader: ()=>import('../components/common/Login'),
  loading: LoadingCompnent,
  delay: 200,
});

class MRoute extends Component {
  render() {
    return (
      <BrowserRouter basename='/admin/'>
        <Switch>
          <Route exact path="/" component={LoadableHome}/>
          <Route path="/app" component={LoadableApp}/>
          <Route path="/login" component={LoadableLogin}/>
          <Route component={LoadableNotFound}/>
        </Switch>
      </BrowserRouter>
    );
  }
}

export default MRoute;
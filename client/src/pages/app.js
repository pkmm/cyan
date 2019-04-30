import React, {Component} from 'react'
import Main from './layouts/main'
import Login from "./login/login";
import {inject, observer} from 'mobx-react'

@inject('userStore') @observer
export default class App extends Component {
  render() {
    const {isLogin} = this.props.userStore;
    return isLogin ? <Main/> : <Login/>;
  }
}

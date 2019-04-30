import React, {Component} from 'react'
import Main from './layouts/Main'
import Login from "./login/Login";
import {inject, observer} from 'mobx-react'

@inject('UserStore') @observer
export default class App extends Component {
  render() {
    const {isLogin} = this.props.UserStore;
    return isLogin ? <Main/> : <Login/>;
  }
}

import React, {Component} from 'react'
import Main from './layouts/Main'
import Login from "./login/Login";


const TOKEN_OF_USER = 'user_token';

export default class App extends Component {
  render() {
    const token = window.localStorage.getItem(TOKEN_OF_USER);
    console.error('token ', token)
    return token ? <Main/> : <Login/>;
  }
}

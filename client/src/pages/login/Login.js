import React, {Component} from 'react'
import {withRouter} from 'react-router-dom'
import {inject, observer} from 'mobx-react'
@withRouter @observer @inject('user')
class Login extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return (
      <div>some thing here. this is Login page content.</div>
    );
  }
};

export default Login;
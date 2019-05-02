import React, {Component} from 'react'
import {inject} from 'mobx-react'
import {Button} from 'antd'
@inject('studentStore')
class UpdateStudentAccount extends Component {
  constructor(props) {
    super(props);
    this.state = {
      num: '',
      pwd: '',
    };
  }

  setAccount = () => {
    const {studentStore} = this.props;
    studentStore.updateStudentAccount(this.state.num, this.state.pwd);
  };

  handleInput = (e) => {
    e.preventDefault();
    console.error(e.target.name, e.target.value)
    this.setState({
      [e.target.name]: e.target.value,
    })
  };

  render() {
    const {studentStore} = this.props;
    return (
      <div>
        <input type="text" name={'num'} onChange={this.handleInput}/>
        <input type="password" name={'pwd'} onChange={this.handleInput}/>
        <Button onClick={this.setAccount}>设置账号</Button>
      </div>
    );
  }
};


export default UpdateStudentAccount;
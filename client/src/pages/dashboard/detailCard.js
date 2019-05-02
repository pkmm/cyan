import React, {Component} from 'react'
import {Card} from 'antd'
import {observer, inject} from 'mobx-react'

@inject('studentStore') @observer
class Detail extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }
  componentDidMount() {
    this.loadDetail();
  }

  loadDetail() {
    const {studentStore} = this.props;
    studentStore.getSyncDetail();
  }

  render() {
    const {studentStore} = this.props;
    return (
      <div>
        <Card
          title={'同步成绩任务运行详情'}
        >
          <p>学号：{studentStore.detail.student_number}</p>
          <p>课程数：{studentStore.detail.lesson_count}</p>
          <p>花费时间：{studentStore.detail.cost_time}</p>
          <p>详情：{studentStore.detail.status}</p>
          <p>更新于：{studentStore.detail.updated_at}</p>
        </Card>
      </div>
    );
  }
};


export default Detail;
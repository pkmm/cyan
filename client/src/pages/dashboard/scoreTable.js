import React, {Component} from 'react'
import {observer, inject} from 'mobx-react'
import {Table, Tag, Button} from 'antd'

const columns = [
  {
    title: 'ID',
    dataIndex: 'id',
    key: 'id',
  },
  {
    title: '学科',
    dataIndex: 'kcmc',
    key: 'kcmc'
  },
  {
    title: '学期',
    dataIndex: 'xq',
    key: 'semester'
  },
  {
    title: '学年',
    dataIndex: 'xn',
    key: 'xn'
  },
  {
    title: '成绩',
    dataIndex: 'cj',
    key: 'cj'
  },
  {
    title: '学分',
    dataIndex: 'xf',
    key: 'xf'
  },
  {
    title: '绩点',
    dataIndex: 'jd',
    key: 'jd'
  },
  {
    title: '补考成绩',
    dataIndex: 'bkcj',
    key: 'bkcj'
  },
  {
    title: '重修成绩',
    dataIndex: 'cxcj',
    key: 'cxcj'
  },
  {
    title: '更新于',
    dataIndex: 'updated_at',
    key:'updated_at'
  }
];

@inject('studentStore') @observer
class ScoreTable extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  componentDidMount() {
    this.getScores();
  }

  getScores = () => {
    const {studentStore} = this.props;
    studentStore.getScores();
  };

  render() {
    const {studentStore} = this.props;
    return (
      <div>
        <div>
          <Button color={'primary'} onClick={this.getScores}>刷新成绩</Button>
        </div>
        <Table columns={columns} dataSource={studentStore.scores} />
      </div>
    );
  }
}


export default ScoreTable;
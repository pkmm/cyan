import React, {Component} from 'react';
import cheng from 'assets/img/cheng.jpg'
import {Card, Col, Row} from "antd";

export default class NotFound extends Component {
  render() {
    return (
      <Row>
        <Col span={24}>
          <Card
            hoverable
            // style={{width: 300}}
            cover={<img src={cheng}/>}
          >
            <Card.Meta title={'出了点问题'} description={'无法找到对应的页面'}/>
          </Card>
        </Col>
      </Row>
    )
  }
}
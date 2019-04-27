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
            <Card.Meta title={'Error'} description={'找不到页面'}/>
          </Card>
        </Col>
      </Row>
    )
  }
}
import React, {Component} from 'react'
import ScoreTable from './scoreTable'
import DetailCard from './detailCard'

class Index extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return (
      <div>
        <ScoreTable />
        <DetailCard />
      </div>
    );
  }
}

export default Index;

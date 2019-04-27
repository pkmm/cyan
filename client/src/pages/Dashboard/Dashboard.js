import React, {Component} from 'react'


class Dashboard extends Component {
  constructor(props) {
    super(props);
    this.state = {};
  }

  render() {
    return (
      <div>some thing here. this is dashboard page content.
        {
          [...Array(467).keys()].map(i => <div>{i}</div>)
        }
      </div>
    );
  }
};

export default Dashboard;
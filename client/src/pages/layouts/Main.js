import React, {Component} from 'react';
import {Icon, Layout, Menu} from 'antd';
import {RouterToContent, sideMenuRouters} from 'pages/layouts/Sider';
import './Main.less';
import {Link, withRouter} from 'react-router-dom';

const {Header, Sider, Content} = Layout;
const {Item} = Menu;


const SEDER_MENU_CLICKED = 'sider_menu_clicked'

@withRouter
class Main extends Component {

  constructor(props) {
    super(props);
    const lastPath = window.localStorage.getItem(SEDER_MENU_CLICKED);
    this.state = {
      collapsed: false,
      selectedKeys: [lastPath ? lastPath : sideMenuRouters[0].path]
    };
  }

  toggle = () => {
    this.setState({
      collapsed: !this.state.collapsed,
    })
  };

  render() {
    const {match} = this.props;
    return (
      <Layout style={{height: "100vh"}}>
        <Sider
          breakpoint={'lg'}
          trigger={null}
          collapsible
          collapsed={this.state.collapsed}
        >
          <div className='logo'/>
          <Menu
            mode={'inline'}
            theme={'dark'}
            selectedKeys={this.state.selectedKeys}
            onClick={({key, keyPath}) => {
              window.localStorage.setItem(SEDER_MENU_CLICKED, keyPath);
              this.setState({selectedKeys: keyPath})
            }}
          >
            {
              sideMenuRouters.map(r => {
                return <Item key={r.path}>
                  <Icon type={r.icon}/>
                  <span>{r.show}</span>
                  <Link to={match.url + '/' + r.path}/>
                </Item>
              })
            }
          </Menu>
        </Sider>
        <Layout>
          <Header style={{background: '#fff', padding: 0}}>
            <Icon
              className="trigger"
              type={this.state.collapsed ? 'menu-unfold' : 'menu-fold'}
              onClick={this.toggle}
            />
          </Header>
          <Content style={{
            margin: '24px 16px', padding: 24, background: '#fff', minHeight: 280, overflow: 'inherit'
          }}
          >
            <RouterToContent {...this.props} />
          </Content>
          {/*<Footer>Cyan</Footer>*/}
        </Layout>
      </Layout>
    );
  }
}

export default Main;
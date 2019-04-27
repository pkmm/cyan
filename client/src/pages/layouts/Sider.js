import Profile from "../profile/Profile";
import Dashboard from "../Dashboard/Dashboard";
import {Route, Switch} from 'react-router-dom'
import React from 'react'
import createComponent from "../../router/LazyLoad";
import NotFound from 'bundle-loader?lazy&name=notFound!pages/layouts/notFound';

// 侧边栏的路由
let sideMenuRouters = [
  {
    path: '/profile', // 页面的路径
    component: Profile, // 对应的组件
    icon: 'user', // antd icon
    show: '我的信息', // 显示的文字
    order: 2, // 显示的排序
  },
  {
    path: '/dashboard',
    component: Dashboard,
    icon: 'dashboard',
    show: '概览',
    order: -5651,
  }
];

// 排序
sideMenuRouters = sideMenuRouters.sort((x, y) => x.order - y.order);


// 集中式配置页面的侧边栏
// 组件渲染到页面
const RouterToContent = (props) => {
  return (
    <Switch>
      {
        sideMenuRouters.map(r => (
          <Route
            path={r.path}
            key={r.path}
            component={r.component}
          />
        ))
      }
      <Route component={createComponent(NotFound)} />
    </Switch>
  );
};

export {
  sideMenuRouters,
  RouterToContent
}
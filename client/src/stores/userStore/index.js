import {action, computed, observable, runInAction} from 'mobx'
import {apiPost} from "../../utils/api-requester";
import {API} from "../../utils/api-list";
import {message} from 'antd'

const USER_TOKEN = 'token';

class UserStore {
  @observable userInfo = {};
  @observable isLogin = !!window.localStorage.getItem(USER_TOKEN);

  @computed get token() {
    return this.userInfo.token || null;
  }

  @action setIsLogin = isLogin => {
    this.isLogin = isLogin;
  };

  @action loginAction = async (username, password) => {
    try {
      let resp = await apiPost(API.auth.login, {username, password});
      runInAction(() => {
        if (resp.data.code !== 0) {
          message.error('登陆失败');
          return
        }
        message.success('登陆成功');
        this.isLogin = true;
        this.userInfo = resp.data.data.user;
        window.localStorage.setItem(USER_TOKEN, resp.data.data.token);
      })
    } catch (e) {
      message.error('登陆失败: ' + resp.data.data.msg);
      console.error(e);
      runInAction(() => {
        //todo
      })
    }
  };

  @action logout = async () => {
    let resp = await apiPost(API.auth.logout);
    runInAction(() => {
      const respData = resp.data;
      if (respData.code === 0) {
        window.localStorage.setItem(USER_TOKEN, '');
        this.isLogin = false;
        this.userInfo = {};
        message.success('登出成功');
      } else {
        message.error('登出失败: ' + respData.msg);
      }
    });
  };

  @action register = async (username, password) => {
    let resp = await apiPost(API.auth.register, {username, password});
    runInAction(() => {
      let respData = resp.data;
      if (respData.code !== 0) {
        message.error(`注册失败：${respData.msg}`);
      } else {
        message.success('注册成功~~');
        window.localStorage.setItem(USER_TOKEN, respData.data.token);
        this.isLogin = true;
        this.userInfo = respData.data.user;
      }
    })
  };
}

export default new UserStore();

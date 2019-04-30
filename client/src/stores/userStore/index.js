import {action, computed, observable, runInAction} from 'mobx'
import {apiPost} from "../../utils/api-requester";
import {API} from "../../utils/api-list";
import {message} from 'antd'

class Index {
  @observable userInfo = {};
  @observable isLogin = false;

  @computed get token() {
    return this.userInfo.token || null;
  }

  @action loginAction = async (username, password) => {
    try {
      let resp = await apiPost(API.auth.login, {username, password});
      runInAction(() => {
        if (resp.data.code !== 0) {
          console.error(resp.data);
          message.error('登陆失败');
          return
        }
        message.success('登陆成功');
        this.isLogin = true;
        this.userInfo = resp.data.data;
        window.localStorage.setItem('token', resp.data.data.access_token);
      })
    } catch (e) {
      message.error('登陆失败');
      console.error(e);
      runInAction(() => {
        //todo
      })
    }
  }
}

export default new Index();

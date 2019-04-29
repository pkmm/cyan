import {action, runInAction, observable, computed} from 'mobx'

class UserStore {
  @observable userInfo = {};

  @computed token() {
    return this.userInfo.token || null;
  }

  @action.bound
  async login() {
    try {
      // todo like this await get(url, data)
      runInAction(() => {

      })
    } catch (e) {
      console.error(e);
      runInAction(() => {
        //todo
      })
    }
  }
}

export default UserStore;

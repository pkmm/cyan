import {action, runInAction, observable} from 'mobx'

class UserStore {
  @observable userInfo = {};

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
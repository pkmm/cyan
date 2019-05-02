import {observable, action, runInAction} from 'mobx'
import {apiGet, apiPost} from "../../utils/api-requester";
import {API} from "../../utils/api-list";
import {message} from 'antd'

class StudentStore {
  @observable scores = [];
  @observable detail = {};

  @action getScores = async () => {
    let resp = await apiPost(API.student.getScores)
    runInAction(() => {
      let respData = resp.data;
      if (respData.code === 0) {
        let index = 0;
        this.scores = respData.data.scores.sort((a, b) => {
          if(b.id === a.id)
            return a.xq - b.xq;
          else
            return b.id - a.id;
        })
          .map(p => {p.id = index++; return p;});
        message.success('加载成绩信息成功')
      } else {
        message.error('获取成绩失败：' + respData.msg);
      }
    })
  };

  @action updateStudentAccount = async (num, pwd) => {
    let resp = await apiPost(API.student.setAccount, {student_number: num, password: pwd});
    runInAction(() => {
      let respData = resp.data;
      if (respData.code === 0) {
        message.success('设置教务系统账号成功')
      } else {
        message.error('设置教务系统账号失败')
      }
    })
  };

  @action getSyncDetail = async () => {
    let resp = await apiPost(API.student.getSyncDetail)
    runInAction(() => {
      let respData = resp.data;
      if (respData.code === 0) {
        message.success('获取详情成功');
        this.detail = respData.data.detail;
      } else {
        message.error(`获取详情失败：${respData.msg}`);
      }
    })
  };
}

const studentStore = new StudentStore();
export default studentStore;
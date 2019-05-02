const API = {
  auth: {
    register: "auth/register",
    login: "auth/login",
    logout: "auth/logout",
    refresh: "auth/refresh",
    me: "auth/me"
  },
  student: {
    getScores: "student/scores",
    setAccount: "student/update_student_account",
    getSyncDetail: "student/sync_detail",
  }
};

export {API};
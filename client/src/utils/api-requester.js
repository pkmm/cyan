import qs from 'qs';
import axios from 'axios'
import {BASE_URL} from "../config";
import {isPlainObject} from 'lodash/lang';
import {DeviceType} from "../constants/deviceType";
import UserStore from '../stores/userStore'
/**
 * @param {axios} ax
 * @returns {function(*=, *=, *=): *}
 * @private
 */
function _get(ax) {
  /**
   * Send GET request to project API
   * @param  {String} url       Relative path
   * @param  {Object} data      JSON data converts to URI: ?key=value&foo=bar
   * @param  {Object} options   Config for requester
   * @return {Promise}          Thenable/Catcheable
   */
  return function (url, data = {}, options = {}) {
    return ax.get(url, {params: data, ...options});
  };
}

/**
 *
 * @param {axios} ax
 * @returns {function(*=, *=, *=): *}
 * @private
 */
function _post(ax) {
  /**
   * Send POST request to inside of project
   * @param  {String} url       Relative path
   * @param  {Object} data      JSON data
   * @param  {Object} options   Config for requester
   * @return {Promise}          Thenable/Catcheable
   */
  return function (url, data = {}, options = {}) {
    return ax.post(url, data, options);
  };
}

/**
 * @param {axios} ax
 * @returns {function(*=, *=, *=): (IDBRequest<IDBValidKey> | Promise<void>)}
 * @private
 */
export function _put(ax) {
  /**
   * Send PUT request to inside of project
   * @param  {String} url       Relative path
   * @param  {Object} data      JSON data
   * @param  {Object} options   Config for requester
   * @return {Promise}          Thenable/Catcheable
   */
  return function (url, data = {}, options = {}) {
    return ax.put(url, data, options);
  };
}

/**
 * @param {axios} ax
 * @returns {function(*=, *=, *=): *}
 * @private
 */
export function _patch(ax) {
  /**
   * Send PATCH request to inside of project
   * @param  {String} url       Relative path
   * @param  {Object} data      JSON data
   * @param  {Object} options   Config for requester
   * @return {Promise}          Thenable/Catcheable
   */
  return function (url, data = {}, options = {}) {
    return ax.patch(url, data, options);
  };
}

/**
 * @param {axios} ax
 * @returns {function(*=, *=): (boolean | Promise<boolean> | void | IDBRequest<undefined>)}
 * @private
 */
export function _destroy(ax) {
  /**
   * Send DELETE request to inside of project
   * @param  {String} url       Relative path
   * @param  {Object} data      JSON data
   * @param  {Object} options   Config for requester
   * @return {Promise}          Thenable/Catcheable
   */
  return function (url, data = null) {
    if (data) {
      url += url.includes('?') ? '&' : '?';
      url += qs.stringify(data, {arrayFormat: 'brackets'});
    }
    return ax.delete(url);
  };
}


const ax = axios.create({
  baseURL: BASE_URL,
  timeout: 3000,
  responseType: 'json',
  // params: {
  //   token: window.localStorage.getItem('token') || 'xxx_token',
  //   device_type: DeviceType.WEB
  // },
  // api 调用都使用post进行
  transformRequest: (data) => {
    // 每个请求都要加上token
    data['token'] = window.localStorage.getItem('token') || '';
    data['device_type'] = DeviceType.WEB;
    if (isPlainObject(data)) data = qs.stringify(data);
    return data;
  },
  validateStatus: status => {
    if (status >= 200 && status < 300) {
      return true;
    }
    if (status === 401) {
      // 删除过期的无效的token 使用户重新进行登录
      window.localStorage.setItem('token', '');
      UserStore.setIsLogin(false);
    }
    return false;
  }
});
// ax.interceptors.request.use(function (config) {
//   // console.error(config, 'config')
//   return config;
// });

export const apiGet = _get(ax);
export const apiPost = _post(ax);
export const apiPut = _put(ax);
export const apiPatch = _patch(ax);
export const apiDestroy = _destroy(ax);

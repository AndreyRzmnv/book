import axios from 'axios'
import BaseApi from './BaseApi'

class BaseDataApiService extends BaseApi {
  constructor (data = {}) {
    super()
    this.url = {
      index: () => `${this.apiUrl}/${data.name}`,
      show: (id) => `${this.apiUrl}/${data.name}/${id}`,
      create: () => `${this.apiUrl}/${data.name}/create`,
      store: () => `${this.apiUrl}/${data.name}`,
      edit: (id) => `${this.apiUrl}/${data.name}/${id}/edit`,
      update: (id) => `${this.apiUrl}/${data.name}/${id}`,
      delete: (id) => `${this.apiUrl}/${data.name}/${id}`,
      datatable: () => `${this.apiUrl}/${data.name}/datatable`
    }
  }

  index () {
    return axios.get(this.url.index())
  }

  show (id) {
    return axios.get(this.url.show(id))
  }

  create () {
    return axios.get(this.url.create())
  }

  store (data) {
    return axios.post(this.url.store(), data)
  }

  edit (id) {
    return axios.get(this.url.edit(id))
  }

  update (id, data) {
    return axios.post(this.url.update(id), data)
  }

  delete (id) {
    return axios.delete(this.url.delete(id))
  }
  getIndexData () {
    
    return axios.get(this.url.index() + '?index_data=true')
  }
}

export default BaseDataApiService

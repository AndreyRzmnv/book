import BaseDataApi from './BaseDataApi';
class SubjectApi extends BaseDataApi {
    constructor() {
        super({name: 'subjects'});
        this.url.search = () => `${this.apiUrl}/subjects/search`
    }
}
export default SubjectApi;
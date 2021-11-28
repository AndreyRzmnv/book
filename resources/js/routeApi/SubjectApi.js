import BaseDataApi from './BaseDataApi';
class SubjectApi extends BaseDataApi {
    constructor() {
        super({name: 'subjects'});
    }
}
export default SubjectApi;
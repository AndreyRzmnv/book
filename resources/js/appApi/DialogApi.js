import BaseDataApi from './BaseDataApi';
class DialogApi extends BaseDataApi {
    constructor() {
        super({name: 'dialogs'});
    }
}
export default DialogApi;
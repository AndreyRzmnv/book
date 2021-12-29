
import BaseDataApi from './BaseDataApi';
class MenuApi extends BaseDataApi {
    constructor() {
        super({name: 'menu'});
    }
    testFunction() {
        return this.apiUrl;
    }
}
export default MenuApi;
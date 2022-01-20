import BaseDataApi from './BaseDataApi';
class SubcategoryApi extends BaseDataApi {
    constructor() {
        super({name: 'subcategories'});
        this.url.search = () => `${this.apiUrl}/subcategories/search`
    }
}
export default SubcategoryApi;
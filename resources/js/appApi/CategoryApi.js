import BaseDataApi from './BaseDataApi';
class CategoryApi extends BaseDataApi {
    constructor() {
        super({name: 'categories'});
        this.url.search = () => `${this.apiUrl}/categories/search`
    }
}
export default CategoryApi;
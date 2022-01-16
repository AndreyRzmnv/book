import BaseDataApi from './BaseDataApi';
class CategoryApi extends BaseDataApi {
    constructor() {
        super({name: 'categories'});
    }
}
export default CategoryApi;